<?php
require_once __DIR__ . 
'/../config/Conexao.php';

class Localidade {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao();
    }

    public function cepExists($cep) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM localidade WHERE cep = :cep");
        $stmt->execute(['cep' => $cep]);
        return $stmt->fetchColumn() > 0;
    }

    public function insertLocalidade($cep, $logradouro, $bairro, $cidade, $uf) {
        $sql = "INSERT INTO localidade (cep, logradouro, bairro, cidade, uf) VALUES (:cep, :logradouro, :bairro, :cidade, :uf)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'cep' => $cep,
            'logradouro' => $logradouro,
            'bairro' => $bairro,
            'cidade' => $cidade,
            'uf' => $uf
        ]);
    }
}

