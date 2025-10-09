<?php
require_once 'config/Config.php';
require_once 'config/app/autoload.php';
require_once 'models/EmpleadosModel.php';
require_once 'models/SucursalesModel.php';

echo "<h3>Test de Modelos</h3>";

// Probar EmpleadosModel
$empleadosModel = new EmpleadosModel();
$empleados = $empleadosModel->getEmpleadosSinUsuario();

echo "<h4>Empleados sin usuario:</h4>";
echo "Cantidad: " . count($empleados) . "<br>";
echo "<pre>";
print_r($empleados);
echo "</pre>";

// Probar SucursalesModel
$sucursalesModel = new SucursalesModel();
$sucursales = $sucursalesModel->getSucursales();

echo "<h4>Sucursales:</h4>";
echo "Cantidad: " . count($sucursales) . "<br>";
echo "<pre>";
print_r($sucursales);
echo "</pre>";
?>