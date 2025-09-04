<?php
require_once __DIR__ . '/../config/Conexao.php';

class Perfil {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao();
    }

    // ================= PERFIS ALUNO =================
    public function listar_perfis_aluno($inicio = null, $quantidade = null) {
        $sql = "SELECT p.*, a.*, l.*
                FROM perfil_aluno p
                JOIN aluno a ON p.matricula = a.matricula
                LEFT JOIN localidade l ON l.cep = a.cep";

        if ($inicio !== null && $quantidade !== null) {
            $sql .= " LIMIT :inicio, :quantidade";
        }

        $stmt = $this->conn->prepare($sql);
        if ($inicio !== null && $quantidade !== null) {
            $stmt->bindValue(':inicio', (int)$inicio, PDO::PARAM_INT);
            $stmt->bindValue(':quantidade', (int)$quantidade, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvar_perfil_aluno($dados) {
        if (!empty($dados['id_perfil'])) {
            $sql = "UPDATE perfil_aluno SET 
                        matricula = :matricula,
                        foto_oficial = :foto_oficial,
                        foto_social = :foto_social,
                        foto_avatar = :foto_avatar,
                        biografia = :biografia,
                        data_conta = :data_conta
                    WHERE id_perfil = :id_perfil";

            $params = [
                'matricula' => $dados['matricula'],
                'foto_oficial' => $dados['foto_oficial'] ?? null,
                'foto_social'  => $dados['foto_social'] ?? null,
                'foto_avatar'  => $dados['foto_avatar'] ?? null,
                'biografia'    => $dados['biografia'] ?? null,
                'data_conta'   => $dados['data_conta'] ?? date('Y-m-d'),
                'id_perfil'    => $dados['id_perfil']
            ];
        } else {
            $sql = "INSERT INTO perfil_aluno 
                        (matricula, foto_oficial, foto_social, foto_avatar, biografia, data_conta)
                    VALUES 
                        (:matricula, :foto_oficial, :foto_social, :foto_avatar, :biografia, :data_conta)";

            $params = [
                'matricula'    => $dados['matricula'],
                'foto_oficial' => $dados['foto_oficial'] ?? null,
                'foto_social'  => $dados['foto_social'] ?? null,
                'foto_avatar'  => $dados['foto_avatar'] ?? null,
                'biografia'    => $dados['biografia'] ?? null,
                'data_conta'   => $dados['data_conta'] ?? date('Y-m-d')
            ];
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return !empty($dados['id_perfil']) ? $dados['id_perfil'] : $this->conn->lastInsertId();
    }

    public function excluir_perfil_aluno($id_perfil) {
        $stmt = $this->conn->prepare("DELETE FROM perfil_aluno WHERE id_perfil = :id_perfil");
        return $stmt->execute(['id_perfil' => $id_perfil]);
    }

    // ================= PERFIS DOCENTE =================
    public function listar_perfis_docente($inicio = null, $quantidade = null) {
        $sql = "SELECT pd.*, d.nome_docente, d.vinculo_docente, d.ch_docente, f.nome_funcao
                FROM perfil_docente pd
                JOIN docente d ON pd.id_docente = d.id_docente
                JOIN funcao f ON d.id_funcao = f.id_funcao";

        if ($inicio !== null && $quantidade !== null) {
            $sql .= " LIMIT :inicio, :quantidade";
        }

        $stmt = $this->conn->prepare($sql);
        if ($inicio !== null && $quantidade !== null) {
            $stmt->bindValue(':inicio', (int)$inicio, PDO::PARAM_INT);
            $stmt->bindValue(':quantidade', (int)$quantidade, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvar_perfil_docente($dados) {
        if (!empty($dados['id_perfildocente'])) {
            $sql = "UPDATE perfil_docente SET 
                        id_docente = :id_docente,
                        foto_oficial = :foto_oficial,
                        foto_social = :foto_social,
                        foto_avatar = :foto_avatar,
                        biografia = :biografia,
                        data_conta = :data_conta
                    WHERE id_perfildocente = :id_perfildocente";

            $params = [
                'id_docente'      => $dados['id_docente'],
                'foto_oficial'    => $dados['foto_oficial'] ?? null,
                'foto_social'     => $dados['foto_social'] ?? null,
                'foto_avatar'     => $dados['foto_avatar'] ?? null,
                'biografia'       => $dados['biografia'] ?? null,
                'data_conta'      => $dados['data_conta'] ?? date('Y-m-d'),
                'id_perfildocente'=> $dados['id_perfildocente']
            ];
        } else {
            $sql = "INSERT INTO perfil_docente 
                        (id_docente, foto_oficial, foto_social, foto_avatar, biografia, data_conta)
                    VALUES 
                        (:id_docente, :foto_oficial, :foto_social, :foto_avatar, :biografia, :data_conta)";

            $params = [
                'id_docente'      => $dados['id_docente'],
                'foto_oficial'    => $dados['foto_oficial'] ?? null,
                'foto_social'     => $dados['foto_social'] ?? null,
                'foto_avatar'     => $dados['foto_avatar'] ?? null,
                'biografia'       => $dados['biografia'] ?? null,
                'data_conta'      => $dados['data_conta'] ?? date('Y-m-d')
            ];
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return !empty($dados['id_perfildocente']) ? $dados['id_perfildocente'] : $this->conn->lastInsertId();
    }

    public function excluir_perfil_docente($id_perfildocente) {
        $stmt = $this->conn->prepare("DELETE FROM perfil_docente WHERE id_perfildocente = :id_perfildocente");
        return $stmt->execute(['id_perfildocente' => $id_perfildocente]);
    }

    // ================= GENÉRICOS =================
    public function buscar_por_id($id, $tipo = 'aluno') {
        $tabela = $tipo === 'docente' ? 'perfil_docente' : 'perfil_aluno';
        $campoId = $tipo === 'docente' ? 'id_perfildocente' : 'id_perfil';
        $stmt = $this->conn->prepare("SELECT * FROM $tabela WHERE $campoId = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function contar_total($tipo = 'aluno') {
        $tabela = $tipo === 'docente' ? 'perfil_docente' : 'perfil_aluno';
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM $tabela");
        $stmt->execute();
        return (int)$stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
?>
