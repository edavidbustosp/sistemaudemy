<?php
    //Inclusión de la clase categoría
    require_once "../modelos/Permiso.php";
    
    $permiso=new Permiso();
    
    
    switch ($_GET["op"])
    {
        case'listar';
            $rspta=$permiso->listar();
            $data=array();
                while($reg=$rspta->fetch_object())
                {
                    $data[]=array(
                        "0"=>$reg->nombre,
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
