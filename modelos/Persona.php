<?php
//Incluir la conexión a l base de datos
require "../config/conexion.php";

class Persona
{
    //Constructor
    public Function __construct() 
    {
        
    }
    //Metodo para insertar registros
    
    public function insertar($tipoPersona, $nombre,$tipoDocumento, $numDocumento, $direccion, $telefono, $email)
    {
        $sql="INSERT INTO persona (tipoPersona, nombre,tipoDocumento, numDocumento, direccion, telefono, email) VALUES ('$tipoPersona', '$nombre','$tipoDocumento', '$numDocumento', '$direccion', '$telefono', '$email')";
        return ejecutarConsulta($sql);
    }
    //Metodo para editar categorías
    public function editar($idpersona,$tipoPersona, $nombre,$tipoDocumento, $numDocumento, $direccion, $telefono, $email)
    {
        $sql="UPDATE persona SET tipoPersona='$tipoPersona', nombre='$nombre', tipoDocumento='$tipoDocumento', numDocumento='$numDocumento', direccion='$direccion', telefono='$telefono', email='$email' WHERE idpersona='$idpersona' ";
        return ejecutarConsulta($sql);
    }
    //Metodo para Desactivar categorías
    public function eliminar($idpersona)
    {
        $sql="DELETE FROM persona WHERE idpersona='$idpersona'";
        return ejecutarConsulta($sql);
    }
    
    //Metodo para Activar categorías
    /*public function activar($idcategoria)
    {
        $sql="UPDATE categoria SET condicion='1' WHERE idCategoria='$idcategoria'";
        return ejecutarConsulta($sql);
    }*/
    //Metodo para mostrar datos de un registro a modificar
    public function mostrar($idpersona)
    {
        $sql="SELECT * FROM persona WHERE idpersona='$idpersona'";
        return ejecutarConsultaSimpleFila($sql);
    }
    //Metodo para listar registros
    public function listarp()
    {
        $sql="SELECT * FROM persona WHERE tipoPersona='Proveedor'";
        return ejecutarConsulta($sql);
    }
    public function listarc()
    {
        $sql="SELECT * from persona WHERE tipoPersona='Cliente'";
        return ejecutarConsulta($sql);
    }
    //Listar registros y mostrar en select
    /*public function select()
    {
        $sql="SELECT * from categoria where condicion=1";
        return ejecutarConsulta($sql);
    }*/
}

?>
