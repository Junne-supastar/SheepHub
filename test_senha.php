<?php
$senhaDigitada = '123456';
$hashNoBanco = '$2y$10$e0NR9OZ6J3v3ZXUQeFxtJ.NYJvjqHs7m.FcGxI8u5ZQLnkkv5c6wS';

if (password_verify($senhaDigitada, $hashNoBanco)) {
    echo "Senha correta!";
} else {
    echo "Senha incorreta!";
}
?>