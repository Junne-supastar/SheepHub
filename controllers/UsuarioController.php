<?php

require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController {
    private $modelUser;

    public function __construct() {
        $this->modelUser = new Usuario();
    }

    // Listar usuários
    public function index($inicio = null, $quantidade = null) {
        return $this->modelUser->listar($inicio, $quantidade);
    }

    // Contar usuários
    public function contar() {
        return $this->modelUser->contarTotal();
    }

    // Buscar usuário por ID
    public function buscarPorId($idusuario) {
        return $this->modelUser->buscarPorId($idusuario);
    }

    // Salvar novo usuário
    public function salvar($dados) {
        // Removemos a validação de campos daqui, pois ela já existe no model.
        // O controller agora apenas repassa a solicitação para o model
        // e retorna a resposta dele.
        return $this->modelUser->salvar($dados);
    }

    // Atualizar usuário existente
    public function atualizar($idusuario, $dados) {
        return $this->modelUser->atualizar($idusuario, $dados);
    }

    // Deletar usuário
    public function deletar($idusuario) {
        return $this->modelUser->deletar($idusuario);
    }

    // Alterar status (Ativar, Bloquear, Soft delete)
    public function atualizarStatus($idusuario, $status) {
        return $this->modelUser->atualizarStatus($idusuario, $status);
    }

    public function ativar($idusuario) {
        return $this->atualizarStatus($idusuario, 1);
    }

    public function bloquear($idusuario) {
        return $this->atualizarStatus($idusuario, 2);
    }

    public function pendente($idusuario) {
    return $this->atualizarStatus($idusuario, 3);
    }

    // Soft delete / excluir (status = 4)
    public function excluir($idusuario) {
        return $this->atualizarStatus($idusuario, 4);
    }

    // Autenticar usuário
    public function autenticar($email, $senha) {
        return $this->modelUser->autenticar($email, $senha);
    }
}