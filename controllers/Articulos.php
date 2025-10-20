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
        // Validar que la solicitud sea POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $response = array('status' => false, 'msg' => 'Método no permitido');
            header('Content-Type: application/json');
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            die();
        }

        try {
            // Obtener y limpiar datos del formulario
            $codigo = strtoupper(trim($_POST['codigo'] ?? ''));
            $descripcion = trim($_POST['descripcion'] ?? '');
            $precio = isset($_POST['precio']) ? floatval(str_replace('.', '', $_POST['precio'])) : 0;
            $stock = intval($_POST['stock'] ?? 0);
            $id_marca = intval($_POST['id_marca'] ?? 0);
            $id_categoria = intval($_POST['id_categoria'] ?? 0);
            $imagen = $_FILES['imagen'] ?? null;

            // Validaciones básicas
            if (empty($codigo) || empty($descripcion) || $precio <= 0 || $stock < 0 || $id_marca <= 0 || $id_categoria <= 0) {
                throw new Exception('Todos los campos son obligatorios y deben ser válidos');
            }

            // Validar longitud del código
            if (strlen($codigo) > 20) {
                throw new Exception('El código no puede tener más de 20 caracteres');
            }

            // Verificar si el código ya existe
            $codigoExiste = $this->model->verificarCodigo($codigo);
            if ($codigoExiste) {
                throw new Exception('El código del artículo ya existe');
            }

            // Verificar si la descripción ya existe
            $descripcionExiste = $this->model->verificarDescripcion($descripcion);
            if ($descripcionExiste) {
                throw new Exception('La descripción del artículo ya existe');
            }

            // Validar marca existente
            $marcaExiste = $this->marcasModel->getMarcaById($id_marca);
            if (!$marcaExiste) {
                throw new Exception('La marca seleccionada no existe');
            }

            // Validar categoría existente
            $categoriaExiste = $this->categoriasModel->getCategoriaById($id_categoria);
            if (!$categoriaExiste) {
                throw new Exception('La categoría seleccionada no existe');
            }

            // Procesar imagen si se subió
            $nombreImagen = '';
            if ($imagen && $imagen['error'] === UPLOAD_ERR_OK) {
                $nombreImagen = $this->procesarImagen($imagen, $codigo);
            }

            // Insertar el artículo
            $result = $this->model->insertarArticulo($codigo, $descripcion, $precio, $nombreImagen, $stock, $id_marca, $id_categoria);

            if ($result > 0) {
                $response = array('status' => true, 'msg' => 'Artículo guardado correctamente');
            } else {
                throw new Exception('Error al guardar el artículo en la base de datos');
            }
        } catch (Exception $e) {
            $response = array('status' => false, 'msg' => $e->getMessage());
        }

        header('Content-Type: application/json');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
    }

    // Función para procesar la imagen
    private function procesarImagen($imagen, $codigoArticulo)
    {
        // Configuración
        $directorio = 'assets/img/articulos/';
        $maxSize = 2 * 1024 * 1024; // 2MB
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];

        // Validar tipo de archivo
        if (!in_array($imagen['type'], $allowedTypes)) {
            throw new Exception('Solo se permiten archivos JPG, JPEG y PNG');
        }

        // Validar tamaño
        if ($imagen['size'] > $maxSize) {
            throw new Exception('La imagen no puede exceder los 2MB');
        }

        // Obtener extensión del archivo
        $extension = pathinfo($imagen['name'], PATHINFO_EXTENSION);

        // Crear nombre único para la imagen (usando el código del artículo y timestamp)
        $nombreArchivo = $codigoArticulo . '_' . time() . '.' . strtolower($extension);
        $rutaCompleta = $directorio . $nombreArchivo;

        // Crear directorio si no existe
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755, true);
        }

        // Mover archivo al directorio
        if (move_uploaded_file($imagen['tmp_name'], $rutaCompleta)) {
            return $nombreArchivo;
        } else {
            throw new Exception('Error al subir la imagen');
        }
    }
}
