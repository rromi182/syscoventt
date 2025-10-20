<?php
class CategoriasModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    
    public function getCategorias()
    {
        $sql = "SELECT * FROM categoria_articulo  WHERE estado = 'ACTIVO' ORDER BY id_categoria";
        return $this->selectAll($sql);
    }

    
    public function getCategoriaById($id_categoria)
    {
        $sql = "SELECT * FROM categoria_articulo  WHERE id_categoria = ? AND estado = 'ACTIVO'";
        return $this->select($sql, [$id_categoria]);
    }
}
?>