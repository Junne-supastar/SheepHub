<?php
require_once __DIR__ . '/../config/Conexao.php';

/**
 * Model Caixinha
 * Responsável por gerenciar caixinhas de arrecadação
 */
class Caixinha {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao();
    }

    /**
     * Lista todas as caixinhas
     * @param int|null $idusuario Se informado, filtra pelas caixinhas da instituição
     * @return array Lista de caixinhas
     */
    public function listarCaixinhas($idusuario = null) {
        if ($idusuario) {
            $sql = "SELECT * FROM caixinha WHERE idusuario_instituicao = :idusuario";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['idusuario' => $idusuario]);
        } else {
            $sql = "SELECT * FROM caixinha";
            $stmt = $this->conn->query($sql);
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Buscar caixinha por ID
     */
    public function buscarPorId($idCaixinha) {
        $sql = "SELECT * FROM caixinha WHERE id_caixinha = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $idCaixinha]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Cria uma nova caixinha
     */
    public function criarCaixinha($idusuario_instituicao, $nome, $meta) {
        $sql = "INSERT INTO caixinha (idusuario_instituicao, nome, meta, total) 
                VALUES (:idusuario_instituicao, :nome, :meta, 0)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'idusuario_instituicao' => $idusuario_instituicao,
            'nome' => $nome,
            'meta' => $meta
        ]);
    }

    /**
     * Contribuir para uma caixinha
     */
    public function contribuir($id_caixinha, $id_usuario, $valor) {
        try {
            $this->conn->beginTransaction();

            // Inserir registro da contribuição
            $sql = "INSERT INTO contribuicao (id_caixinha, id_usuario, valor, data)
                    VALUES (:id_caixinha, :id_usuario, :valor, NOW())";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'id_caixinha' => $id_caixinha,
                'id_usuario' => $id_usuario,
                'valor' => $valor
            ]);

            // Atualizar total da caixinha
            $sqlUpdate = "UPDATE caixinha SET total = total + :valor WHERE id_caixinha = :id_caixinha";
            $stmtUpdate = $this->conn->prepare($sqlUpdate);
            $stmtUpdate->execute([
                'valor' => $valor,
                'id_caixinha' => $id_caixinha
            ]);

            $this->conn->commit();
            return true;

        } catch (PDOException $e) {
            $this->conn->rollBack();
            throw new Exception("Erro ao contribuir: " . $e->getMessage());
        }
    }

    /**
     * Verifica se o usuário é dono e líder da caixinha
     */
    public function ehDonoELider($id_caixinha, $id_usuario) {
        $sql = "
            SELECT 1
            FROM caixinha c
            JOIN usuario_instituicao ui ON c.idusuario_instituicao = ui.idusuario
            JOIN usuario u ON ui.idusuario = u.idusuario
            WHERE c.id_caixinha = :id_caixinha
              AND u.idusuario = :id_usuario
              AND u.nivel = 2
            LIMIT 1
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_caixinha' => $id_caixinha,
            'id_usuario' => $id_usuario
        ]);
        return (bool) $stmt->fetchColumn();
    }

    /**
     * Realiza saque da caixinha
     */
    public function sacar($id_caixinha, $id_usuario, $valor, $motivo) {
        if ($valor <= 0) throw new Exception("Valor de saque inválido.");

        if (!$this->ehDonoELider($id_caixinha, $id_usuario)) {
            throw new Exception("Apenas o dono (nível Líder) pode sacar.");
        }

        try {
            $this->conn->beginTransaction();

            // Bloqueia o registro da caixinha para atualização
            $sql = "SELECT total FROM caixinha WHERE id_caixinha = :id_caixinha FOR UPDATE";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id_caixinha' => $id_caixinha]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) throw new Exception("Caixinha não encontrada.");
            $totalAtual = floatval($row['total']);
            if ($valor > $totalAtual) throw new Exception("Saldo insuficiente.");

            // Atualiza o total
            $stmtUpdate = $this->conn->prepare(
                "UPDATE caixinha SET total = total - :valor WHERE id_caixinha = :id_caixinha"
            );
            $stmtUpdate->execute(['valor' => $valor, 'id_caixinha' => $id_caixinha]);

            // Registra o saque
            $stmtHist = $this->conn->prepare(
                "INSERT INTO saques_caixinha (id_caixinha, id_usuario, valor, motivo, data)
                 VALUES (:id_caixinha, :id_usuario, :valor, :motivo, NOW())"
            );
            $stmtHist->execute([
                'id_caixinha' => $id_caixinha,
                'id_usuario' => $id_usuario,
                'valor' => $valor,
                'motivo' => $motivo
            ]);

            $this->conn->commit();
            return true;

        } catch (Exception $e) {
            if ($this->conn->inTransaction()) $this->conn->rollBack();
            throw $e;
        }
    }
}
