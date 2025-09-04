<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '/../models/Perfil.php';
require_once __DIR__ . '/../controllers/permissaoController.php';
require_once __DIR__ . '/../models/Aluno.php';
require_once __DIR__ . '/../models/Docente.php';
require_once __DIR__ . '/AlunoController.php';
require_once __DIR__ . '/DocenteController.php';

class PerfilController {

    private $modelPerfil;

    public function __construct() {
        validarNivel("2"); // só usuários nível 2 podem acessar
        $this->modelPerfil = new Perfil();
    }

    // ====================== UPLOAD DE FOTOS ======================
    private function processarFotos($tipo, $dados) {
        $fotos = [];
        $pastaUpload = __DIR__ . "/../../uploads/" . ($tipo === 'aluno' ? "alunos/" : "docentes/");
        if (!is_dir($pastaUpload)) mkdir($pastaUpload, 0777, true);

        foreach (['foto_oficial','foto_social','foto_avatar'] as $campo) {
            // Se veio novo arquivo
            if (isset($_FILES[$campo]) && $_FILES[$campo]['error'] === UPLOAD_ERR_OK) {
                $nomeArquivo = uniqid() . "_" . basename($_FILES[$campo]['name']);
                $destino = $pastaUpload . $nomeArquivo;
                if (!move_uploaded_file($_FILES[$campo]['tmp_name'], $destino)) {
                    throw new Exception("Erro ao mover arquivo $campo para $destino");
                }
            $$fotos[$campo] = '/uploads/' . ($tipo === 'aluno' ? 'alunos/' : 'docentes/') . $nomeArquivo;

            } 
            // Senão, mantem existente
            else {
                $fotos[$campo] = $dados[$campo . '_existente'] ?? null;
            }
        }

        return $fotos;
    }

    // ====================== PERFIS ALUNO ======================
    public function salvar_perfil_aluno($dados) {
        try {
            $fotos = $this->processarFotos('aluno', $dados);
            $dados['foto_oficial'] = $fotos['foto_oficial'];
            $dados['foto_social']  = $fotos['foto_social'];
            $dados['foto_avatar']  = $fotos['foto_avatar'];

            $this->modelPerfil->salvar_perfil_aluno($dados);
            $_SESSION['sucesso'] = 'Perfil de aluno salvo com sucesso.';
        } catch (Exception $e) {
            $_SESSION['exception'] = $e->getMessage();
            header('Location: index.php?page=perfil/form');
            exit;
        }

        header('Location: index.php?page=perfil');
        exit;
    }

    public function listar_perfis_aluno($inicio = null, $quantidade = null) {
        return $this->modelPerfil->listar_perfis_aluno($inicio, $quantidade);
    }

    public function excluir_perfil_aluno($idperfil) {
        try {
            $this->modelPerfil->excluir_perfil_aluno($idperfil);
            $_SESSION['sucesso'] = "Perfil de aluno excluído com sucesso.";
        } catch (Exception $e) {
            $_SESSION['exception'] = "Erro ao excluir perfil de aluno: " . $e->getMessage();
        }
        header('Location: index.php?page=perfil');
        exit;
    }

    // ====================== PERFIS DOCENTE ======================
    public function salvar_perfil_docente($dados) {
        try {
            $fotos = $this->processarFotos('docente', $dados);
            $dados['foto_oficial'] = $fotos['foto_oficial'];
            $dados['foto_social']  = $fotos['foto_social'];
            $dados['foto_avatar']  = $fotos['foto_avatar'];

            $this->modelPerfil->salvar_perfil_docente($dados);
            $_SESSION['sucesso'] = 'Perfil de docente salvo com sucesso.';
        } catch (Exception $e) {
            $_SESSION['exception'] = $e->getMessage();
            header('Location: index.php?page=perfil/form');
            exit;
        }

        header('Location: index.php?page=perfil');
        exit;
    }

    public function listar_perfis_docente($inicio = null, $quantidade = null) {
        return $this->modelPerfil->listar_perfis_docente($inicio, $quantidade);
    }

    public function excluir_perfil_docente($id_perfildocente) {
        try {
            $this->modelPerfil->excluir_perfil_docente($id_perfildocente);
            $_SESSION['sucesso'] = "Perfil de docente excluído com sucesso.";
        } catch (Exception $e) {
            $_SESSION['exception'] = "Erro ao excluir perfil de docente: " . $e->getMessage();
        }
        header('Location: index.php?page=perfil');
        exit;
    }

    // ====================== MÉTODO GENÉRICO ======================
    public function excluir($id, $tipo = 'aluno') {
        if ($tipo === 'docente') {
            $this->excluir_perfil_docente($id);
        } else {
            $this->excluir_perfil_aluno($id);
        }
    }

    public function index($tipo = 'aluno', $inicio = null, $quantidade = null) {
        if ($tipo === 'todos') {
            $alunos = $this->listar_perfis_aluno($inicio, $quantidade);
            $docentes = $this->listar_perfis_docente($inicio, $quantidade);
            return array_merge($alunos, $docentes);
        }
        return ($tipo === 'docente') 
            ? $this->listar_perfis_docente($inicio, $quantidade) 
            : $this->listar_perfis_aluno($inicio, $quantidade);
    }

    public function contar($tipo = 'aluno') {
        if ($tipo === 'todos') {
            return $this->modelPerfil->contar_total('aluno') + $this->modelPerfil->contar_total('docente');
        }
        return $this->modelPerfil->contar_total($tipo);
    }

    public function editar($id, $tipo = 'aluno') {
        return $this->modelPerfil->buscar_por_id($id, $tipo);
    }

    public function detalhar($id, $tipo = 'aluno') {
        return $this->editar($id, $tipo);
    }

    // ====================== LISTAGEM PARA SELECTS ======================
    public function listar_alunos() {
        $alunoCtrl = new AlunoController();
        return $alunoCtrl->index(); 
    }

    public function listar_docentes() {
        $docenteCtrl = new DocenteController();
        return $docenteCtrl->index(); 
    }
}
?>
