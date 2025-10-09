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

public function getView($controlador, $vista, $data = "")
    {
        $controlador = get_class($controlador);
        if ($controlador == "Home") {
            $vista = "views/".$vista.".php";
        } else {
            $vista = "views/".$controlador."/".$vista.".php";
        }
        
        // Pasar los datos a la vista
        if (is_array($data)) {
            extract($data); // Convierte $data['empleados'] en $empleados, etc.
        }
        
        require $vista;
    }

}

