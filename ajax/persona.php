<?php
    //Inclusión de la clase categoría
    require_once "../modelos/Persona.php";
    
    $persona=new Persona();
    
    $idpersona= isset($_POST["idpersona"])? limpiarCadena($_POST["idpersona"]):"";
    $tipoPersona= isset($_POST["tipoPersona"])? limpiarCadena($_POST["tipoPersona"]):"";
    $nombre= isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
    $tipoDocumento= isset($_POST["tipoDocumento"])? limpiarCadena($_POST["tipoDocumento"]):"";
    $numDocumento= isset($_POST["numDocumento"])? limpiarCadena($_POST["numDocumento"]):"";
    $direccion= isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
    $telefono= isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
    $email= isset($_POST["email"])? limpiarCadena($_POST["email"]):"";

    
    switch ($_GET["op"])
    {
        case 'guardaryeditar':
            if(empty($idpersona))
            {
                $rspta=$persona->insertar($tipoPersona, $nombre,$tipoDocumento, $numDocumento, $direccion, $telefono, $email);
                echo $rspta?"Persona Registrada":"Persona no se pudo registrar";
            }
            else
            {
                $rspta=$persona->editar($idpersona, $tipoPersona, $nombre, $tipoDocumento, $numDocumento, $direccion, $telefono, $email);
                echo $rspta?"Persona Actualizada":"Persona no se pudo actualizar";
            }
            break;
        case 'eliminar':
            $rspta=$persona->eliminar($idpersona);
            echo $rspta?"Persona Eliminada":"Persona no se pudo eliminar";
            break;
        /*case 'activar':
            $rspta=$categoria->activar($idcategoria);
            echo $rspta?"Categoría Activada":"Categoría no se pudo activar";
            break;*/
        case 'mostrar':
            $rspta=$persona->mostrar($idpersona);
            //codificar el resultado usando JSon
            echo json_encode($rspta);
            break;
            //Listar Proveedores
        case'listarp';
            $rspta=$persona->listarp();
            $data=array();
                while($reg=$rspta->fetch_object())
                {
                    $data[]=array(
                        "0"=>'<button class=" btn btn-warning" onclick="mostrar('.$reg->
                            idpersona.')"><i class="fa fa-pencil"></i></button>'.
                            ' <button class="btn btn-danger" onclick="eliminar('.$reg->
                            idpersona.')"><i class="fa fa-trash"></i></button>',
                        "1"=>$reg->nombre,
                        "2"=>$reg->tipoDocumento,
                        "3"=>$reg->numDocumento,
                        "4"=>$reg->telefono,
                        "5"=>$reg->email
                    );
                }
            $results=array(
                "sEcho"=>1, //Información de datatables
                "iTotalRecords"=>count($data), //Se envía el total de registros al datatable
                "iTotalDisplayRecords"=>count($data),//se envia el total de registros a visualizar
                "aaData"=>$data
            );
            echo json_encode($results);
            break;
        //Listar clientes
        case'listarc';
            $rspta=$persona->listarc();
            $data=array();
                while($reg=$rspta->fetch_object())
                {
                    $data[]=array(
                        "0"=>'<button class=" btn btn-warning" onclick="mostrar('.$reg->
                            idpersona.')"><i class="fa fa-pencil"></i></button>'.
                            ' <button class="btn btn-danger" onclick="eliminar('.$reg->
                            idpersona.')"><i class="fa fa-trash"></i></button>',
                        "1"=>$reg->nombre,
                        "2"=>$reg->tipoDocumento,
                        "3"=>$reg->numDocumento,
                        "4"=>$reg->telefono,
                        "5"=>$reg->email
                    );
                }
            $results=array(
                "sEcho"=>1, //Información de datatables
                "iTotalRecords"=>count($data), //Se envía el total de registros al datatable
                "iTotalDisplayRecords"=>count($data),//se envia el total de registros a visualizar
                "aaData"=>$data
            );
            echo json_encode($results);
            break;
    }
?>
