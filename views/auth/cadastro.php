<?php
session_start();
$nivel = $_GET['nivel'] ?? $_POST['nivel'] ?? null;
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Cadastro</title>
<link rel="stylesheet" href="../assets/css/style1.css">
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

        <!-- Aqui enviamos para o controller -->
    <form method="POST" action="\SheepHub/public/actions/processar_cadastro.php">
            <input type="hidden" name="nivel" value="<?= htmlspecialchars($nivel) ?>">

            <?php if ($nivel == 2): ?>
                <input class="inserir" type="text" name="nome_instituicao" placeholder="Nome da instituição" required>
                <input class="inserir" type="text" name="cnpj" id="cnpj" placeholder="CNPJ" required>
                <input class="inserir" type="email" name="email_instituicao" placeholder="E-mail" required>
                <input class="inserir" type="password" name="senha_instituicao" placeholder="Senha" required>
                <input class="inserir" type="text" name="telefone_instituicao" id="telefone_instituicao" placeholder="Telefone" required>
                <input class="inserir" type="textarea" name="descricao" placeholder="Descrição (Opcional)">
            <?php else: ?>
                <input class="inserir" type="text" name="username" placeholder="Usuário" required>
                <input class="inserir" type="text" name="nome" placeholder="Nome" required>
               <!-- <input class="inserir" type="date" name="data_nascimento" max="<?= date('Y-m-d') ?>" required> -->
                <input class="inserir" type="email" name="email" placeholder="E-mail" required>
                <input class="inserir" type="password" name="senha" placeholder="Senha" required>
            <?php endif; ?>

        
    


            <button type="submit" class="enviar">Enviar</button>
        </form>
    </div>
</main>
<script>
function mascaraCNPJ(valor) {
    return valor
        .replace(/\D/g, '')
        .replace(/(\d{2})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d)/, '$1/$2')
        .replace(/(\d{4})(\d{1,2})$/, '$1-$2');
}

function mascaraTelefone(valor) {
    return valor
        .replace(/\D/g, '')
        .replace(/^(\d{2})(\d)/g, '($1) $2')
        .replace(/(\d{5})(\d{1,4})$/, '$1-$2');
}

document.addEventListener('DOMContentLoaded', function() {
    var cnpj = document.getElementById('cnpj');
    if (cnpj) {
        cnpj.addEventListener('input', function() {
            this.value = mascaraCNPJ(this.value);
        });
    }

    var telefone = document.getElementById('telefone_instituicao');
    if (telefone) {
        telefone.addEventListener('input', function() {
            this.value = mascaraTelefone(this.value);
        });
    }
});
</script>
</body>
</html>
