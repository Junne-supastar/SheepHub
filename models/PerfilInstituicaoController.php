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
        $localidadeModel = new Localidade();
        if (!$localidadeModel->cepExists($cep)) {
            // Adiciona o CEP na tabela localidade com dados mínimos
            $localidadeModel->insertLocalidade($cep, '', '', '', '');
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

        /** Salva os dados básicos do perfil (primeira etapa) */
public function salvarDadosBasicos($dados) {
    $idusuario = $dados['idusuario'];
    $cnpj = trim($dados['cnpj'] ?? '');
    $cep = trim($dados['cep'] ?? '');
    $telefone = trim($dados['telefone'] ?? '');
    $site = trim($dados['site'] ?? ''); 

    // Lógica para o CEP
    if (!empty($cep)) {
        $localidadeModel = new Localidade();
        if (!$localidadeModel->cepExists($cep)) {
            $localidadeModel->insertLocalidade($cep, '', '', '', '');
        }
    }

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
