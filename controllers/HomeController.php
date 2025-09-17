<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '../../models/Aluno.php';
require_once __DIR__ . '../../models/Curso.php';

$alunoModel = new Aluno();
$cursoModel = new Curso();

$totalAlunos = $alunoModel->contarTotal();
$totalCursos = $cursoModel->contarTotal();
?>
