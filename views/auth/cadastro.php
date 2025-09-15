<?php
session_start();

// Pega o nível (1 = membro, 2 = instituição)
$nivel = $_GET['nivel'] ?? $_POST['nivel'] ?? null;

// Captura erros da sessão
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

// Se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Salva temporariamente os dados do usuário na sessão
    $_SESSION['usuario_temp'] = $_POST;
    $_SESSION['nivel_temp'] = $_POST['nivel'] ?? null;

    // Redireciona para o cadastro de localidade
    header('Location: ../../public/actions/SalvarLocalidade.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Cadastro</title>
<link rel="stylesheet" href="assets/css/style1.css">
</head>
<body>

<?php if (!empty($errors)): ?>
<div id="errorModal">
    <div class="modal-content">
        <?php foreach ($errors as $error): ?>
            <p><?= htmlspecialchars($error) ?></p>
        <?php endforeach; ?>
        <button onclick="document.getElementById('errorModal').style.display='none'">Fechar</button>
    </div>
</div>
<?php endif; ?>

<main>
    <div class="cadastrar">
        <h2>Cadastre-se agora</h2>

        <form method="POST">
            <input type="hidden" name="nivel" value="<?= htmlspecialchars($nivel) ?>">

            <?php if ($nivel == 2): ?>
                <input class="inserir" type="text" name="username_instituicao" placeholder="Username da instituição" required>
                <input class="inserir" type="text" name="cnpj" placeholder="CNPJ" required>
                <input class="inserir" type="email" name="email_instituicao" placeholder="E-mail" required>
                <input class="inserir" type="password" name="senha_instituicao" placeholder="Senha" required>
                <input class="inserir" type="text" name="telefone_instituicao" placeholder="Telefone" required>
                <input class="inserir" type="textarea" name="descricao" placeholder="Descrição (Opcional)">
            <?php else: ?>
                <input class="inserir" type="text" name="username" placeholder="Usuário" required>
                <input class="inserir" type="text" name="nome" placeholder="Primeiro nome" required>
                <input class="inserir" type="date" name="nascimento" max="<?= date('Y-m-d') ?>" required>
                <input class="inserir" type="email" name="email" placeholder="E-mail" required>
                <input class="inserir" type="password" name="senha" placeholder="Senha" required>
            <?php endif; ?>

            <button type="submit" class="enviar">Próximo</button>
        </form>
    </div>
</main>
</body>
</html>
