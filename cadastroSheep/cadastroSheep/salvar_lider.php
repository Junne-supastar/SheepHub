<?php
// Conexão com o banco
$host = "localhost";
$user = "root";
$pass = "";
$db   = "sheephub1";

$conn = new mysqli($host, $user, $pass, $db);

// Verifica conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Recebe dados do POST
$id_usuario = intval($_POST['id_usuario'] ?? 0);
$cep        = $_POST['cep'] ?? '';
$rua        = $_POST['rua'] ?? '';
$bairro     = $_POST['bairro'] ?? '';
$cidade     = $_POST['cidade'] ?? '';
$estado     = $_POST['estado'] ?? '';

// Validação básica
if (!$id_usuario || !$cep || !$rua || !$bairro || !$cidade || !$estado) {
    die("Todos os campos são obrigatórios.");
}

// Prepara e executa o UPDATE (evitando SQL Injection)
$stmt = $conn->prepare("
    UPDATE usuario 
    SET cep = ?, rua = ?, bairro = ?, cidade = ?, estado = ? 
    WHERE idUsuario = ?
");
$stmt->bind_param("sssssi", $cep, $rua, $bairro, $cidade, $estado, $id_usuario);

if ($stmt->execute()) {
    echo "Dados atualizados com sucesso!";
} else {
    echo "Erro ao atualizar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
