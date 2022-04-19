$(document).ready(function(){
    
    //Creando token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#newHomeWork').on('click', function(e){
        var datas = new FormData();
        datas.append("nombre",$("input[name=nombre]").val());
        datas.append("fechaInicio",$("input[name=fechaInicio]").val());
        datas.append("fechaFin",$("input[name=fechaFin]").val());
        datas.append("estado",$("select[name=estado]").val());
        $.ajax({
            "dataSrc":"data",
            type:'POST',
            url:"/newHomework",
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
                    $('#formTarea')[0].reset();
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
    });
});