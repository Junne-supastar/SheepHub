<?php
require_once __DIR__ . '/../models/Localidade.php';

class LocalidadeController {
    private $model;

    public function __construct() {
        $this->model = new Localidade();
    }

    public function salvar($dados) {
        return $this->model->salvar($dados);
    }
}
