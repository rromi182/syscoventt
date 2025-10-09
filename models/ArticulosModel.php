<?php
class ArticulosModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    // Obtener todos los artículos con joins para marcas y categorías
    public function getArticulos()
    {
        $sql = "SELECT a.*, 
                       m.marca_descrip,
                       c.categoria_descrip
                FROM articulos a 
                LEFT JOIN marcas m ON a.id_marca = m.id_marca 
                LEFT JOIN categoria_articulo c ON a.id_categoria = c.id_categoria 
                WHERE a.estado = 'ACTIVO' 
                ORDER BY a.id_articulo";
        return $this->selectAll($sql);
    }

    // Obtener artículo por ID
    public function getArticuloById($id_articulo)
    {
        $sql = "SELECT a.*, 
                       m.marca_descrip,
                       c.categoria_descrip
                FROM articulos a 
                LEFT JOIN marcas m ON a.id_marca = m.id_marca 
                LEFT JOIN categoria_articulo c ON a.id_categoria = c.id_categoria 
                WHERE a.id_articulo = ? AND a.estado = 'ACTIVO'";
        return $this->select($sql, [$id_articulo]);
    }
}