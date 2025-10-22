<?php 
class Views{

//     public function getView($controlador, $vista)
// {
//     $controlador = get_class($controlador);
//     if ($controlador == "Home") {
//         $vista = "views/".$vista.".php";
//     } else {
//         $vista = "views/".$controlador."/".$vista.".php";
//     }
//     require $vista;
// }

// public function getView($controlador, $vista, $data = "")
//     {
//         $controlador = get_class($controlador);
//         if ($controlador == "Home") {
//             $vista = "views/".$vista.".php";
//         } else {
//             $vista = "views/".$controlador."/".$vista.".php";
//         }
        
//         // Pasar los datos a la vista
//         if (is_array($data)) {
//             extract($data); // Convierte $data['empleados'] en $empleados, etc.
//         }
        
//         require $vista;
//     }

// }

    
    public function getView($controlador, $vista, $data = "")
    {
        $controlador = get_class($controlador);
        
        if ($controlador == "Home") {
            $vistaPath = "views/".$vista.".php";
        } else {
            // Mapeo de controladores a sus carpetas específicas
            $mapeoCarpetas = [
                'PedidosCompras' => 'compras/pedidos',
                'PresupuestosCompras' => 'compras/presupuestos',
                'OrdenesCompras' => 'compras/ordenes',
                'FacturasCompras' => 'compras/facturas'
                // Agrega más mapeos según necesites
            ];
            
            // Si el controlador tiene una carpeta mapeada, úsala
            if (isset($mapeoCarpetas[$controlador])) {
                $vistaPath = "views/".$mapeoCarpetas[$controlador]."/".$vista.".php";
            } else {
                // Por defecto: views/Controlador/vista.php
                $vistaPath = "views/".$controlador."/".$vista.".php";
            }
        }
        
        // Verificar si la vista existe
        if (!file_exists($vistaPath)) {
            die("La vista no existe: " . $vistaPath);
        }
        
        // Pasar los datos a la vista
        if (is_array($data)) {
            extract($data);
        }
        
        require $vistaPath;
    }


}