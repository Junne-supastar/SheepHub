<?php
require_once __DIR__ . '/../config/Conexao.php';

class PerfilVisitante {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao();
    }

    /** Retorna o perfil completo do visitante (usuário + perfil + cidade) */
    public function getPerfilCompleto($idusuario) {
        $sql = "SELECT pv.idusuario, pv.foto_perfil, pv.foto_fundo, pv.descricao, pv.redes_sociais,
                       u.nome, u.username, u.dt_criacao,
                       l.cidade, l.bairro, l.logradouro, l.uf
                FROM perfil_visitante pv
                LEFT JOIN usuario u ON pv.idusuario = u.idusuario
                LEFT JOIN localidade l ON pv.cep = l.cep
                WHERE pv.idusuario = :idusuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['idusuario' => $idusuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /** Retorna apenas os dados do perfil visitante */
    public function getPerfilVisitante($idusuario) {
        $sql = "SELECT * FROM perfil_visitante WHERE idusuario = :idusuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['idusuario' => $idusuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /** Insere um novo perfil visitante */
    public function insertPerfilVisitante($idusuario, $descricao = '', $cep = null, $foto_perfil = null, $foto_fundo = null, $redes_sociais = '') {
        $sql = "INSERT INTO perfil_visitante 
                    (idusuario, descricao, cep, foto_perfil, foto_fundo, redes_sociais)
                VALUES 
                    (:idusuario, :descricao, :cep, :foto_perfil, :foto_fundo, :redes_sociais)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'idusuario' => $idusuario,
            'descricao' => $descricao,
            'cep' => $cep,
            'foto_perfil' => $foto_perfil,
            'foto_fundo' => $foto_fundo,
            'redes_sociais' => $redes_sociais
        ]);
    }

    /** Atualiza um perfil visitante existente */
    public function updatePerfilVisitante($idusuario, $dados) {
        $campos = [];
        $params = ['idusuario' => $idusuario];

        foreach ($dados as $coluna => $valor) {
            if ($valor !== null && $valor !== '') {
                $campos[] = "$coluna = :$coluna";
                $params[$coluna] = $valor;
            }
        }

        if (empty($campos)) return false;

        $sql = "UPDATE perfil_visitante SET " . implode(', ', $campos) . " WHERE idusuario = :idusuario";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }

    /** Salva apenas dados básicos (cep, fotos, descrição) */
    public function salvarBasico($idusuario, $cep = null, $descricao = null, $foto_perfil = null, $foto_fundo = null) {
        $campos = [];
        $params = ['idusuario' => $idusuario];

        if ($cep !== null) { $campos[] = "cep = :cep"; $params['cep'] = $cep; }
        if ($descricao !== null) { $campos[] = "descricao = :descricao"; $params['descricao'] = $descricao; }
        if ($foto_perfil !== null) { $campos[] = "foto_perfil = :foto_perfil"; $params['foto_perfil'] = $foto_perfil; }
        if ($foto_fundo !== null) { $campos[] = "foto_fundo = :foto_fundo"; $params['foto_fundo'] = $foto_fundo; }

        if (empty($campos)) return false;

        $sql = "UPDATE perfil_visitante SET " . implode(', ', $campos) . " WHERE idusuario = :idusuario";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }
}
