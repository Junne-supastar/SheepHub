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
