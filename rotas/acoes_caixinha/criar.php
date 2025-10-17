<?php
require_once __DIR__ . '/Sheephub/controllers/CaixinhaController.php';


$controller = new CaixinhaController();

// Coleta dados do formulário do modal
$postData = [
    'idusuario_instituicao' => $_POST['idusuario_instituicao'] ?? null,
    'nome' => $_POST['nome_caixinha'] ?? '',
    'meta' => $_POST['meta_caixinha'] ?? 0
];

// Chama o método do controller
$controller->criarCaixinha($postData);
