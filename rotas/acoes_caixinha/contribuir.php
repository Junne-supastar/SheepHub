<?php
session_start();
require_once __DIR__ . '/../../controllers/CaixinhaController.php';

$controller = new CaixinhaController();

try {
    $postData = [
        'id_caixinha' => $_POST['id_caixinha'] ?? null,
        'valor_contribuir' => $_POST['valor_contribuir'] ?? 0
    ];

    $controller->contribuir($postData);

    $_SESSION['mensagem_sucesso'] = "Contribuição realizada com sucesso!";
} catch (Exception $e) {
    $_SESSION['mensagem_erro'] = "Erro ao contribuir: " . $e->getMessage();
}

// Redireciona de volta para a página da caixinha
header("Location: /SheepHub/views/dashboard/caixinha/caixinha.php");
exit;
