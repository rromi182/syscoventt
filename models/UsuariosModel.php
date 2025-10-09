<?php

class UsuariosModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUsuario(string $username, string $password)
    {
        $sql = "SELECT u.id_user, u.username, u.foto, u.estado, 
                       s.sucursal,
                       c.descripcion AS cargo,
                      CONCAT(p.per_nombre, ' ', p.per_apellido) AS nombre_completo
                FROM usuarios u
                INNER JOIN empleados e ON u.id_empleado = e.id_empleado
                INNER JOIN cargos c ON e.id_cargo = c.id_cargo
                INNER JOIN personas p ON e.id_persona = p.id_persona
                INNER JOIN sucursales s ON u.id_sucursal = s.id_sucursal
                WHERE u.username = '$username' AND u.password = '$password' AND u.estado = 'ACTIVO'";

        $data = $this->select($sql);
        return $data;
    }

    public function getUsuarioPorUsername(string $username)
    {
        $sql = "SELECT u.id_user, u.username, u.intentos_fallidos, u.estado
                FROM usuarios u 
                WHERE u.username = '$username'";
        return $this->select($sql);
    }

    public function incrementarIntentos(string $username)
    {
        $sql = "UPDATE usuarios SET 
                intentos_fallidos = intentos_fallidos + 1
                WHERE username = '$username'";
        return $this->save($sql);
    }

    public function bloquearUsuario(string $username)
    {
        $sql = "UPDATE usuarios SET 
                estado = 'BLOQUEADO',
                intentos_fallidos = 3
                WHERE username = '$username'";
        return $this->save($sql);
    }

    public function resetearIntentos(string $username)
    {
        $sql = "UPDATE usuarios SET 
                intentos_fallidos = 0
                WHERE username = '$username'";
        return $this->save($sql);
    }

    public function getUsuarios()
    {
        $sql = "SELECT u.id_user, u.username, u.foto, u.estado, 
                       s.sucursal,
                       c.descripcion AS cargo,
                      CONCAT(p.per_nombre, ' ', p.per_apellido) AS nombre_completo
                FROM usuarios u
                INNER JOIN empleados e ON u.id_empleado = e.id_empleado
                INNER JOIN cargos c ON e.id_cargo = c.id_cargo
                INNER JOIN personas p ON e.id_persona = p.id_persona
                INNER JOIN sucursales s ON u.id_sucursal = s.id_sucursal
                WHERE u.estado = 'ACTIVO' or u.estado = 'BLOQUEADO'
                ";

        $data = $this->selectAll($sql);
        return $data;
    }

    public function getPermisosUsuario(int $idUser)
    {
        $sql = "SELECT p.id_permiso, p.descripcion
            FROM usuarios u
            INNER JOIN empleados e ON u.id_empleado = e.id_empleado
            INNER JOIN cargos_permisos cp ON e.id_cargo = cp.id_cargo
            INNER JOIN permisos p ON cp.id_permiso = p.id_permiso
            WHERE u.id_user = $idUser AND p.estado = 'Activo'";

        return $this->selectAll($sql);
    }

    public function getPermisosPorCargo(int $idCargo)
    {
        $sql = "SELECT pr.id_permiso, pr.descripcion
                FROM cargos_permisos cp
                INNER JOIN permisos pr ON cp.id_permiso = pr.id_permiso
                WHERE cp.id_cargo = $idCargo AND pr.estado = 'Activo'";
        return $this->selectAll($sql);
    }

    // public function getUsuario(string $username, string $password)
    // {
    //     $sql = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";
    //     $data = $this->select($sql);
    //     return $data;
    // }
        // Método para desbloquear desde el sistema
    // public function desbloquearUsuario($id_user)
    // {
    //     $sql = "UPDATE usuarios SET estado = 'Activo', intentos_fallidos = 0 
    //         WHERE id_user = $id_user";
    //     return $this->save($sql);
    // }
}
