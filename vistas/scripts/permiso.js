var tabla

//funcion que se ejecutará en el inicio

function init()
{
    mostrarform(false);
    listar();
}

//funcion de limpiar

function mostrarform(flag)
{
    //limpiar();
    if(flag)
    {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disable",false);
        $("#btnagregar").hide();
        
    }
    else
    {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").hide();
    }
}


//funcion listar

function listar()
{
    tabla=$('#tbllistado').dataTable(
    {
        "aProcessing": true, //Activa el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax":
                {
                    url: '../ajax/permiso.php?op=listar',
                    type:"get",
                    datatype: "json",
                    error: function(e){
                        console.log(e.responseText);
                    }
                },
        "bDestroy": true,
        "iDisplayLength":5,//Paginación cada 5 registros
        "order": [[0,"desc"]]
    }).DataTable();
}

init();
