<?php

class Marcas extends Controller
{

    public function __construct()
    {
        session_start();
        parent::__construct();

        // Cargar modelos adicionales usando el método model() del padre
        //$this->marcasModel = $this->model('MarcasModel');
    }

    public function index()
    {
        $this->views->getView($this, "listar");
    }

    public function listar()
    {
        $data = $this->model->getMarcas();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

}