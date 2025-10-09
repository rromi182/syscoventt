<?php
class MarcasModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    // Obtener Marcas activas
    public function getMarcas()
    {
        $sql = "SELECT * FROM marcas WHERE estado = 'ACTIVO' ORDER BY id_marca";
        return $this->selectAll($sql);
    }

    // Obtener Marcas por ID
    public function getMarcaById($id_marca)
    {
        $sql = "SELECT * FROM marcas WHERE id_marca = ? AND estado = 'ACTIVO'";
        return $this->select($sql, [$id_marca]);
    }
}
?>