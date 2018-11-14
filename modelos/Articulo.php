<?php
//Incluir la conexión a l base de datos
require "../config/conexion.php";

class Articulo
{
    //Constructor
    public Function __construct() 
    {
        
    }
    //Metodo para insertar registros
    
    public function insertar($idcategoria, $codigo,  $nombre, $stock, $descripcion, $imagen)
    {
        $sql="INSERT INTO articulo (idcategoria, codigo, nombre, stock, descripcion, imagen, condicion) VALUES ('$idcategoria','$codigo','$nombre', '$stock' ,'$descripcion', '$imagen','1')";
        return ejecutarConsulta($sql);
    }
    //Metodo para editar categorías
    public function editar($idarticulo, $idcategoria, $codigo, $nombre, $stock, $descripcion, $imagen)
    {
        $sql="UPDATE articulo SET idcategoria='$idcategoria', codigo='$codigo',  nombre='$nombre', stock='$stock' , descripcion='$descripcion', imagen='$imagen' WHERE idarticulo='$idarticulo' ";
        return ejecutarConsulta($sql);
    }
    //Metodo para Desactivar categorías
    public function desactivar($idarticulo)
    {
        $sql="UPDATE articulo SET condicion='0' WHERE idarticulo='$idarticulo'";
        return ejecutarConsulta($sql);
    }
    
    //Metodo para Activar categorías
    public function activar($idarticulo)
    {
        $sql="UPDATE articulo SET condicion='1' WHERE idarticulo='$idarticulo'";
        return ejecutarConsulta($sql);
    }
    //Metodo para mostrar datos de un registro a modificar
    public function mostrar($idarticulo)
    {
        $sql="SELECT * FROM articulo WHERE idarticulo='$idarticulo'";
        return ejecutarConsultaSimpleFila($sql);
    }
    //Metodo para listar registros
    public function listar()
    {
        $sql="SELECT arti.idarticulo, arti.idcategoria, cate.nombre as categoria, arti.codigo,arti.nombre , arti.stock, arti.descripcion, arti.imagen, arti.condicion from articulo arti inner join categoria cate on arti.idcategoria=cate.idcategoria";
        return ejecutarConsulta($sql);
    }
}

?>
