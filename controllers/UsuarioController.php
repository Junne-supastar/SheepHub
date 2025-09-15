<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../models/usuario.php';

class UsuarioController {

    private $modelUser;

    public function __construct() {
        $this->modelUser = new Usuario();
    }


    // Listar usuários
    public function index($inicio = null, $quantidade = null) {
        return $this->modelUser->listar($inicio, $quantidade);
    }

    // Contar total de usuários
    public function contar() {
        return $this->modelUser->contarTotal();
    }

    // Buscar usuário para edição
    public function editar($idusuario) {
        return $this->modelUser->buscarPorId($idusuario);
    }

    // Salvar novo usuário
    public function salvar($dados) {
        $resultado = $this->modelUser->salvar($dados);
        if ($resultado['success']) {
            $_SESSION['sucesso'] = 'Usuário salvo com sucesso.';
            header('Location: views/auth/cadastro_localidade.php?user_id=' . $resultado['id']);
            exit;
        } else {
            $_SESSION['errors'] = $resultado['errors'];
        }
        header('Location: index.php?page=usuario');
        exit;
    }

    // Atualizar usuário existente
    public function atualizar($idusuario, $dados) {
        $resultado = $this->modelUser->atualizar($idusuario, $dados);
        if ($resultado['success']) {
            $_SESSION['sucesso'] = 'Usuário atualizado com sucesso.';
       

        } else {
            $_SESSION['errors'] = $resultado['errors'];
        }
        header('Location: index.php?page=usuario');
        exit;
    }

    // Deletar usuário
    public function deletar($idusuario) {
        $resultado = $this->modelUser->deletar($idusuario);
        if ($resultado['success']) {
            $_SESSION['sucesso'] = 'Usuário deletado com sucesso.';
        } else {
            $_SESSION['errors'] = $resultado['errors'];
        }
        header('Location: index.php?page=usuario');
        exit;
    }

    // Bloquear usuário
    public function bloquear($idusuario) {
        $this->modelUser->bloquear($idusuario);
        $_SESSION['sucesso'] = 'Usuário bloqueado com sucesso.';
        header('Location: index.php?page=usuario');
        exit;
    }

    // Ativar usuário
    public function ativar($idusuario) {
        $this->modelUser->ativar($idusuario);
        $_SESSION['sucesso'] = 'Usuário ativado com sucesso.';
        header('Location: index.php?page=usuario');
        exit;
    }
}
