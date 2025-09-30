<?php

require_once __DIR__ . '/../models/Perfil.php';

class PerfilController {
    public $model;

    public function __construct($model) {
        $this->model = $model;
    }

    /** Exibe o perfil do usuário */
    public function verPerfil($idusuario) {
        $usuario = $this->model->getUsuario($idusuario);
        $perfil = $this->model->getPerfilMembro($idusuario);

        if (!$perfil) {
          header("Location: /SheepHub/rotas/cadastro-perfil-salvar.php");
exit;
        }

        include __DIR__ . '/../views/perfil-membro.php';
    }

    /** Salva os dados completos do perfil (segunda etapa) */
    public function salvarPerfil($postData, $fileData) {
        $idusuario = $postData['idusuario'];
        $biografia = $postData['biografia'] ?? '';
        $funcao = $postData['funcao'] ?? '';
        $cep = $postData['cep'] ?? '';
        $redes_sociais = $postData['redes_sociais'] ?? '';

        // Captura arquivos enviados (se houver)
        $foto_perfil = isset($fileData['foto_perfil']) ? $this->uploadArquivo($fileData['foto_perfil']) : null;
        $foto_fundo  = isset($fileData['foto_fundo']) ? $this->uploadArquivo($fileData['foto_fundo']) : null;

        $perfilExistente = $this->model->getPerfilMembro($idusuario);

        if ($perfilExistente) {
            // Se o usuário não enviou novas fotos, mantém as antigas
            if (!$foto_perfil) $foto_perfil = $perfilExistente['foto_perfil'];
            if (!$foto_fundo)  $foto_fundo  = $perfilExistente['foto_fundo'];

            $this->model->updatePerfilMembro($idusuario, $biografia, $funcao, $cep, $redes_sociais, $foto_perfil, $foto_fundo);
        } else {
            $this->model->insertPerfilMembro($idusuario, $biografia, $funcao, $cep, $redes_sociais, $foto_perfil, $foto_fundo);
        }

        header("Location: /SheepHub/views/perfil-membro.php?id=$idusuario");
        exit;
    }

    /** Salva os dados básicos do perfil (primeira etapa) */
    public function salvarDadosBasicos($dados) {
        $idusuario = $dados['idusuario'];
        $cep = trim($dados['cep']);
        $tel = trim($dados['tel']);
        $genero = trim($dados['genero']);

        $perfilExistente = $this->model->getPerfilMembro($idusuario);
        if (!$perfilExistente) {
            $this->model->insertPerfilMembro($idusuario, '', '', $cep, '', null, null);
        }

        $this->model->salvarBasico($idusuario, $cep, $tel, $genero);

        header("Location: /SheepHub/views/PerfilEstilo.php");
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
