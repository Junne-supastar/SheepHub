<<<<<<< HEAD
    <?php
    require_once __DIR__ . '/../models/PerfilInstituicao.php';
require_once __DIR__ . '/../models/Localidade.php';

    class PerfilInstituicaoController {
        public $model;

        public function __construct() {
            $this->model = new PerfilInstituicao();
        }

        /** Exibe o perfil da instituição */
        public function verPerfil($idusuario) {
            $usuario = $this->model->getUsuario($idusuario);
            $perfil = $this->model->getPerfilInstituicao($idusuario);

            if (!$perfil) {
                header("Location: /SheepHub/rotas/cadastro-perfil-instituicao-salvar.php");
                exit;
            }

            include __DIR__ . '/../views/perfil-lider.php';
        }

        /** Salva os dados completos do perfil (segunda etapa) */
public function salvarPerfil($postData, $fileData) {
    $idusuario = $postData["idusuario"];

    $cnpj        = $postData["cnpj"] ?? "";
    $cep         = $postData["cep"] ?? "";
    $telefone    = $postData["telefone"] ?? "";
    $site        = $postData["site"] ?? "";
    $descricao   = $postData["descricao"] ?? "";
    $redes_sociais = $postData["redes_sociais"] ?? "";

    // Lógica para o CEP
    if (!empty($cep)) {
        $localidadeModel = new Localidade(); // Supondo que você tenha um model para a tabela localidade
        if (!$localidadeModel->cepExists($cep)) {
            // Se o CEP não existe, você pode optar por:
            // 1. Adicionar o CEP à tabela localidade (requer dados de logradouro, etc.)
            // 2. Retornar um erro para o usuário
            // 3. Deixar o campo CEP como nulo no perfil
            // Por enquanto, vamos deixar como nulo para evitar o erro
            $cep = null;
        }
    }

    // Captura arquivos enviados (se houver)
    $foto_perfil = isset($fileData["foto_perfil"]) && $fileData["foto_perfil"]["error"] === 0 ? $this->uploadArquivo($fileData["foto_perfil"]) : null;
    $foto_fundo  = isset($fileData["foto_fundo"]) && $fileData["foto_fundo"]["error"] === 0 ? $this->uploadArquivo($fileData["foto_fundo"]) : null;

    $perfilExistente = $this->model->getPerfilInstituicao($idusuario);

    if ($perfilExistente) {
        if (!$foto_perfil) $foto_perfil = $perfilExistente["foto_perfil"];
        if (!$foto_fundo)  $foto_fundo  = $perfilExistente["foto_fundo"];

        $this->model->updatePerfilInstituicao($idusuario, $cnpj, $cep, $telefone, $site, $descricao, $redes_sociais, $foto_perfil, $foto_fundo);
    } else {
        $this->model->insertPerfilInstituicao($idusuario, $cnpj, $cep, $telefone, $site, $descricao, $redes_sociais, $foto_perfil, $foto_fundo);
    }

    header("Location: /SheepHub/views/perfil-lider.php?id=$idusuario");
    exit;
}

        /** Salva os dados básicos do perfil (primeira etapa) */public function salvarDadosBasicos($dados) {
        $idusuario = $dados['idusuario'];
        $cnpj = trim($dados['cnpj'] ?? '');
        $cep = trim($dados['cep'] ?? '');
        $telefone = trim($dados['telefone'] ?? '');
        $site = trim($dados['site'] ?? ''); 

        $perfilExistente = $this->model->getPerfilInstituicao($idusuario);
        if (!$perfilExistente) {
            // Cria o perfil vazio (como no membro)
            $this->model->insertPerfilInstituicao($idusuario, $cnpj, $cep, $telefone, $site, '', '', null, null);
        }

        // Atualiza os dados básicos
        $this->model->salvarBasico($idusuario, $cnpj, $cep, $telefone, $site);
    }
        /** Upload de arquivos (avatar/banner) */
        private function uploadArquivo($arquivo) {
            if ($arquivo && $arquivo['error'] === 0) {
                $nome = uniqid() . '_' . basename($arquivo['name']);
                $pastaDestino = __DIR__ . '/../views/assets/uploads/' . $nome;

                if (!is_dir(__DIR__ . '/../views/assets/uploads')) {
                    mkdir(__DIR__ . '/../views/assets/uploads', 0755, true);
                }

                move_uploaded_file($arquivo['tmp_name'], $pastaDestino);
                return $nome;
            }
            return null;
        }
    }
=======
<?php
require_once __DIR__ . '/../models/PerfilInstituicao.php';

/**
 * Controller responsável por gerenciar perfis de instituições (usuários tipo "líder").
 */
class PerfilInstituicaoController {
    public $model;

    /**
     * Construtor
     * @param PerfilInstituicao|null $model Modelo de perfil de instituição
     */
    public function __construct($model = null) {
        $this->model = $model ?? new PerfilInstituicao();
    }

    /**
     * Exibe o perfil da instituição.
     * Redireciona para cadastro se o perfil ainda não existir.
     * @param int $idusuario
     */
    public function verPerfil($idusuario) {
        $perfilCompleto = $this->model->getPerfilInstituicao($idusuario);

        if (!$perfilCompleto) {
            header("Location: /SheepHub/rotas/cadastro-perfil-instituicao-salvar.php");
            exit;
        }

        // A view receberá $perfilCompleto
        include __DIR__ . '/../views/perfil-lider.php';
    }

    /**
     * Salva os dados completos do perfil (segunda etapa).
     * Cria ou atualiza o registro conforme necessário.
     * @param array $postData
     * @param array $fileData
     */
    public function salvarPerfil($postData, $fileData) {
        $idusuario = $postData['idusuario'];
        $cnpj = $postData['cnpj'] ?? '';
        $cep = $postData['cep'] ?? '';
        $telefone = $postData['telefone'] ?? '';
        $site = $postData['site'] ?? '';
        $descricao = $postData['descricao'] ?? '';
        $redes_sociais = $postData['redes_sociais'] ?? '';

        // Upload de arquivos
        $foto_perfil = isset($fileData['foto_perfil']) ? $this->uploadArquivo($fileData['foto_perfil']) : null;
        $foto_fundo  = isset($fileData['foto_fundo']) ? $this->uploadArquivo($fileData['foto_fundo']) : null;

        $perfilExistente = $this->model->getPerfilInstituicao($idusuario);

        if ($perfilExistente) {
            // Mantém as fotos antigas se não houver upload novo
            if (!$foto_perfil) $foto_perfil = $perfilExistente['foto_perfil'];
            if (!$foto_fundo)  $foto_fundo  = $perfilExistente['foto_fundo'];

            $this->model->updatePerfilInstituicao(
                $idusuario, 
                [
                    'cnpj' => $cnpj,
                    'cep' => $cep,
                    'telefone' => $telefone,
                    'site' => $site,
                    'descricao' => $descricao,
                    'redes_sociais' => $redes_sociais,
                    'foto_perfil' => $foto_perfil,
                    'foto_fundo' => $foto_fundo
                ]
            );
        } else {
            $this->model->insertPerfilInstituicao(
                $idusuario, $cnpj, $cep, $telefone, $site, $descricao, $redes_sociais, $foto_perfil, $foto_fundo
            );
        }

        header("Location: /SheepHub/views/perfil-lider.php?id=$idusuario");
        exit;
    }

    /**
     * Salva os dados básicos do perfil (primeira etapa).
     * Cria o registro se não existir.
     * @param array $dados
     */
    public function salvarDadosBasicos($dados) {
        $idusuario = $dados['idusuario'];
        $cnpj = trim($dados['cnpj']);
        $cep = trim($dados['cep']);
        $telefone = trim($dados['telefone']);
        $site = trim($dados['site']);

        $perfilExistente = $this->model->getPerfilInstituicao($idusuario);

        if (!$perfilExistente) {
            $this->model->insertPerfilInstituicao(
                $idusuario, $cnpj, $cep, $telefone, $site, '', '', null, null
            );
        }

        $this->model->salvarBasico($idusuario, $cnpj, $cep, $telefone, $site);

        header("Location: /SheepHub/views/perfil-instituicao-estilo.php");
        exit;
    }

    /**
     * Realiza upload de arquivos (avatar/banner).
     * @param array $arquivo $_FILES['campo']
     * @return string|null Nome do arquivo salvo ou null
     */
    private function uploadArquivo($arquivo) {
        if ($arquivo && $arquivo['error'] === 0) {
            $nome = uniqid() . '_' . basename($arquivo['name']);
            $pastaDestino = __DIR__ . '/../views/assets/uploads/' . $nome;

            if (!is_dir(__DIR__ . '/../views/assets/uploads')) {
                mkdir(__DIR__ . '/../views/assets/uploads', 0755, true);
            }

            move_uploaded_file($arquivo['tmp_name'], $pastaDestino);
            return $nome;
        }
        return null;
    }
}
>>>>>>> f4d0321393a89c89697f4334f12a979a84622d46
