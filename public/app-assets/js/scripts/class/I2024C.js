$(document).ready(function() {
    

    $('#cboTurno').on('change', function () {
        var turno=$(this).val();
        if (turno=="Mañana") {
            $('#txtHoraInicio').val('07:00'); $('#txtHoraFinal').val('13:00');
        }else if (turno=="Tarde"){
            $('#txtHoraInicio').val('13:00'); $('#txtHoraFinal').val('18:00');
        }else{
            $('#txtHoraInicio').val('17:00'); $('#txtHoraFinal').val('23:00');
        }
    });
});