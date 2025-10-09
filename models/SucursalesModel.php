<?php
class SucursalesModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    // Obtener sucursales activas
    public function getSucursales()
    {
        $sql = "SELECT * FROM sucursales WHERE estado = 'ACTIVO'";
        return $this->selectAll($sql);
    }

    // Obtener sucursal por ID
    public function getSucursalById($id_sucursal)
    {
        $sql = "SELECT * FROM sucursales WHERE id_sucursal = ? AND estado = 'ACTIVO'";
        return $this->select($sql, [$id_sucursal]);
    }
}
?>