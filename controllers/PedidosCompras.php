<?php

class PedidosCompras extends Controller
{

    protected $sucursalesModel;
     protected $pedidosComprasModel;

    public function __construct()
    {
        session_start();
        parent::__construct();

        // Cargar modelos adicionales usando el método model() del padre
        $this->sucursalesModel = $this->model('SucursalesModel');
        $this->pedidosComprasModel = $this->model('PedidosComprasModel');
    }

    public function index()
    {
        // Obtener datos usando los modelos ya cargados
        //$data['empleados'] = $this->empleadosModel->getEmpleadosSinUsuario();
        $data['sucursales'] = $this->sucursalesModel->getSucursales();
        $data['pedidos'] = $this->pedidosComprasModel->getPedidosCompras();
        $this->views->getView($this, "listar", $data);
    }

     public function listar()
    {
        $data = $this->pedidosComprasModel->getPedidosCompras();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}