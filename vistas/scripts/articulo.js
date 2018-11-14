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
    //Cargar los items al select
    $.post("../ajax/articulo.php?op=selectCategoria",function(r){
        $("#idcategoria").html(r);
        $('#idcategoria').selectpicker('refresh');
    });
    $("#imagenmuestra").hide();
}

//funcion de limpiar

function limpiar()
{
    $("#codigo").val("");
    $("#nombre").val("");
    $("#descripcion").val("");
    $("#stock").val("");
    $("#imagenmuestra").attr("src","");
    $("#imagenactual").val("");
    $("#print").hide();
    $("#idarticulo").val("");
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
                    url: '../ajax/articulo.php?op=listar',
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
        
        url: "../ajax/articulo.php?op=guardaryeditar",
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
function mostrar(idarticulo)
{
    $.post("../ajax/articulo.php?op=mostrar",{idarticulo : idarticulo}, function (data, status)
    {
        data=JSON.parse(data);
        mostrarform(true);

        $("#idcategoria").val(data.idcategoria);
        $('#idcategoria').selectpicker('refresh');
        $("#codigo").val(data.codigo);
        $("#nombre").val(data.nombre);
        $("#stock").val(data.stock);
        $("#descripcion").val(data.descripcion);
        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src","../files/articulos/"+data.imagen);
        $("#imagenactual").val(data.imagen);
        $("#idarticulo").val(data.idarticulo);
        generarbarcode();
    })
}

//Función para desactivar registros

function desactivar(idarticulo)
{
    bootbox.confirm("¿Está seguro de desactivar el artículo?",function(result){
        
        if(result)
        {
            $.post("../ajax/articulo.php?op=desactivar", {idarticulo : idarticulo},function(e){
                
                bootbox.alert(e);
                tabla.ajax.reload();
                
            });
        }
        
    })
}


//Función para activar registros

function activar(idarticulo)
{
    bootbox.confirm("¿Está seguro de activar la artículo?",function(result){
        
        if(result)
        {
            $.post("../ajax/articulo.php?op=activar", {idarticulo : idarticulo},function(e){
                
                bootbox.alert(e);
                tabla.ajax.reload();
                
            });
        }
        
    })
}

function generarbarcode()
{
    codigo=$("#codigo").val();
    JsBarcode("#barcode", codigo);
    $("#print").show();
}

function imprimir()
{
    $("#print").printArea();
}

init();
