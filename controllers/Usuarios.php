<?php

class Usuarios extends Controller
{

    protected $empleadosModel;
    protected $sucursalesModel;

    public function __construct()
    {
        session_start();
        parent::__construct();

        // Cargar modelos adicionales usando el método model() del padre
        $this->empleadosModel = $this->model('EmpleadosModel');
        $this->sucursalesModel = $this->model('SucursalesModel');
    }

    public function index()
    {
        // Obtener datos usando los modelos ya cargados
        $data['empleados'] = $this->empleadosModel->getEmpleadosSinUsuario();
        $data['sucursales'] = $this->sucursalesModel->getSucursales();

        // Pasar datos a la vista
        $this->views->getView($this, "listar", $data);
        //$this->views->getView($this, "listar");
    }

    public function listar()
    {
        $data = $this->model->getUsuarios();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function validar()
    {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            echo json_encode("Por favor completa todos los campos.", JSON_UNESCAPED_UNICODE);
            die();
        }

        $username = $_POST['username'];
        $password = md5($_POST['password']);

        // Primero verificar si el usuario existe y sus intentos
        $usuarioInfo = $this->model->getUsuarioPorUsername($username);

        if ($usuarioInfo) {
            // Verificar si ha excedido los intentos (3 intentos máximo)
            if ($usuarioInfo['intentos_fallidos'] >= 3) {
                echo json_encode("Cuenta bloqueada. Ha excedido el número máximo de intentos, contacte con el Administrador de Sistemas.", JSON_UNESCAPED_UNICODE);
                die();
            }
        }

        // Validar credenciales
        $data = $this->model->getUsuario($username, $password);

        if ($data) {
            // Login exitoso - resetear intentos
            $this->model->resetearIntentos($username);

            $_SESSION['id_user'] = $data['id_user'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['foto'] = $data['foto'];
            $_SESSION['nombre_completo'] = $data['nombre_completo'];
            $_SESSION['cargo'] = $data['cargo'];
            $_SESSION['sucursal'] = $data['sucursal'];

            // OBTENER PERMISOS DEL USUARIO
            $permisos = $this->model->getPermisosUsuario($data['id_user']);
            $_SESSION['permisos'] = $permisos;

            // Crear array de IDs de permisos para fácil verificación
            $permisos_ids = array_column($permisos, 'id_permiso');
            $_SESSION['permisos_ids'] = $permisos_ids;

            echo json_encode("OK", JSON_UNESCAPED_UNICODE);
        } else {
            // Login fallido - incrementar intentos si el usuario existe
            if ($usuarioInfo) {
                $this->model->incrementarIntentos($username);
                $intentos_restantes = 3 - ($usuarioInfo['intentos_fallidos'] + 1);

                if ($intentos_restantes > 0) {
                    $msg = "Credenciales incorrectas. Te quedan {$intentos_restantes} intentos.";
                } else {
                    $this->model->bloquearUsuario($username);
                    $msg = "Cuenta bloqueada. Ha excedido el número máximo de intentos, contacte con el Administrador de Sistemas.";
                }
            } else {
                $msg = "Credenciales incorrectas.";
            }

            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    //cerrar sesión
    public function logout()
    {
        // Método EXTREMO - elimina completamente la sesión
        $_SESSION = [];

        // Destruir la cookie de sesión
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 100000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
        }

        session_destroy();

        // Redirigir con JavaScript para evitar problemas de headers
        echo "<script>
        localStorage.clear();
        sessionStorage.clear();
        window.location.href = '" . BASE_URL . "';
         </script>";
        exit();
    }
}
