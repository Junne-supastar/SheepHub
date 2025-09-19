<?php
require_once __DIR__ . '/../../config/Conexao.php';

class Localidade {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao();
    }

    public function salvar($dados) {
        try {
            $cep = $dados['cep'] ?? null;
            $logradouro = $dados['rua'] ?? null;
            $bairro = $dados['bairro'] ?? null;
            $cidade = $dados['cidade'] ?? null;
            $estado = $dados['estado'] ?? null;

            if (!$cep) {
                return ['success' => false, 'errors' => ['CEP é obrigatório']];
            }

            // Verifica se já existe a localidade
            $stmt = $this->conn->prepare("SELECT cep FROM localidade WHERE cep = :cep");
            $stmt->execute(['cep' => $cep]);
            if ($stmt->rowCount() > 0) {
                return ['success' => true, 'id' => $cep]; // já existe
            }

            // Insere nova localidade
            $stmt = $this->conn->prepare("
                INSERT INTO localidade (cep, logradouro, bairro, cidade, estado)
                VALUES (:cep, :logradouro, :bairro, :cidade, :estado)
            ");
            $stmt->execute([
                'cep' => $cep,
                'logradouro' => $logradouro,
                'bairro' => $bairro,
                'cidade' => $cidade,
                'estado' => $estado
            ]);

            return ['success' => true, 'id' => $cep];

        } catch (PDOException $e) {
            return ['success' => false, 'errors' => [$e->getMessage()]];
        }
    }
}
