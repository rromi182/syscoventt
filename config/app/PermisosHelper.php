<?php
class PermisosHelper
{
    // Verificar si tiene un permiso específico por ID
    public static function tienePermiso($idPermisoRequerido)
    {
        if (!isset($_SESSION['permisos_ids'])) {
            return false;
        }
        
        // Si es admin (permiso ID 1), tiene todos los permisos
        if (in_array(1, $_SESSION['permisos_ids'])) {
            return true;
        }
        
        return in_array($idPermisoRequerido, $_SESSION['permisos_ids']);
    }
    
    // Verificar si tiene al menos uno de varios permisos
    public static function tieneAlgunPermiso($permisosRequeridos)
    {
        if (!isset($_SESSION['permisos_ids'])) {
            return false;
        }
        
        // Si es admin, tiene todos los permisos
        if (in_array(1, $_SESSION['permisos_ids'])) {
            return true;
        }
        
        foreach ($permisosRequeridos as $permiso) {
            if (in_array($permiso, $_SESSION['permisos_ids'])) {
                return true;
            }
        }
        
        return false;
    }
    
    // Verificar rol por nombre de cargo (alternativo)
    public static function esAdmin()
    {
        return isset($_SESSION['cargo']) && $_SESSION['cargo'] == 'Administrador de Sistemas';
    }
    
    public static function esJefeCompras()
    {
        return isset($_SESSION['cargo']) && $_SESSION['cargo'] == 'Jefe de Compras';
    }
    
    public static function esAuxiliarCompras()
    {
        return isset($_SESSION['cargo']) && $_SESSION['cargo'] == 'Auxiliar de Compras';
    }
    public static function esJefeVentas()
    {
        return isset($_SESSION['cargo']) && $_SESSION['cargo'] == 'Jefe de Ventas';
    }
    public static function esAuxiliarVentas()
    {
        return isset($_SESSION['cargo']) && $_SESSION['cargo'] == 'Auxiliar de Ventas';
    }
}