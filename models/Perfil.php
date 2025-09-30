<?php
require_once __DIR__ . '/../config/Conexao.php';

class PerfilModel {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao();
    }

    public function getUsuario($idusuario) {
        $sql = "SELECT u.*, n.nome AS nivel_nome
                FROM usuario u
                JOIN niveis_usuario n ON u.nivel = n.id_nivelusu
                WHERE u.idusuario = :idusuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['idusuario' => $idusuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPerfilMembro($idusuario) {
        $stmt = $this->conn->prepare("SELECT * FROM perfil_membro WHERE idusuario = :idusuario");
        $stmt->execute(['idusuario' => $idusuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertPerfilMembro($idusuario, $biografia, $funcao, $cep, $redes_sociais, $foto_perfil, $foto_fundo) {
        $sql = "INSERT INTO perfil_membro
                (idusuario, biografia, funcao, cep, redes_sociais, foto_perfil, foto_fundo)
                VALUES (:idusuario, :biografia, :funcao, :cep, :redes_sociais, :foto_perfil, :foto_fundo)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'idusuario' => $idusuario,
            'biografia' => $biografia,
            'funcao' => $funcao,
            'cep' => $cep,
            'redes_sociais' => $redes_sociais,
            'foto_perfil' => $foto_perfil,
            'foto_fundo' => $foto_fundo
        ]);
    }

public function updatePerfilMembro($idusuario, $biografia, $funcao, $cep, $redes_sociais, $foto_perfil, $foto_fundo) {
    // Campos que sempre atualizamos
    $campos = [
        'biografia = :biografia',
        'funcao = :funcao',
        'redes_sociais = :redes_sociais',
        'foto_perfil = :foto_perfil',
        'foto_fundo = :foto_fundo'
    ];
    $params = [
        'biografia' => $biografia,
        'funcao' => $funcao,
        'redes_sociais' => $redes_sociais,
        'foto_perfil' => $foto_perfil,
        'foto_fundo' => $foto_fundo,
        'idusuario' => $idusuario
    ];

    // Só atualiza o CEP se ele não estiver vazio
    if (!empty($cep)) {
        $campos[] = 'cep = :cep';
        $params['cep'] = $cep;
    }

    $sql = "UPDATE perfil_membro SET " . implode(', ', $campos) . " WHERE idusuario = :idusuario";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute($params);
}

    /** Salva a 1ª etapa do cadastro (CEP, telefone e gênero) */
    public function salvarBasico($idusuario, $cep, $tel, $genero) {
        $sql = "UPDATE perfil_membro
                SET cep = :cep,
                    telefone = :tel,
                    genero = :genero
                WHERE idusuario = :idusuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'cep' => $cep,
            'tel' => $tel,
            'genero' => $genero,
            'idusuario' => $idusuario
        ]);
    }
}
