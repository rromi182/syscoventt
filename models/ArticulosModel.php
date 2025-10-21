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

    public function verificarCodigo($codigo, $id_articulo = null)
    {
        if ($id_articulo) {
            $sql = "SELECT id_articulo FROM articulos WHERE codigo_articulo = ? AND id_articulo != ? AND estado = 'ACTIVO'";
            return $this->select($sql, [$codigo, $id_articulo]);
        } else {
            $sql = "SELECT id_articulo FROM articulos WHERE codigo_articulo = ? AND estado = 'ACTIVO'";
            return $this->select($sql, [$codigo]);
        }
    }

    // Verificar si la descripción ya existe
    public function verificarDescripcion($descripcion, $id_articulo = null)
    {
        if ($id_articulo) {
            $sql = "SELECT id_articulo FROM articulos WHERE articulo_descrip = ? AND id_articulo != ? AND estado = 'ACTIVO'";
            return $this->select($sql, [$descripcion, $id_articulo]);
        } else {
            $sql = "SELECT id_articulo FROM articulos WHERE articulo_descrip = ? AND estado = 'ACTIVO'";
            return $this->select($sql, [$descripcion]);
        }
    }

    // Insertar nuevo artículo
    public function agregar(string $codigo, string $descripcion, float $precio, string $foto, int $stock_minimo, int $id_marca, int $id_categoria, string $estado)
{
    $sql = "INSERT INTO articulos (codigo_articulo, articulo_descrip, precio, foto, stock_minimo, id_categoria, id_marca, estado) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $datos = array($codigo, $descripcion, $precio, $foto, $stock_minimo, $id_categoria, $id_marca, $estado);
    
    $data = $this->save($sql, $datos);
    
    if($data == 1){
        $response = 'Ok';
    } else {
        $response = 'Error';
    }
    return $response;
}

    
    
}