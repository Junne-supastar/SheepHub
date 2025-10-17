<<<<<<< HEAD
    <?php
    require_once __DIR__ . '/../config/Conexao.php';

    class PerfilInstituicao {
        private $conn;

        public function __construct() {
            $this->conn = Conexao::getConexao();
        }

        /** Retorna dados do usuário */
        public function getUsuario($idusuario) {
            $sql = "SELECT u.*, n.nome AS nivel_nome
                    FROM usuario u
                    JOIN niveis_usuario n ON u.nivel = n.id_nivelusu
                    WHERE u.idusuario = :idusuario";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['idusuario' => $idusuario]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        /** Retorna perfil da instituição */
        public function getPerfilInstituicao($idusuario) {
            $stmt = $this->conn->prepare("SELECT * FROM perfil_instituicao WHERE idusuario = :idusuario");
            $stmt->execute(['idusuario' => $idusuario]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        /** Insere perfil de instituição */
        public function insertPerfilInstituicao($idusuario, $cnpj, $cep, $telefone, $site, $descricao, $redes_sociais, $foto_perfil, $foto_fundo) {
            $sql = "INSERT INTO perfil_instituicao
                    (idusuario, cnpj, cep, telefone, site, descricao, redes_sociais, foto_perfil, foto_fundo)
                    VALUES (:idusuario, :cnpj, :cep, :telefone, :site, :descricao, :redes_sociais, :foto_perfil, :foto_fundo)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                'idusuario'     => $idusuario,
                'cnpj'          => $cnpj,
                'cep'           => empty($cep) ? null : $cep,
                'telefone'      => $telefone,
                'site'          => $site,
                'descricao'     => $descricao,
                'redes_sociais' => $redes_sociais,
                'foto_perfil'   => $foto_perfil,
                'foto_fundo'    => $foto_fundo
            ]);
        }

        /** Atualiza perfil de instituição */
        public function updatePerfilInstituicao($idusuario, $cnpj, $cep, $telefone, $site, $descricao, $redes_sociais, $foto_perfil, $foto_fundo) {
            $campos = [
                'cnpj = :cnpj',
                'cep = :cep',
                'telefone = :telefone',
                'site = :site',
                'descricao = :descricao',
                'redes_sociais = :redes_sociais',
                'foto_perfil = :foto_perfil',
                'foto_fundo = :foto_fundo'
            ];
            $params = [
                'idusuario'     => $idusuario,
                'cnpj'          => $cnpj,
                'cep'           => $cep,
                'telefone'      => $telefone,
                'site'          => $site,
                'descricao'     => $descricao,
                'redes_sociais' => $redes_sociais,
                'foto_perfil'   => $foto_perfil,
                'foto_fundo'    => $foto_fundo
            ];

            $sql = "UPDATE perfil_instituicao SET " . implode(', ', $campos) . " WHERE idusuario = :idusuario";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute($params);
        }

        /** Salva a primeira etapa do cadastro */
        public function salvarBasico($idusuario, $cnpj, $cep, $telefone, $site) {
            $sql = "UPDATE perfil_instituicao
                    SET cnpj = :cnpj,
                        cep = :cep,
                        telefone = :telefone,
                        site = :site
                    WHERE idusuario = :idusuario";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'cnpj'      => $cnpj,
                'cep'       => $cep,
                'telefone'  => $telefone,
                'site'      => $site,
                'idusuario' => $idusuario
            ]);
        }
    }
=======
<?php
require_once __DIR__ . '/../config/Conexao.php';

class PerfilInstituicao {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao();
    }

    /** Retorna dados básicos do usuário */
    public function getUsuario($idusuario) {
        $sql = "SELECT u.*, n.nome AS nivel_nome
                FROM usuario u
                LEFT JOIN niveis_usuario n ON u.nivel = n.id_nivelusu
                WHERE u.idusuario = :idusuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['idusuario' => $idusuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /** Retorna perfil completo da instituição */
    public function getPerfilInstituicao($idusuario) {
        $sql = "SELECT pi.*, u.nome, u.username, u.email, n.nome AS nivel_nome,
                       l.logradouro, l.bairro, l.cidade, l.uf,
                       ui.telefone
                FROM perfil_instituicao pi
                LEFT JOIN usuario u ON pi.idusuario = u.idusuario
                LEFT JOIN niveis_usuario n ON u.nivel = n.id_nivelusu
                LEFT JOIN localidade l ON pi.cep = l.cep
                LEFT JOIN usuario_instituicao ui ON pi.idusuario = ui.idusuario
                WHERE pi.idusuario = :idusuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['idusuario' => $idusuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /** Insere novo perfil de instituição */
    public function insertPerfilInstituicao($idusuario, $cnpj, $cep, $site, $descricao, $redes_sociais, $foto_perfil, $foto_fundo) {
        $sql = "INSERT INTO perfil_instituicao 
                    (idusuario, cnpj, cep, site, descricao, redes_sociais, foto_perfil, foto_fundo)
                VALUES 
                    (:idusuario, :cnpj, :cep, :site, :descricao, :redes_sociais, :foto_perfil, :foto_fundo)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'idusuario' => $idusuario,
            'cnpj' => $cnpj,
            'cep' => $cep,
            'site' => $site,
            'descricao' => $descricao,
            'redes_sociais' => $redes_sociais,
            'foto_perfil' => $foto_perfil,
            'foto_fundo' => $foto_fundo
        ]);
    }

    /** Atualiza dados do perfil da instituição */
    public function updatePerfilInstituicao($idusuario, $dados) {
        $campos = [];
        $params = ['idusuario' => $idusuario];

        foreach ($dados as $coluna => $valor) {
            if ($valor !== null && $valor !== '') {
                $campos[] = "$coluna = :$coluna";
                $params[$coluna] = $valor;
            }
        }

        if (empty($campos)) return false;

        $sql = "UPDATE perfil_instituicao SET " . implode(', ', $campos) . " WHERE idusuario = :idusuario";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }

    /** Retorna informações completas (perfil + endereço + nível + telefone) */
    public function getPerfilCompleto($idusuario) {
        $sql = "SELECT u.idusuario, u.nome, u.username, u.email, u.dt_criacao,
                       n.nome AS nivel_nome,
                       pi.cnpj, pi.cep, pi.site, pi.descricao, pi.redes_sociais,
                       pi.foto_perfil, pi.foto_fundo,
                       l.logradouro, l.bairro, l.cidade, l.uf,
                       ui.telefone
                FROM usuario u
                LEFT JOIN niveis_usuario n ON u.nivel = n.id_nivelusu
                LEFT JOIN perfil_instituicao pi ON u.idusuario = pi.idusuario
                LEFT JOIN localidade l ON pi.cep = l.cep
                LEFT JOIN usuario_instituicao ui ON u.idusuario = ui.idusuario
                WHERE u.idusuario = :idusuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['idusuario' => $idusuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /** Salva etapa básica do cadastro */
    public function salvarBasico($idusuario, $cnpj, $cep, $telefone, $site) {
        // Atualiza telefone na tabela usuario_instituicao
        $sql_ui = "UPDATE usuario_instituicao
                   SET telefone = :telefone
                   WHERE idusuario = :idusuario";
        $stmt_ui = $this->conn->prepare($sql_ui);
        $stmt_ui->execute([
            'idusuario' => $idusuario,
            'telefone' => $telefone
        ]);

        // Atualiza dados do perfil
        $sql_pi = "UPDATE perfil_instituicao
                   SET cnpj = :cnpj, cep = :cep, site = :site
                   WHERE idusuario = :idusuario";
        $stmt_pi = $this->conn->prepare($sql_pi);
        return $stmt_pi->execute([
            'idusuario' => $idusuario,
            'cnpj' => $cnpj,
            'cep' => $cep,
            'site' => $site
        ]);
    }
}
>>>>>>> f4d0321393a89c89697f4334f12a979a84622d46
