$(document).ready(function(){
    
    //Creando token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var tablaTareas = $('#tablaTareas').DataTable({
        responsive: false,
        "ajax":"/homeworkListDataTable",
        "columns":[
            {'defaultContent':''},
            {data:'nombre'},
            {data:'fechaInicio'},
            {data:'fechaFin'},
            {data:'estado'},
            {'defaultContent' :'<center><button type="button" class="edit btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit"><i class="fas fa-edit"></i></button><button type="button" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button></center>'},
        ],
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        'language': {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",              
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        }
        
    });
    
    tablaTareas.on('order.dt search.dt', function () {
        tablaTareas.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            tablaTareas.cell(cell).invalidate('dom');
        });
    }).draw();

    $('#tablaTareas tbody').on('click','button.edit', function(e){
        $('#estado').attr("disabled",false);
        var registroEditar = tablaTareas.row(($(this)).parents("tr")).data();
        $('#id').val(registroEditar.id);
        $('#nombre').val(registroEditar.nombre);
        $('#fechaInicio').val(registroEditar.fechaInicio);
        $('#fechaFin').val(registroEditar.fechaFin);
        $('#estado').val(registroEditar.estado);
        if(registroEditar.estado == "COMPLETADA"){
            $('#estado').attr("disabled",true);
        }
        console.log(registroEditar.estado);
    })
    
    $('#guardarEdicion').on('click', function(){
        var datas = new FormData();
        datas.append("id",$("input[name=id]").val());
        datas.append("nombre",$("input[name=nombre]").val());
        datas.append("fechaInicio",$("input[name=fechaInicio]").val());
        datas.append("fechaFin",$("input[name=fechaFin]").val());
        datas.append("estado",$("select[name=estado]").val());
        $.ajax({
            "dataSrc":"data",
            type:'POST',
            url:"/updateHomework",
            data:datas,
            processData:false,
            contentType:false,
            success:function(data){
                if(data.error === 'on'){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.mensaje,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }else{
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro Exitoso',
                        text: data.mensaje,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    tablaTareas.ajax.reload();
                    if($('#estado').val() == "COMPLETADA"){
                        $('#estado').attr("disabled",true);
                    }
                }
            },
            error:function(msj){
                var listadoProblemas = "Problemas: ";
                var errores = msj.responseJSON.errors;
                for(var error in errores){
                    listadoProblemas = listadoProblemas+" | "+errores[error]
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Revisa el formulario nuevamente',
                    text: listadoProblemas
                })
            }
        })
        
    })

    $('#tablaTareas tbody').on('click','button.delete', function(e){
        Swal.fire({
            title: 'Confirmar eliminación de Registro',
            showDenyButton: true,
            confirmButtonText: `Eliminar`,
            denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                var registroEliminar = tablaTareas.row(($(this)).parents("tr")).data();
                datas = new FormData();
                datas.append("id", registroEliminar.id);
                $.ajax({
                    "dataSrc":"data",
                    type:'POST',
                    url:"/homeWorkDelete",
                    data:datas,
                    processData:false,
                    contentType:false,
                    success:function(data){
                        if(data.error == 'on'){
                            Swal.fire({
                                icon: 'error',
                                title: data.mensaje,
                                showConfirmButton: true,
                            })
                        }else{
                            tablaTareas.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: data.mensaje,
                                showConfirmButton: false,
                                timer: 2500
                            })
                        }
                    }
                })
            } else if (result.isDenied) {
                Swal.fire('Eliminación Cancelada', '', 'info')
            }
        })
    });
});