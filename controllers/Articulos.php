<?php
class Articulos extends Controller
{
    protected $marcasModel;
    protected $categoriasModel;

    public function __construct()
    {
        session_start();
        parent::__construct();

        // Cargar modelos adicionales
        $this->marcasModel = $this->model('MarcasModel');
        $this->categoriasModel = $this->model('CategoriasModel');
    }

    public function index()
    {
        // Obtener datos para el modal
        $data['marcas'] = $this->marcasModel->getMarcas();
        $data['categorias'] = $this->categoriasModel->getCategorias();

        // Pasar datos a la vista
        $this->views->getView($this, "listar", $data);
    }

    public function listar()
    {
        $data = $this->model->getArticulos();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
}