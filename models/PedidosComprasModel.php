<?php

class PedidosComprasModel extends Query
{
   

    public function __construct()
    {
        parent::__construct();
    }

   public function getPedidosCompras()
    {
        $sql = "SELECT 
                    pc.id_pedido_compra,
                    pc.fecha_registro,
                    pc.estado,
                    s.sucursal as sucursal_nombre,
                    u.username as usuario_username,
                    COUNT(pcd.id_articulo) as total_articulos,
                    SUM(pcd.cantidad) as total_cantidad
                FROM pedido_compra pc
                LEFT JOIN sucursales s ON pc.id_sucursal = s.id_sucursal
                LEFT JOIN usuarios u ON pc.id_user = u.id_user
                LEFT JOIN pedido_compra_det pcd ON pc.id_pedido_compra = pcd.id_pedido_compra
                GROUP BY pc.id_pedido_compra
                ORDER BY pc.fecha_registro DESC";

        $data = $this->selectAll($sql);
        return $data;
    }

    //agregar una funcion para oobtener  pedido cabecera y detalle juntos por id de pedido

    public function getPedidoComprasDetalles($id_pedido_compra)
    {
        $sql = "SELECT 
                    pcd.id_pedido_compra,
                    pcd.id_articulo,
                    pcd.cantidad,
                    a.articulo_descrip as articulo_descripcion
                FROM pedido_compra_det pcd
                LEFT JOIN articulos a ON pcd.id_articulo = a.id_articulo
                WHERE pcd.id_pedido_compra = $id_pedido_compra";
        return $this->selectAll($sql);
    }




}