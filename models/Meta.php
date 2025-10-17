<?php
require_once __DIR__ . '/../config/Conexao.php';
class Meta {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao();
    }

    // Cadastrar meta com status Pendente automaticamente
    public function criar($idusuario, $nome, $icone, $objetivo, $investimento) {
    $id_status = 3;
    $sql = "INSERT INTO metas (idusuario, id_status, nome_meta, icone, objetivo, investimento) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([$idusuario, $id_status, $nome, $icone, $objetivo, $investimento]);
}


    // Buscar metas de um usuário
    public function getAllByUser($idusuario) {
    $sql = "SELECT m.*, s.nome as status_nome 
            FROM metas m
            JOIN status s ON m.id_status = s.id_status
            WHERE idusuario = ? 
            ORDER BY data_criacao DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$idusuario]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    // Buscar meta específica
    public function getById($id_meta) {
    $sql = "SELECT * FROM metas WHERE id_meta = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$id_meta]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


    // Editar meta
    public function editar($id_metas, $nome, $icone, $objetivo, $investimento, $id_status) {
    $sql = "UPDATE metas SET nome_meta = ?, icone = ?, objetivo = ?, investimento = ?, id_status = ? WHERE id_meta = ?";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([$nome, $icone, $objetivo, $investimento, $id_status, $id_metas]);
}


    public function atualizar($id_meta, $id_status, $nome, $icone, $objetivo, $investimento) {
    $sql = "UPDATE metas SET id_status = ?, nome_meta = ?, icone = ?, objetivo = ?, investimento = ? WHERE id_meta = ?";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([$id_status, $nome, $icone, $objetivo, $investimento, $id_meta]);
}

    public function excluir($id_meta) {
    $sql = "DELETE FROM metas WHERE id_meta = ?";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([$id_meta]);
}


}
