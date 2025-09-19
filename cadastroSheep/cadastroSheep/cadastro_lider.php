<?php
$id_usuario = $_GET['id'] ?? ''; // pega o id do usuário
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Líder</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <main>

        <div>
            <div id="ovelha"></div>
        </div>

        <div class="cadastrar">
            <h2 class="destaqueTexto" id="cadastroTexto">Só mais um pouco...</h2>

            <form action="salvar_lider.php" method="POST">
                <input class="inserir" type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($id_usuario); ?>">
            
                <input class="inserir" type="text" name="cep" id="cep" maxlength="9" placeholder="CEP" required>
            
                <input class="inserir" type="text" name="rua" id="rua" placeholder="Rua" required>
            
                <input class="inserir" type="text" name="bairro" id="bairro" placeholder="Bairro" required>
            
                <input class="inserir" type="text" name="cidade" id="cidade" placeholder="Cidade" required>
            
                <input class="inserir" type="text" name="estado" id="estado" placeholder="Estado" required>
            
                <button class="enviar" type="submit">Finalizar</button>
            </form>
        </div>
    </main>
</body>
</html>

<script>
document.getElementById('cep').addEventListener('blur', function() {
    let cep = this.value.replace(/\D/g, ''); // remove tudo que não é número
    if (cep.length === 8) { // CEP válido
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                if (!data.erro) {
                    document.getElementById('rua').value = data.logradouro;
                    document.getElementById('bairro').value = data.bairro;
                    document.getElementById('cidade').value = data.localidade;
                    document.getElementById('estado').value = data.uf;
                } else {
                    alert('CEP não encontrado!');
                    document.getElementById('rua').value = '';
                    document.getElementById('bairro').value = '';
                    document.getElementById('cidade').value = '';
                    document.getElementById('estado').value = '';
                }
            })
            .catch(() => alert('Erro ao consultar o CEP!'));
    } else {
        alert('CEP inválido! Digite 8 números.');
    }
});
</script>
