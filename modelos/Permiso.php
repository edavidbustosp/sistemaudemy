<?php
//Incluir la conexión a l base de datos
require "../config/conexion.php";

class Permiso
{
    //Constructor
    public Function __construct() 
    {
        
    }
    //Metodo para listar registros
    public function listar()
    {
        $sql="SELECT * from permiso";
        return ejecutarConsulta($sql);
    }
}

?>
