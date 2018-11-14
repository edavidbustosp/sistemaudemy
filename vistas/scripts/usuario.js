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
    $("#imagenmuestra").hide();
    //Mostrar Permisos
    $.post("../ajax/usuario.php?op=permisos&id=", function(r)
    {
        $("#permisos").html(r);
    })
}

//funcion de limpiar

function limpiar()
{
    $("#nombre").val("");
    $("#numDocumento").val("");
    $("#direccion").val("");
    $("#telefono").val("");
    $("#email").val("");
    $("#cargo").val("");
    $("#login").val("");
    $("#clave").val("");
    $("#imagenmuestra").attr("src","");
    $("#imagenactual").val("");
    $("#idusuario").val("");
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
                    url: '../ajax/usuario.php?op=listar',
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
        
        url: "../ajax/usuario.php?op=guardaryeditar",
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
function mostrar(idusuario)
{
    $.post("../ajax/usuario.php?op=mostrar",{idusuario : idusuario}, function (data, status)
    {
        data=JSON.parse(data);
        mostrarform(true);

        $("#nombre").val(data.nombre);
        $("#tipoDocumento").val(data.tipoDocumento);
        $('#tipoDocumento').selectpicker('refresh');
        $("#numDocumento").val(data.numDocumento);
        $("#direccion").val(data.direccion);
        $("#telefono").val(data.telefono);
        $("#email").val(data.email);
        $("#cargo").val(data.cargo);
        $("#login").val(data.login);
        $("#clave").val(data.clave);
        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src","../files/usuarios/"+data.imagen);
        $("#imagenactual").val(data.imagen);
        $("#idusuario").val(data.idusuario);
        generarbarcode();
    });
    $.post("../ajax/usuario.php?op=permisos&id="+idusuario, function(r)
    {
        $("#permisos").html(r);
    })
}

//Función para desactivar registros

function desactivar(idusuario)
{
    bootbox.confirm("¿Está seguro de desactivar el usuario?",function(result){
        
        if(result)
        {
            $.post("../ajax/usuario.php?op=desactivar", {idusuario : idusuario},function(e){
                
                bootbox.alert(e);
                tabla.ajax.reload();
                
            });
        }
        
    })
}


//Función para activar registros

function activar(idusuario)
{
    bootbox.confirm("¿Está seguro de activar el usuario?",function(result){
        
        if(result)
        {
            $.post("../ajax/usuario.php?op=activar", {idusuario : idusuario},function(e){
                
                bootbox.alert(e);
                tabla.ajax.reload();
                
            });
        }
        
    })
}

init();
