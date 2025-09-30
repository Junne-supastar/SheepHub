<?php

require_once __DIR__ . '/../models/UsuarioInstituicao.php';

class UsuarioInstituicaoController {
    private $modelUser;

    public function __construct() {
        $this->modelUser = new UsuarioInstituicao();
    }

    // Index / listar
    public function index($inicio = null, $quantidade = null) {
        return $this->modelUser->listar($inicio, $quantidade);
    }

    // Contar total
    public function contar() {
        return $this->modelUser->contarTotal();
    }

    // Validar campos
    private function validarCampos($dados, $isUpdate = false) {
        $erros = [];

        if (isset($dados['nome_instituicao']) && strlen($dados['nome_instituicao']) < 3) {
            $erros[] = "Nome da instituição deve ter pelo menos 3 caracteres.";
        }

        if (isset($dados['email_instituicao']) && !filter_var($dados['email_instituicao'], FILTER_VALIDATE_EMAIL)) {
            $erros[] = "E-mail inválido.";
        }

        if (!$isUpdate && isset($dados['senha_instituicao']) && strlen($dados['senha_instituicao']) < 6) {
            $erros[] = "Senha deve ter pelo menos 6 caracteres.";
        }

        if (isset($dados['cnpj']) && !preg_match('/^[0-9]{14}$/', $dados['cnpj'])) {
            $erros[] = "CNPJ inválido (use apenas números, 14 dígitos).";
        }

        return $erros;
    }

    // Salvar nova instituição
    public function salvar($dados) {
        $erros = $this->validarCampos($dados);
        if (!empty($erros)) return ['success' => false, 'errors' => $erros];

        return $this->modelUser->salvar($dados);
    }

    // Atualizar instituição existente
    public function atualizar($idusuario_instituicao, $dados) {
        $erros = $this->validarCampos($dados, true);
        if (!empty($erros)) return ['success' => false, 'errors' => $erros];

        return $this->modelUser->atualizar($idusuario_instituicao, $dados);
    }

    // Alterar status / soft delete
    public function atualizarStatus($idusuario_instituicao, $status) {
        return $this->modelUser->atualizarStatus($idusuario_instituicao, $status);
    }

    public function ativar($idusuario_instituicao) {
        return $this->atualizarStatus($idusuario_instituicao, 1);
    }

    public function bloquear($idusuario_instituicao) {
        return $this->atualizarStatus($idusuario_instituicao, 2);
    }

    public function pendente($idusuario_instituicao) {
    return $this->atualizarStatus($idusuario_instituicao, 3);
    }

    // Soft delete / excluir (status = 4)
    public function excluir($idusuario_instituicao) {
        return $this->atualizarStatus($idusuario_instituicao, 4);
    }


    // Buscar instituição por ID
    public function buscarPorId($idusuario_instituicao) {
        return $this->modelUser->buscarPorId($idusuario_instituicao);
    }
}
