<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
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

        <form method="POST" action="\SheepHub/public/actions/SalvarLocalidade.php">
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
