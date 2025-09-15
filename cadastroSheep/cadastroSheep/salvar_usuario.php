<?php
// Conexão com o banco
$host = "localhost";
$user = "root";
$pass = "";
$db   = "sheephub1"; // coloque o nome do seu banco

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Recebe os dados
$tipo       = $_POST['tipo'];
$nome       = $_POST['nome'];
$username   = $_POST['username'];
$nascimento = $_POST['nascimento'];
$email      = $_POST['email'];
$senha      = password_hash($_POST['senha'], PASSWORD_DEFAULT); // segurança

// Esses dados só entram na segunda etapa (se for líder)
$cep    = $_POST['cep'] ?? null;
$igreja = $_POST['igreja'] ?? null;

// verificando se username já existe para n haver repetições
$check = $conn->prepare("SELECT idUsuario FROM usuario WHERE username = ?");
$check->bind_param("s", $username);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    // Modal HTML
    echo '
    <div id="errorModal" style="
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        display: flex;
        justify-content: center;
        align-items: center;
    ">
        <div style="
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            text-align: center;
        ">
            <p>Opa! Alguém já utiliza esse username. Escolha outro para prosseguir.</p>
            <button onclick="window.location.href=\'cadastro.php\'" style="
                padding: 5px 15px;
                border: none;
                background-color: #007BFF;
                color: white;
                border-radius: 4px;
                cursor: pointer;
            ">Tentar outro</button>
        </div>
    </div>
    ';

    $check->close();
    $conn->close();
    exit;
}

$check->close();

// Se o usuário for LÍDER → só salva os dados básicos e redireciona para segunda etapa
if ($tipo === "lider") {
    $sql = "INSERT INTO usuario (username, nome, nascimento, email, senha, tipo) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $username, $nome, $nascimento, $email, $senha, $tipo);

    if ($stmt->execute()) {
        $id_usuario = $stmt->insert_id;
        header("Location: cadastro_lider.php?id=$id_usuario");
        exit;
    } else {
        echo "Erro: " . $stmt->error;
    }
    $stmt->close();
} else {
    // Usuário comum → salva tudo de uma vez
    $sql = "INSERT INTO usuario (username, nome, nascimento, email, senha, tipo, cep, igreja) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $username, $nome, $nascimento, $email, $senha, $tipo, $cep, $igreja);

    if ($stmt->execute()) {
        echo "Usuário cadastrado com sucesso. (Aqui dá pra redirecionar para o feed ou fazer uma tela de sucesso de cadastro, alguma coisa assim)";
    } else {
        echo "Erro: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>
