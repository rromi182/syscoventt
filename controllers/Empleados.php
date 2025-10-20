<?php
class Empleados extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }

    // Método para obtener información de un empleado específico
    public function obtenerEmpleado()
    {
        // Permitir tanto POST como GET
        $id_empleado = $_POST['id_empleado'] ?? $_GET['id_empleado'] ?? null;
        
        if ($id_empleado) {
            // Obtener datos del empleado
            $empleado = $this->model->getEmpleadoById($id_empleado);
            
            if ($empleado) {
                $data = array(
                    'estado' => 'success',
                    'data' => array(
                        'id_empleado' => $empleado['id_empleado'],
                        'per_nombre' => $empleado['per_nombre'],
                        'per_apellido' => $empleado['per_apellido'],
                        'nombre_completo' => $empleado['per_nombre'] . ' ' . $empleado['per_apellido'],
                        'cargo' => $empleado['cargo'],
                        'email' => $empleado['per_correo']
                    )
                );
            } else {
                $data = array(
                    'estado' => 'error',
                    'mensaje' => 'Empleado no encontrado'
                );
            }
            
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        } else {
            $data = array(
                'estado' => 'error',
                'mensaje' => 'ID de empleado no proporcionado'
            );
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    // Método para obtener empleados sin usuario
    public function listarSinUsuario()
    {
        $empleados = $this->model->getEmpleadosSinUsuario();
        echo json_encode($empleados, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>