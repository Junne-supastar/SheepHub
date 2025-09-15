<?php
session_start();

// Pega os dados temporários do usuário
$usuario_temp = $_SESSION['usuario_temp'] ?? null;
$nivel = $_SESSION['nivel_temp'] ?? null;

if (!$usuario_temp || !$nivel) {
    $_SESSION['errors'] = ['Sessão expirada. Refaça o cadastro.'];
    header('Location: cadastro.php');
    exit;
}

$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

// Quando o formulário é enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../../controllers/LocalidadeController.php';
    require_once __DIR__ . '/../../controllers/UsuarioController.php';
    require_once __DIR__ . '/../../controllers/UsuarioInstituicaoController.php';

    // Salva a localidade
    $localidadeCtrl = new LocalidadeController();
    $resLocalidade = $localidadeCtrl->salvar($_POST);

    if (!$resLocalidade['success']) {
        $_SESSION['errors'] = $resLocalidade['errors'] ?? ['Erro ao salvar localidade'];
        header('Location: cadastro_localidade.php');
        exit;
    }

    // Adiciona o CEP nos dados do usuário
    $usuario_temp['cep'] = $resLocalidade['id'];

    // Salva o usuário
    $controller = ($nivel == 2) ? new UsuarioInstituicaoController() : new UsuarioController();
    $resUsuario = $controller->salvar($usuario_temp);

    // Limpa sessão temporária
    unset($_SESSION['usuario_temp'], $_SESSION['nivel_temp']);

    if (!empty($resUsuario['success']) && $resUsuario['success']) {
        $redirect = ($nivel == 2) ? 'dashboard.php' : 'feed.php';
        header("Location: $redirect");
        exit;
    } else {
        $_SESSION['errors'] = $resUsuario['errors'] ?? ['Erro ao salvar usuário'];
        header('Location: cadastro_localidade.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro de Localidade</title>
<link rel="stylesheet" href="assets/css/style1.css">
</head>
<body>

<?php if (!empty($errors)): ?>
<div id="errorModal">
    <div class="modal-content">
        <?php foreach ($errors as $err) echo "<p>$err</p>"; ?>
        <button onclick="document.getElementById('errorModal').style.display='none'">Fechar</button>
    </div>
</div>
<?php endif; ?>

<main>
    <div class="cadastrar">
        <h2>Quase lá! Informe sua localidade</h2>

        <form method="POST">
            <input type="text" name="cep" id="cep" maxlength="8" placeholder="CEP" required>
            <input type="text" name="rua" id="rua" placeholder="Rua" required>
            <input type="text" name="bairro" id="bairro" placeholder="Bairro" required>
            <input type="text" name="cidade" id="cidade" placeholder="Cidade" required>
            <input type="text" name="estado" id="estado" placeholder="Estado" required>

            <button type="submit" class="enviar">Finalizar</button>
        </form>
    </div>
</main>

<script>
document.getElementById('cep').addEventListener('blur', function() {
    let cep = this.value.replace(/\D/g, '');
    if (cep.length === 8) {
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(res => res.json())
            .then(data => {
                if (!data.erro) {
                    document.getElementById('rua').value = data.logradouro;
                    document.getElementById('bairro').value = data.bairro;
                    document.getElementById('cidade').value = data.localidade;
                    document.getElementById('estado').value = data.uf;
                } else {
                    alert('CEP não encontrado!');
                }
            })
            .catch(() => alert('Erro ao consultar o CEP!'));
    } else {
        alert('CEP inválido! Digite 8 números.');
    }
});
</script>
</body>
</html>
