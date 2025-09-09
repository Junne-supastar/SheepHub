<?php
    if (session_status() === PHP_SESSION_NONE) session_start();
    function validarNivel($nivelRequerido) {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['nivel_acesso']) || $_SESSION['nivel_acesso'] > $nivelRequerido) {
            http_response_code(403);
            echo "Acesso negado.";
            exit();
        }
    }