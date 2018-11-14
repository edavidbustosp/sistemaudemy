<?php
//Incluir la conexión a l base de datos
require "../config/conexion.php";

class Categoria
{
    //Constructor
    public Function __construct() 
    {
        
    }
    //Metodo para insertar registros
    
    public function insertar($nombre, $descripcion)
    {
        $sql="INSERT INTO categoria (nombre, descripcion, condicion) VALUES ('$nombre','$descripcion','1')";
        return ejecutarConsulta($sql);
    }
    //Metodo para editar categorías
    public function editar($idcategoria,$nombre, $descripcion)
    {
        $sql="UPDATE categoria SET nombre='$nombre', descripcion='$descripcion' WHERE idCategoria='$idcategoria' ";
        return ejecutarConsulta($sql);
    }
    //Metodo para Desactivar categorías
    public function desactivar($idcategoria)
    {
        $sql="UPDATE categoria SET condicion='0' WHERE idCategoria='$idcategoria'";
        return ejecutarConsulta($sql);
    }
    
    //Metodo para Activar categorías
    public function activar($idcategoria)
    {
        $sql="UPDATE categoria SET condicion='1' WHERE idCategoria='$idcategoria'";
        return ejecutarConsulta($sql);
    }
    //Metodo para mostrar datos de un registro a modificar
    public function mostrar($idcategoria)
    {
        $sql="SELECT * FROM categoria WHERE idCategoria='$idcategoria'";
        return ejecutarConsultaSimpleFila($sql);
    }
    //Metodo para listar registros
    public function listar()
    {
        $sql="SELECT * from categoria";
        return ejecutarConsulta($sql);
    }
    //Listar registros y mostrar en select
    public function select()
    {
        $sql="SELECT * from categoria where condicion=1";
        return ejecutarConsulta($sql);
    }
}

?>
