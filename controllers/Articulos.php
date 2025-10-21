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

    public function agregar()
{


    if ($_POST) {
        $codigo = strtoupper(trim($_POST['codigo']));
        $descripcion = strtoupper(trim($_POST['descripcion']));
        $precio = $_POST['precio'];
        $stock_minimo = $_POST['stock_minimo'];
        $id_marca = $_POST['id_marca'];
        $id_categoria = $_POST['id_categoria'];
        $estado = 'ACTIVO';

        // Validar campos requeridos
        if (empty($codigo) || empty($descripcion) || empty($precio) || empty($stock_minimo) || empty($id_marca) || empty($id_categoria)) {
            echo json_encode("Todos los campos son obligatorios.", JSON_UNESCAPED_UNICODE);
            die();
        }

        // Validar que el precio sea mayor a 0
        if ($precio <= 0) {
            echo json_encode("El precio debe ser mayor a 0.", JSON_UNESCAPED_UNICODE);
            die();
        }

        // Validar que el stock sea mayor a 0
        if ($stock_minimo <= 0) {
            echo json_encode("El stock mínimo debe ser mayor a 0.", JSON_UNESCAPED_UNICODE);
            die();
        }

        // Verificar si el código ya existe
        $codigoExistente = $this->model->verificarCodigo($codigo);
        if ($codigoExistente) {
            echo json_encode("El código ya existe en el sistema.", JSON_UNESCAPED_UNICODE);
            die();
        }

        // Verificar si la descripción ya existe
        $descripcionExistente = $this->model->verificarDescripcion($descripcion);
        if ($descripcionExistente) {
            echo json_encode("La descripción ya existe en el sistema.", JSON_UNESCAPED_UNICODE);
            die();
        }

        // Manejar la imagen
         $foto = 'no-image.jpg'; // Valor por defecto

            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $archivo = $_FILES['imagen'];
                $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
                $extension = strtolower($extension);

                // Validar extensión
                $extensionesPermitidas = ['jpg', 'jpeg', 'png'];
                if (in_array($extension, $extensionesPermitidas)) {
                    // Validar tamaño (2MB)
                    if ($archivo['size'] <= 2 * 1024 * 1024) {
                        // Generar nombre único
                        $foto = 'articulo_' . time() . '_' . uniqid() . '.' . $extension;
                        $rutaDestino = 'assets/img/articulos/' . $foto;

                        // Mover el archivo
                        move_uploaded_file($archivo['tmp_name'], $rutaDestino);
                    }
                }
            }

        $data = $this->model->agregar($codigo, $descripcion, $precio, $foto, $stock_minimo, $id_marca, $id_categoria, $estado);
        
        if ($data == 'Ok') {
            $msg = "Success";
        } else {
            $msg = "Error al guardar el artículo";
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}

    public function verificarCodigo()
{
    if ($_POST && isset($_POST['codigo'])) {
        $codigo = trim($_POST['codigo']);
        
        if (empty($codigo)) {
            echo json_encode(['existe' => false]);
            die();
        }
        
        // Verificar si el código ya existe
        $existe = $this->model->verificarCodigo($codigo);
        
        // Devolver true/false en lugar del objeto completo
        echo json_encode(['existe' => !empty($existe)]);
        die();
    }
    
    echo json_encode(['existe' => false]);
    die();
}

}
