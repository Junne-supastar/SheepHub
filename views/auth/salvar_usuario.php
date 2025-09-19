<?php
require_once '../config/Conexao.php';

// Recebe os dados
$nivel       = $_POST['nivel'];
$nome       = $_POST['nome'];
$username   = $_POST['username'];
$nascimento = $_POST['nascimento'];
$email      = $_POST['email'];
$senha      = password_hash($_POST['senha'], PASSWORD_DEFAULT); // segurança

// Esses dados só entram na segunda etapa (se for líder)
$cep    = $_POST['cep'] ?? null;
$igreja = $_POST['igreja'] ?? null;

// Pega a conexão PDO
$conn = Conexao::getConexao();

// Verificando se username já existe
$check = $conn->prepare("SELECT idusuario FROM usuario WHERE username = ?");
$check->execute([$username]);

if ($check->rowCount() > 0) {
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
    exit;
}

// Se o usuário for LÍDER → salva dados básicos e redireciona
if ($nivel === "lider") {
    $sql = "INSERT INTO usuario (username, nome, nascimento, email, senha, nivel) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute([$username, $nome, $nascimento, $email, $senha, $nivel])) {
        $idusuario = $conn->lastInsertId();
        header("Location: cadastro_lider.php?id=$idusuario");
        exit;
    } else {
        echo "Erro ao cadastrar líder.";
    }
} else {
    // Usuário comum → salva tudo de uma vez
    $sql = "INSERT INTO usuario (username, nome, nascimento, email, senha, tipo, cep, igreja) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute([$username, $nome, $nascimento, $email, $senha, $nivel, $cep, $igreja])) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar usuário.";
    }
}
?>
