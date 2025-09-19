<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../models/usuarioinstituicao.php';

class UsuarioInstituicaoController {

    private $modelUser;

  
    public function __construct() {
        $this->modelUser = new UsuarioInstituicao();
    }

    // Listar instituições
    public function index($inicio = null, $quantidade = null) {
        return $this->modelUser->listar($inicio, $quantidade);
    }

    // Buscar instituição por ID (para editar)
    public function editar($idusuarioinstituicao) {
        return $this->modelUser->buscarPorId($idusuarioinstituicao);
    }

    // Salvar nova instituição
    public function salvar($dados) {
        $resultado = $this->modelUser->salvar($dados);
        if ($resultado['success']) {
            $_SESSION['sucesso'] = 'Instituição salva com sucesso.';
            echo "tudo certo";
        } else {
            $_SESSION['errors'] = $resultado['errors'];
            header('Location: views/auth/cadastro.php');
            exit;
        }
    }

    // Atualizar instituição existente
    public function atualizar($idusuarioinstituicao, $dados) {
        $resultado = $this->modelUser->atualizar($idusuarioinstituicao, $dados);
        if ($resultado['success']) {
            $_SESSION['sucesso'] = 'Instituição atualizada com sucesso.';
        } else {
            $_SESSION['errors'] = $resultado['errors'];
        }
        header('Location: index.php?page=dashboard');
        exit;
    }

    // Deletar instituição
    public function deletar($idusuarioinstituicao) {
        $resultado = $this->modelUser->deletar($idusuarioinstituicao);
        if ($resultado['success']) {
            $_SESSION['sucesso'] = 'Instituição deletada com sucesso.';
      

        } else {
            $_SESSION['errors'] = $resultado['errors'];
        }
        header('Location: index.php?page=dashboard');
        exit;
    }

    // Bloquear instituição
    public function bloquear($idusuario_instituicao) {
        return $this->modelUser->bloquear($idusuario_instituicao);
    }

    // Ativar instituição
    public function ativar($idusuario_instituicao) {
        return $this->modelUser->ativar($idusuario_instituicao);
    }
}
