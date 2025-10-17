<?php
require_once __DIR__ . '/../models/Caixinha.php';

class CaixinhaController {
    private $model;

    public function __construct() {
        $this->model = new Caixinha();
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    /**
     * Lista caixinhas do usuário (ou todas se $idusuario for null)
     */
    public function listarCaixinhas($idusuario = null) {
        return $this->model->listarCaixinhas($idusuario);
    }

    /**
     * Cria uma nova caixinha
     */
    public function criarCaixinha(array $postData) {
        if (!isset($postData['nome'], $postData['meta'], $postData['idusuario_instituicao'])) {
            $_SESSION['mensagem_erro'] = "Dados incompletos para criar caixinha.";
            return;
        }

        $idusuario_instituicao = intval($postData['idusuario_instituicao']);
        $nome = trim($postData['nome']);
        $meta = floatval($postData['meta']);

        if ($idusuario_instituicao <= 0 || empty($nome) || $meta < 0) {
            $_SESSION['mensagem_erro'] = "Dados inválidos para criar caixinha.";
            return;
        }

        $sucesso = $this->model->criarCaixinha($idusuario_instituicao, $nome, $meta);
        if ($sucesso) {
            $_SESSION['mensagem_sucesso'] = "Caixinha criada com sucesso!";
        } else {
            $_SESSION['mensagem_erro'] = "Erro ao criar caixinha.";
        }
    }

    /**
     * Contribuição para caixinha
     */
    public function contribuir(array $postData) {
        $id_usuario = $_SESSION['idusuario'] ?? null;
        if (!$id_usuario) {
            $_SESSION['mensagem_erro'] = "Você precisa estar logado para contribuir.";
            return;
        }

        if (!isset($postData['id_caixinha'], $postData['valor_contribuir'])) {
            $_SESSION['mensagem_erro'] = "Dados incompletos para contribuição.";
            return;
        }

        $id_caixinha = intval($postData['id_caixinha']);
        $valor = floatval($postData['valor_contribuir']);

        if ($id_caixinha <= 0 || $valor <= 0) {
            $_SESSION['mensagem_erro'] = "Dados inválidos para contribuição.";
            return;
        }

        try {
            $this->model->contribuir($id_caixinha, $id_usuario, $valor);
            $_SESSION['mensagem_sucesso'] = "Contribuição realizada com sucesso!";
        } catch (Exception $e) {
            $_SESSION['mensagem_erro'] = "Erro ao contribuir: " . $e->getMessage();
        }
    }

    /**
     * Saque de caixinha
     */
    public function sacar(array $postData) {
        $id_usuario = $_SESSION['idusuario'] ?? null;
        if (!$id_usuario) {
            $_SESSION['mensagem_erro'] = "Você precisa estar logado.";
            return;
        }

        $id_caixinha = intval($postData['id_caixinha'] ?? 0);
        $valor = floatval($postData['valor_retirar'] ?? 0);
        $motivo = trim($postData['motivo_retirar'] ?? '');

        if ($id_caixinha <= 0 || $valor <= 0 || empty($motivo)) {
            $_SESSION['mensagem_erro'] = "Dados inválidos para saque.";
            return;
        }

        try {
            $this->model->sacar($id_caixinha, $id_usuario, $valor, $motivo);
            $_SESSION['mensagem_sucesso'] = "Saque realizado com sucesso!";
        } catch (Exception $e) {
            $_SESSION['mensagem_erro'] = $e->getMessage();
        }
    }
}
