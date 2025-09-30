ta assim a view

<?php
// Mantém a sessão ativa
session_start();

// Exibe mensagens de erro ou sucesso
if (!empty($_SESSION['erro'])) {
    echo "<p style='color:red; font-weight:bold'>{$_SESSION['erro']}</p>";
    unset($_SESSION['erro']);
}
if (!empty($_SESSION['sucesso'])) {
    echo "<p style='color:green; font-weight:bold'>{$_SESSION['sucesso']}</p>";
    unset($_SESSION['sucesso']);
}

// Captura o token da URL de forma segura
$token = htmlspecialchars($_GET['token'] ?? '');
?>

<div style="max-width: 400px; margin: 50px auto; padding: 20px; background: #f9f9f9; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1);">
    <h2 style="text-align:center; color:#333;">Redefinir Senha</h2>
    <form method="POST" action="?token=<?= $token ?>" style="display:flex; flex-direction:column; gap:15px;">
        <label for="senha">Nova Senha:</label>
        <input type="password" name="senha" id="senha" required placeholder="Digite a nova senha" style="padding:10px; border-radius:5px; border:1px solid #ccc;">

        <label for="conf_senha">Confirme a Senha:</label>
        <input type="password" name="conf_senha" id="conf_senha" required placeholder="Confirme a senha" style="padding:10px; border-radius:5px; border:1px solid #ccc;">

        <button type="submit" style="padding:12px; background-color:#007BFF; color:#fff; border:none; border-radius:5px; font-weight:bold; cursor:pointer;">Atualizar Senha</button>
    </form>
</div>
