<?php
require_once __DIR__ . '/controllers/RecuperacaoSenhaController.php';

$controller = new RecuperacaoSenhaController();
if ($controller->testarEmail('juliaramosrodrigues0801@gmail.com')) {
    echo "Email enviado com sucesso!";
} else {
    echo "Falha ao enviar o email.";
}