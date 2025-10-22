<?php

class PedidosComprasModel extends Query
{


    public function __construct()
    {
        parent::__construct();
    }

/*
// Funcion para obtener todos los pedidos
*/
    public function getPedidosCompras()
    {
        $sql = "SELECT 
                    pc.id_pedido_compra,
                    pc.fecha_registro,
                    pc.estado,
                    s.sucursal,
                    u.username,
                    CONCAT(p.per_nombre, ' ', p.per_apellido) AS nombre_completo,
                    COUNT(pcd.id_articulo) as total_articulos,
                    SUM(pcd.cantidad) as total_cantidad
                FROM pedido_compra pc
                JOIN sucursales s ON pc.id_sucursal = s.id_sucursal
                JOIN usuarios u ON pc.id_user = u.id_user
                JOIN empleados e ON u.id_empleado = e.id_empleado
                JOIN personas p ON e.id_persona = p.id_persona
                JOIN pedido_compra_det pcd ON pc.id_pedido_compra = pcd.id_pedido_compra
                GROUP BY pc.id_pedido_compra
                ORDER BY pc.fecha_registro DESC";

        $data = $this->selectAll($sql);
        return $data;
    }

/*
// Funcion para obtener pedido por id 
*/
    public function getPedidosComprasById($id_pedido_compra)
    {
        $sql = "SELECT 
                pc.id_pedido_compra,
                pc.fecha_registro,
                pc.estado,
                s.sucursal,
                u.username,
                CONCAT(p.per_nombre, ' ', p.per_apellido) AS nombre_completo,
                COUNT(pcd.id_articulo) as total_articulos,
                SUM(pcd.cantidad) as total_cantidad
            FROM pedido_compra pc
            JOIN sucursales s ON pc.id_sucursal = s.id_sucursal
            JOIN usuarios u ON pc.id_user = u.id_user
            JOIN empleados e ON u.id_empleado = e.id_empleado
            JOIN personas p ON e.id_persona = p.id_persona
            JOIN pedido_compra_det pcd ON pc.id_pedido_compra = pcd.id_pedido_compra
            WHERE pc.id_pedido_compra = $id_pedido_compra
            GROUP BY pc.id_pedido_compra";

        return $this->select($sql);
    }

/*
// Funcion para obtener pedido cabecera y detalle juntos por id de pedido
*/
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
