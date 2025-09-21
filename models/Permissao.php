<?php
require_once __DIR__ . '/../config/Conexao.php';

class Permissao {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao();
    }

    /**
     * Solicita a filiação de um usuário a uma instituição.
     * Insere na tabela permissao com status "pendente".
     *
     * @param int $idusuario Usuário que quer se filiar
     * @param int $idinstituicao Instituição escolhida
     * @param int $statusPendente ID do status pendente (default 2)
     * @return array ['success' => bool, 'errors' => array|null]
     */
    public function solicitarFiliação($idusuario, $idusuario_instituicao, $statusPendente = 3) {
        if (!$idusuario || !$idusuario_instituicao) {
            return ['success' => false, 'errors' => ['Usuário ou instituição não informados.']];
        }

        try {
            $stmt = $this->conn->prepare("
                INSERT INTO permissao (idusuario_instituicao, idusuario, data_permissao, id_status)
                VALUES (:idusuario_instituicao, :idusuario, :data_permissao, :id_status)
            ");

            $stmt->execute([
                'idusuario_instituicao' => $idusuario_instituicao,
                'idusuario'     => $idusuario,
                'data_permissao'=> date('Y-m-d H:i:s'),
                'id_status'     => $statusPendente
            ]);

            return ['success' => true, 'errors' => null];
        } catch (PDOException $e) {
            return ['success' => false, 'errors' => ["Erro ao solicitar filiação: " . $e->getMessage()]];
        }
    }
}
