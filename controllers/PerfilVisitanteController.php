<?php
require_once __DIR__ . '/../models/PerfilVisitante.php';

class PerfilVisitanteController {
    public $model;

    public function __construct($model = null) {
        $this->model = $model ?? new PerfilVisitante();
    }

    /** Exibe o perfil do visitante */
    public function verPerfil($idusuario) {
        $perfilCompleto = $this->model->getPerfilCompleto($idusuario);

        if (!$perfilCompleto) {
            header("Location: /SheepHub/rotas/cadastro-perfil-visitante.php");
            exit;
        }

        include __DIR__ . '/../views/perfil-visitante.php';
    }

    /** Salva os dados completos do perfil (segunda etapa) */
    public function salvarPerfil($postData, $fileData) {
        $idusuario = $postData['idusuario'];
        $descricao = $postData['descricao'] ?? '';
        $cep = $postData['cep'] ?? null;
        $redes_sociais = $postData['redes_sociais'] ?? '';

        $foto_perfil = isset($fileData['foto_perfil']) ? $this->uploadArquivo($fileData['foto_perfil']) : null;
        $foto_fundo  = isset($fileData['foto_fundo']) ? $this->uploadArquivo($fileData['foto_fundo']) : null;

        $perfilExistente = $this->model->getPerfilVisitante($idusuario);

        $dados = [
            'descricao' => $descricao,
            'cep' => $cep,
            'redes_sociais' => $redes_sociais,
            'foto_perfil' => $foto_perfil,
            'foto_fundo' => $foto_fundo
        ];

        if ($perfilExistente) {
            $this->model->updatePerfilVisitante($idusuario, $dados);
        } else {
            $this->model->insertPerfilVisitante($idusuario, $descricao, $cep, $foto_perfil, $foto_fundo, $redes_sociais);
        }

        header("Location: /SheepHub/views/perfil-visitante.php?id=$idusuario");
        exit;
    }

    /** Salva a primeira etapa do perfil (básica) */
    public function salvarDadosBasicos($dados) {
        $idusuario = $dados['idusuario'];
        $cep = trim($dados['cep'] ?? null);

        $perfilExistente = $this->model->getPerfilVisitante($idusuario);

        if (!$perfilExistente) {
            $this->model->insertPerfilVisitante($idusuario, '', $cep);
        } else {
            $this->model->salvarBasico($idusuario, $cep);
        }

        header("Location: /SheepHub/views/perfil-visitante-estilo.php");
        exit;
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
