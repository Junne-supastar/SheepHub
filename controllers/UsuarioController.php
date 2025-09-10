<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../controllers/permissaoController.php';

class UsuarioController {

    private $modelUser;

    public function __construct() {
        $nivelRequerido = "1";
        validarNivel($nivelRequerido);
        $this->modelUser = new Usuario();
    }

    public function index($inicio = null, $quantidade = null) {
        return $this->modelUser->listar($inicio, $quantidade);
    }

    public function contar() {
        return $this->modelUser->contarTotal();
    }
    
    public function editar($id) {
        return $this->modelUser->buscarPorId($id);
    }

    public function salvar($dados) {
        try {
            $this->modelUser->salvar($dados);
            $_SESSION['sucesso'] = 'Usuário salvo com sucesso.';
        } catch (Exception $e) {
            // Erro controlável → erro de lógica
            $_SESSION['exception'] = $e->getMessage();
            header('Location: index.php?page=usuario/form');
            exit;
        } catch (Throwable $e) {
            // Erro inesperado → erroException
            $_SESSION['exception'] = 'Ocorreu um erro inesperado. Tente novamente mais tarde.';
            error_log($e->getMessage()); // para o log do sistema
        }
        header('Location: index.php?page=usuario');
        exit;
    }
        
    public function bloquear($id) {
        return $this->modelUser->bloquear($id);
    }

    public function ativar($id) {
        return $this->modelUser->ativar($id);
    }

}