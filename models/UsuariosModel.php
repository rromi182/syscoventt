<?php

class UsuariosModel extends Query
{
    private $username, $password,$foto, $id_empleado, $id_sucursal, $estado, $id_user;

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
        return $this->update($sql);
    }

    public function bloquearUsuario(string $username)
    {
        $sql = "UPDATE usuarios SET 
                estado = 'BLOQUEADO',
                intentos_fallidos = 3
                WHERE username = '$username'";
        return $this->update($sql);
    }

    public function resetearIntentos(string $username)
    {
        $sql = "UPDATE usuarios SET 
                intentos_fallidos = 0
                WHERE username = '$username'";
        return $this->update($sql);
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
                WHERE u.estado = 'ACTIVO' or u.estado = 'BLOQUEADO' or u.estado = 'INACTIVO'
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

    public function agregar(string $username, string $password, string $foto, int $id_empleado, int $id_sucursal, string $estado)
    {

        $this->username = $username;
        $this->password = $password;
        $this->foto = $foto;
        $this->id_empleado = $id_empleado;
        $this->id_sucursal = $id_sucursal;
        $this->estado = $estado;

        $sql = "INSERT INTO usuarios (username, password, foto, id_empleado, id_sucursal, estado) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $datos = array($this->username, $this->password, $this->foto, $this->id_empleado, $this->id_sucursal, $this->estado);
        $data =  $this->save($sql, $datos);
        if($data == 1){
            $response = 'Ok';
        }else{
            $response = 'Error';
        }
        return $response;
    }

    public function editar(int $id_user){
        $sql = "SELECT * FROM usuarios WHERE id_user = $id_user;";
        $data = $this->select($sql);
        return $data;
    }

    public function eliminar(int $id_user){
        $this->id_user = $id_user;
        $sql = "UPDATE usuarios SET estado = 'INACTIVO' WHERE id_user = ?";
        $datos = array($this->id_user);
        $data = $this->save($sql, $datos); 
        return $data;
    }

    public function activar(int $id_user){
        $this->id_user = $id_user;
        $sql = "UPDATE usuarios SET estado = 'ACTIVO' WHERE id_user = ?";
        $datos = array($this->id_user);
        $data = $this->save($sql, $datos); 
        return $data;
    }
}
