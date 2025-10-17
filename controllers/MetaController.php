<?php
require_once __DIR__ . '/../models/Meta.php';

class MetaController {
    private $model;

    public function __construct() {
        $this->model = new Meta();
    }

    
    // Listar todas as metas do usuário logado (MANTIDO)
    public function listar() {
        $id_usuario = $_SESSION['id_usuario'] ?? 1;
        return $this->model->getAllByUser($id_usuario);
    }
    
    // Novo: Buscar uma meta específica (MANTIDO)
    public function buscarMetaPorId($id_meta) {
        return $this->model->getById($id_meta);
    }

    // Processa o POST de criação (Chamado por cadastroMeta.php)
    // RECEBE OS VALORES LIMPOS COMO PARÂMETROS
    public function criarMeta($nome, $icone, $objetivo, $investimento) {
        $id_usuario = $_SESSION['id_usuario'] ?? 1;
        // Os parâmetros $objetivo e $investimento JÁ SÃO floats
        
        $id_status = 3; // Pendente

        // Seu model original já lida com o status 3 (Pendente)
        $this->model->criar($id_usuario, $nome, $icone, $objetivo, $investimento);
        // O redirecionamento será feito pela view ou pelo router
    }

    // Processa o POST de edição (Chamado por cadastroMeta.php)
    // RECEBE OS VALORES LIMPOS COMO PARÂMETROS
    public function editarMeta($id_meta, $nome, $icone, $objetivo, $investimento) {
        // Os parâmetros $objetivo e $investimento JÁ SÃO floats

        // Calcula o progresso com os valores numéricos corretos
        $progresso = ($objetivo > 0) ? ($investimento / $objetivo) * 100 : 0;
        $id_status = ($progresso >= 100) ? 4 : 3; // 4 = Concluído, 3 = Pendente

        // Chama o model com os parâmetros corretos
        $this->model->editar($id_meta, $nome, $icone, $objetivo, $investimento, $id_status);
        // O redirecionamento será feito pela view ou pelo router
    }
    
    // Processa a exclusão (Chamado por router.php) (MANTIDO)
    public function excluirMeta($id_meta) {
        $this->model->excluir($id_meta);
    }

    // Novo: Método para concluir uma meta (status 4) (Chamado por router.php) (MANTIDO)
    public function concluirMeta($id_meta) {
        // Busca a meta atual para manter as outras informações
        $meta = $this->model->getById($id_meta);
        
        if ($meta) {
            $this->model->editar(
                $id_meta, 
                $meta['nome_meta'], 
                $meta['icone'], 
                $meta['objetivo'], 
                $meta['investimento'], 
                4 // 4 = Concluída
            );
        }
    }
}