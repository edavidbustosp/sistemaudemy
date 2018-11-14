var tabla

//funcion que se ejecutará en el inicio

function init()
{
    mostrarform(false);
    listar();
    $("#formulario").on("submit",function(e)
    {
        guardaryeditar(e);
    })
}

//funcion de limpiar

function limpiar()
{
    $("#idcategoria").val("");
    $("#nombre").val("");
    $("#descripcion").val("");
}
//Funcion mostrar formulario

function mostrarform(flag)
{
    limpiar();
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
        $("#btnagregar").show();
    }
}
//Funcion cancelarform

function cancelarform()
{
    limpiar();
    mostrarform(false);
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
                    url: '../ajax/categoria.php?op=listar',
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
//Funcion para guardar o editar
function guardaryeditar(e)
{
    e.preventDefault();//No se activara la accion predeterminada del evento
    //$("#btnGuardar").prop("disabled", true);
    var formData=new FormData($("#formulario")[0]);
    
    $.ajax({
        
        url: "../ajax/categoria.php?op=guardaryeditar",
        type:"POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(datos)
        {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }
        
    });
    limpiar();
}
function mostrar(idcategoria)
{
    $.post("../ajax/categoria.php?op=mostrar",{idcategoria : idcategoria}, function (data, status)
    {
        data=JSON.parse(data);
        mostrarform(true);
        $("#nombre").val(data.nombre);
        $("#descripcion").val(data.descripcion);
        $("#idcategoria").val(data.idcategoria);
    })
}

//Función para desactivar registros

function desactivar(idcategoria)
{
    bootbox.confirm("¿Está seguro de desactivar la categoría?",function(result){
        
        if(result)
        {
            $.post("../ajax/categoria.php?op=desactivar", {idcategoria : idcategoria},function(e){
                
                bootbox.alert(e);
                tabla.ajax.reload();
                
            });
        }
        
    })
}


//Función para activar registros

function activar(idcategoria)
{
    bootbox.confirm("¿Está seguro de activar la categoría?",function(result){
        
        if(result)
        {
            $.post("../ajax/categoria.php?op=activar", {idcategoria : idcategoria},function(e){
                
                bootbox.alert(e);
                tabla.ajax.reload();
                
            });
        }
        
    })
}


init();
