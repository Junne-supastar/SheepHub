<?php
require_once __DIR__ . '/../config/Conexao.php';

class PerfilModel {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao();
    }

<<<<<<< HEAD
=======
    /** Obtém os dados principais do usuário e o nome do nível */
>>>>>>> f4d0321393a89c89697f4334f12a979a84622d46
    public function getUsuario($idusuario) {
        $sql = "SELECT u.*, n.nome AS nivel_nome
                FROM usuario u
                JOIN niveis_usuario n ON u.nivel = n.id_nivelusu
                WHERE u.idusuario = :idusuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['idusuario' => $idusuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

<<<<<<< HEAD
    public function getPerfilMembro($idusuario) {
        $stmt = $this->conn->prepare("SELECT * FROM perfil_membro WHERE idusuario = :idusuario");
=======
    /** Retorna o perfil do membro junto com informações do usuário_normal */
    public function getPerfilMembro($idusuario) {
        $sql = "SELECT 
                    pm.*, 
                    un.data_nascimento, 
                    un.genero, 
                    un.funcao, 
                    un.telefone
                FROM perfil_membro pm
                LEFT JOIN usuario_normal un ON pm.idusuario = un.idusuario
                WHERE pm.idusuario = :idusuario";
        $stmt = $this->conn->prepare($sql);
>>>>>>> f4d0321393a89c89697f4334f12a979a84622d46
        $stmt->execute(['idusuario' => $idusuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

<<<<<<< HEAD
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
=======
    /** Cria um novo registro de perfil de membro */
public function insertPerfilMembro($idusuario, $biografia, $cep, $redes_sociais, $foto_perfil, $foto_fundo) {
    if (!$foto_perfil) $foto_perfil = 'default.png';
    if (!$foto_fundo)  $foto_fundo  = 'default-fundo.png';
    if (!$cep)         $cep = '';

    $sql = "INSERT INTO perfil_membro 
            (idusuario, biografia, cep, redes_sociais, foto_perfil, foto_fundo)
            VALUES (:idusuario, :biografia, :cep, :redes_sociais, :foto_perfil, :foto_fundo)";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([
        'idusuario' => $idusuario,
        'biografia' => $biografia,
        'cep' => $cep,
        'redes_sociais' => $redes_sociais,
        'foto_perfil' => $foto_perfil,
        'foto_fundo' => $foto_fundo
    ]);
}

    /** Retorna todos os dados combinados do perfil, usuário e localização */
    public function getPerfilCompleto($idusuario) {
        $sql = "SELECT 
                    u.idusuario, u.nome, u.username, u.email, u.dt_criacao, u.nivel,
                    un.data_nascimento, un.genero, un.telefone, un.funcao,
                    pm.biografia, pm.cep, pm.redes_sociais, 
                    pm.foto_perfil, pm.foto_fundo,
                    l.cidade, l.bairro, l.logradouro, l.uf
                FROM usuario u
                LEFT JOIN usuario_normal un ON u.idusuario = un.idusuario
                LEFT JOIN perfil_membro pm ON u.idusuario = pm.idusuario
                LEFT JOIN localidade l ON pm.cep = l.cep
                WHERE u.idusuario = :idusuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['idusuario' => $idusuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /** Retorna o perfil do membro junto com cidade e bairro */
    public function getPerfilComCidade($idusuario) {
        $sql = "SELECT pm.*, l.cidade, l.bairro, l.logradouro, l.uf
                FROM perfil_membro pm
                LEFT JOIN localidade l ON pm.cep = l.cep
                WHERE pm.idusuario = :idusuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['idusuario' => $idusuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /** Atualiza o perfil do membro */
    public function updatePerfilMembro($idusuario, $biografia, $cep, $redes_sociais, $foto_perfil, $foto_fundo) {
        $campos = [
            'biografia = :biografia',
            'redes_sociais = :redes_sociais',
            'foto_perfil = :foto_perfil',
            'foto_fundo = :foto_fundo'
        ];

        $params = [
            'biografia' => $biografia,
            'redes_sociais' => $redes_sociais,
            'foto_perfil' => $foto_perfil,
            'foto_fundo' => $foto_fundo,
            'idusuario' => $idusuario
        ];

        if (!empty($cep)) {
            $campos[] = 'cep = :cep';
            $params['cep'] = $cep;
        }

        $sql = "UPDATE perfil_membro SET " . implode(', ', $campos) . " WHERE idusuario = :idusuario";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }

    /** Atualiza apenas informações básicas do perfil (CEP) */
    public function salvarBasico($idusuario, $cep) {
        $sql = "UPDATE perfil_membro
                SET cep = :cep
>>>>>>> f4d0321393a89c89697f4334f12a979a84622d46
                WHERE idusuario = :idusuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'cep' => $cep,
<<<<<<< HEAD
            'tel' => $tel,
            'genero' => $genero,
=======
>>>>>>> f4d0321393a89c89697f4334f12a979a84622d46
            'idusuario' => $idusuario
        ]);
    }
}
