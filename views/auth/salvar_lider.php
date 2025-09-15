<?php
require_once '../config/Conexao.php';

// Recebe dados do POST
$idusuario = intval($_POST['idusuario'] ?? 0);
$cep        = $_POST['cep'] ?? '';
$rua        = $_POST['logradouro'] ?? '';
$bairro     = $_POST['bairro'] ?? '';
$cidade     = $_POST['cidade'] ?? '';
$estado     = $_POST['estado'] ?? '';

// Validação básica
if (!$idusuario || !$cep || !$rua || !$bairro || !$cidade || !$estado) {
    die("Todos os campos são obrigatórios.");
}

// Pega a conexão PDO
$conn = Conexao::getConexao();

// Prepara e executa o UPDATE
$stmt = $conn->prepare("
    UPDATE usuario 
    SET cep = ?, rua = ?, bairro = ?, cidade = ?, estado = ? 
    WHERE idusuario = ?
");

if ($stmt->execute([$cep, $rua, $bairro, $cidade, $estado, $idusuario])) {
    echo "Dados atualizados com sucesso!";
} else {
    echo "Erro ao atualizar dados.";
}
?>
