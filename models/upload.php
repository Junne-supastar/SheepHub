<?php
function uploadImagem($file, $pastaDestino) {
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $permitidos = ['jpg','jpeg','png','gif'];
    $extensao = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($extensao, $permitidos)) {
        return null;
    }

    $novoNome = uniqid() . '_' . time() . '.' . $extensao;

    if (!move_uploaded_file($file['tmp_name'], $pastaDestino . '/' . $novoNome)) {
        return null;
    }

    return $novoNome;
}
?>
