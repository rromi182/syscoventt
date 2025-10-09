<?php 
class Controller{

    protected $model;
    protected $views;

    public function __construct(){

        $this->views = new Views();
        $this->cargarModel();
    }

    public function cargarModel(){
        $model = get_class($this)."Model";
        $ruta = "models/".$model.".php";
        if(file_exists($ruta)){
            require_once $ruta;
            $this->model = new $model();
        }
    }

    public function model($modelName){
        $ruta = "models/".$modelName.".php";
        if(file_exists($ruta)){
            require_once $ruta;
            return new $modelName();
        } else {
            throw new Exception("Modelo {$modelName} no encontrado");
        }
    }

    public function verificarSesion() {
        if (!isset($_SESSION['id_user']) || empty($_SESSION['id_user'])) {
            // Si es una petición AJAX, responder con JSON
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                http_response_code(401); // Unauthorized
                echo json_encode(["error" => "Sesión expirada", "redirect" => BASE_URL]);
                exit();
            } else {
                // Si es una petición normal, redirigir
                header("Location: " . BASE_URL);
                exit();
            }
        }
    }
}