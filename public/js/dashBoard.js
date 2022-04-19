$(document).ready(function(){
    $.get( "/reportStatus", function( data ) {
        var data = [
            {x: "INICIADA", value: data.iniciada},
            {x: "EN PROCESO", value: data.enProceso},
            {x: "CANCELADA", value: data.cancelada},
            {x: "COMPLETADA", value: data.completada},
        ];
        chart = anychart.pie(data);
        
        chart.container("reporteEstados");
        
        chart.draw();
    
        $('.anychart-credits').remove();
    });
});