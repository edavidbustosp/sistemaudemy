<?php
//Incluir la conexión a l base de datos
require "../config/conexion.php";

class Usuario
{
    //Constructor
    public Function __construct() 
    {
        
    }
    //Metodo para insertar registros
    
    public function insertar($nombre, $tipoDocumento, $numDocumento, $direccion, $telefono, $email, $cargo, $login, $clave, $imagen, $permisos)
    {
        $sql="INSERT INTO usuario (nombre, tipoDocumento, numDocumento, direccion, telefono, email, cargo, login, clave, imagen, condicion) VALUES ('$nombre','$tipoDocumento', '$numDocumento', '$direccion', '$telefono', '$email', '$cargo', '$login', '$clave', '$imagen','1')";
        //return ejecutarConsulta($sql);
        $idusuarionew= ejecutarConsulta_retornarID($sql);

        $numElementos=0;
        $sw=true;
        while ($numElementos < count($permisos)) 
        {
            $sqlDetalle="INSERT INTO usuariopermiso(idUsuario, idPermiso) VALUES('$idusuarionew', '$permisos[$numElementos]')";
            ejecutarConsulta($sqlDetalle) or $sw=false;
            $numElementos=$numElementos+1;
        }
        return $sw;
    }
    //Metodo para editar categorías
    public function editar($idusuario,$nombre, $tipoDocumento, $numDocumento, $direccion, $telefono, $email, $cargo, $login, $clave, $imagen, $permisos)
    {
        $sql="UPDATE usuario SET nombre='$nombre', tipoDocumento='$tipoDocumento', numDocumento='$numDocumento', direccion='$direccion', telefono='$telefono', email='$email', cargo='$cargo', login='$login', clave='$clave', imagen='$imagen' WHERE idusuario='$idusuario' ";
        ejecutarConsulta($sql);

        //Eliminación de los permisos actuales
        $sqldel="DELETE FROM usuariopermiso WHERE idUsuario='$idusuario'";
        ejecutarConsulta($sqldel);

        $numElementos=0;
        $sw=true;
        while ($numElementos < count($permisos)) 
        {
            $sqlDetalle="INSERT INTO usuariopermiso(idUsuario, idPermiso) VALUES('$idusuario', '$permisos[$numElementos]')";
            ejecutarConsulta($sqlDetalle) or $sw=false;
            $numElementos=$numElementos+1;
        }
        return $sw;
    }
    //Metodo para Desactivar categorías
    public function desactivar($idusuario)
    {
        $sql="UPDATE usuario SET condicion='0' WHERE idusuario='$idusuario'";
        return ejecutarConsulta($sql);
    }
    
    //Metodo para Activar categorías
    public function activar($idusuario)
    {
        $sql="UPDATE usuario SET condicion='1' WHERE idusuario='$idusuario'";
        return ejecutarConsulta($sql);
    }
    //Metodo para mostrar datos de un registro a modificar
    public function mostrar($idusuario)
    {
        $sql="SELECT * FROM usuario WHERE idusuario='$idusuario'";
        return ejecutarConsultaSimpleFila($sql);
    }
    //Metodo para listar registros
    public function listar()
    {
        $sql="SELECT * from usuario";
        return ejecutarConsulta($sql);
    }
    //Listar registros y mostrar en select
    public function listarmarcados($idusuario)
    {
        $sql="SELECT * from usuariopermiso where idUsuario='$idusuario'";
        return ejecutarConsulta($sql);
    }
    //Función de verificación de acceso al sistema
    public function verificar($login, $clave)
    {
        $sql="SELECT idusuario, nombre, tipoDocumento, numDocumento, telefono, email, cargo, imagen, login FROM usuario WHERE login='$login' AND clave='$clave' AND condicion='1'";
        return ejecutarConsulta($sql);
    }
}

?>
