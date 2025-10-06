<?php
// Sobe dois níveis: de views/auth → views → raiz
require_once __DIR__ . '/../../controllers/UsuarioController.php';

session_start();

$nivel = $_GET['nivel'] ?? $_POST['nivel'] ?? null;
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

// Processa cadastro de instituição
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $nivel == 2) {
    require_once __DIR__ . '/../../controllers/UsuarioController.php';
    $dadosUsuario = [
        'nivel' => $nivel,
        'username' => $_POST['nome_instituicao'] ?? '',
        'nome' => $_POST['nome_instituicao'] ?? '',
        'email' => $_POST['email_instituicao'] ?? '',
        'senha' => $_POST['senha_instituicao'] ?? '',
        'data_nascimento' => null
    ];

    $usuarioController = new UsuarioController();
    $resultUsuario = $usuarioController->salvar($dadosUsuario);

    if (!empty($resultUsuario['success']) && !empty($resultUsuario['idusuario'])) {
        // Models também sobem dois níveis
        require_once __DIR__ . '/../../models/Usuario.php';
        $usuarioModel = new Usuario();
        $usuarioCriado = $usuarioModel->buscarPorId($resultUsuario['idusuario']);

        if ($usuarioCriado) {
            $_SESSION['idusuario'] = $resultUsuario['idusuario'];
            header('Location: /SheepHub/views/cadastro-perfil-instituicao.php');
            exit;
        } else {
            $_SESSION['errors'] = ['Usuário não foi criado corretamente.'];
            header('Location: cadastro.php?nivel=2');
            exit;
        }
    } else {
        $_SESSION['errors'] = $resultUsuario['errors'] ?? ['Erro ao cadastrar usuário base para instituição'];
        header('Location: cadastro.php?nivel=2');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Cadastro</title>

<!-- Agora só sobe um nível para acessar views/assets -->
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

        <form method="POST">
            <input type="hidden" name="nivel" value="<?= htmlspecialchars($nivel) ?>">

            <?php if ($nivel == 2): ?>
                <input class="inserir" type="text" name="nome_instituicao" placeholder="Nome da instituição" required>
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

<!-- Também sobe um nível para acessar o JS -->
<script src="../assets/js/mascaras.js"></script>

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
