<?php
class EmpleadosModel extends Query
{
    public function __construct()
    {
        
        parent::__construct();
    }

    // Obtener empleados activos que no tienen usuario asignado
    public function getEmpleadosSinUsuario()
    {
        $sql = "SELECT 
                    e.id_empleado,
                    p.per_nombre,
                    p.per_apellido,
                    p.per_correo,
                    c.descripcion as cargo
                FROM empleados e
                INNER JOIN personas p ON e.id_persona = p.id_persona
                INNER JOIN cargos c ON e.id_cargo = c.id_cargo
                LEFT JOIN usuarios u ON e.id_empleado = u.id_empleado
                WHERE u.id_user IS NULL 
                AND e.estado = 'Activo'
                AND p.per_estado = 'Activo'
                ORDER BY p.per_nombre, p.per_apellido";
        return $this->selectAll($sql);
    }

    // Obtener información específica de un empleado
    public function getEmpleadoById($id_empleado)
    {
        $sql = "SELECT 
                    e.id_empleado,
                    p.per_nombre,
                    p.per_apellido,
                    p.per_correo,
                    c.descripcion as cargo
                FROM empleados e
                INNER JOIN personas p ON e.id_persona = p.id_persona
                INNER JOIN cargos c ON e.id_cargo = c.id_cargo
                WHERE e.id_empleado = ? 
                AND e.estado = 'ACTIVO'";
        return $this->select($sql, [$id_empleado]);
    }

    // Obtener todos los empleados activos
    public function getEmpleadosActivos()
    {
        $sql = "SELECT 
                    e.id_empleado,
                    p.per_nombre,
                    p.per_apellido,
                    c.descripcion as cargo
                FROM empleados e
                INNER JOIN personas p ON e.id_persona = p.id_persona
                INNER JOIN cargos c ON e.id_cargo = c.id_cargo
                WHERE e.estado = 'ACTIVO'
                ORDER BY p.per_nombre, p.per_apellido";
        return $this->selectAll($sql);
    }
}
?>