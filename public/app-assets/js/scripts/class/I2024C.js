$(document).ready(function() {
    
    var valores='';
    function informacion(){
        $('body').find('ix').hide();
        $.ajax({
            url:'/institucion/admin',
            method:"POST",
            data:valores,
            dataType:'JSON',
            success:function(array){
                if(array.length !=0 && array[0].tipo==1){
                    if(array[0].coderror==0){ 
                        toastr.success(array[0].mensaje, 'En hora buena!');
                        $('.carSinData').remove();
                        $('#formUsuario')[0].reset();
                        addListaHorario(array);

                        var cantidades=array[0].cantidades.split(',');
                        $('#countAulas').html(cantidades[0]); $('#countCursos').html(cantidades[1]);
                    }else{
                        toastr.error(array[0].mensaje, 'Error!');
                    }
                }else if(array.length !=0 && array[0].tipo==2){
                    var cantidades=array[0].cantidades.split(',');
                    $('#countAulas').html(cantidades[0]); $('#countCursos').html(cantidades[1]);
                    addListaHorario(array);
                }else{ 
                    $('#listaHorario').html('<div class="carSinData card mb-0"><div class="card-content"><div class="card-body p-0"><div class="bd-example-row"><div class="row m-0">'+
                            '<div class="col-12 text-center">'+
                                '<h2 class="emoSinData animate__animated animate__heartBeat">&#128540;</h2>'+
                                '<p class="m-0">Lo lamento no existen horarios que mostrar </p>'+
                            '</div>'+
                        '</div></div></div></div></div>');
                }
                removerClass();
            },error:function(msj){
                var resp_c = msj.responseJSON.errors;
                $.each(resp_c,function(key,value){
                    var iderror=value[0].split(','); $('.'+iderror[0]).show();
                    $('.'+iderror[0]).attr('data-original-title', iderror[1])
                    $('.'+iderror[0]).addClass("animate__bounce");
                    setTimeout(function() { $('.'+iderror[0]).removeClass("animate__bounce"); }, 2000);
                })
            }
        })
    };

    function listar(){
        valores={_id:0,_turno:"=>", _horaInicio:"=>", _horaFinal:"=>", _accion:"listar", '_token':$('input[name="_token"]').val()};
        informacion();
    }listar();

    var accion=0;
    $('#btnGuardarTurno').on('click', function () { accion=0;
        valores={_id:0,_turno:$('#cboTurno').val(), _horaInicio:$('#txtHoraInicio').val(), _horaFinal:$('#txtHoraFinal').val(), _accion:"insertar", '_token':$('input[name="_token"]').val()};
        informacion();
    });

    var _idTurno;
    $("#listaHorario").on('click', 'button.btnEliminarHHorario', function () { accion=1;
        _idTurno=$(this).attr('data-id');
        valores={_id:_idTurno,_turno:"=>", _horaInicio:"=>", _horaFinal:"=>", _accion:"eliminar", '_token':$('input[name="_token"]').val()};
        informacion();
    });

    function addListaHorario(array){
        if(accion==0){
            var listaHorario=$('#listaHorario').append('');
            for (let i = 0; i < array.length; i++) {
                listaHorario.prepend
                ('<div id="card_'+array[i].id+'" class="card mb-0 micard animate__animated animate__flipInX"><div class="card-content"><div class="card-body p-0"><div class="bd-example-row"><div class="row m-0">'+
                    '<div class="col-4" style="font-size: 0.8rem;">'+
                        '<b>Tueno:</b><p class="m-0">'+array[i].turno+'</p>'+
                    '</div>'+
                    '<div class="col-6" style="font-size: 0.8rem;">'+
                        '<b>Hora:</b><p class="m-0">Inicio: '+array[i].horaInicio+'</p><p class="m-0">Inicio: '+array[i].horaFinal+'</p>'+
                    '</div>'+
                    '<div class="col-2 d-flex align-items-center justify-content-center">'+
                        '<div class="d-flex justify-content-center">'+
                            '<button type="button" class="btnEliminarHHorario btn btn-icon btn-flat-danger waves-effect waves-light" data-id="'+array[i].id+'"><i class="feather icon-trash-2"></i></button>'+
                        '</div>'+
                    '</div>'+
                '</div></div></div></div></div>');
            }
        }else if(accion==1){
            $('#card_'+_idTurno).addClass('animate__bounceOut');
            setTimeout(function() { $('#card_'+_idTurno).remove();
                if ($('#listaHorario').find('.card').length === 0) {
                    $('#listaHorario').html('<div class="carSinData card mb-0"><div class="card-content"><div class="card-body p-0"><div class="bd-example-row"><div class="row m-0">'+
                        '<div class="col-12 text-center">'+
                            '<h2 class="emoSinData animate__animated animate__heartBeat">&#128540;</h2>'+
                            '<p class="m-0">Lo lamento no existen horarios que mostrar </p>'+
                        '</div>'+
                    '</div></div></div></div></div>');
                }       
            }, 1000);
            accion=0;
        }
    }

    function removerClass() {
        setTimeout(function() { 
            $('.animate__animated').removeClass("animate__flipInX");
            $('.animate__animated').removeClass("animate__fadeInUp");
            $('.animate__animated').removeClass("animate__bounce");
            $('.animate__animated').removeClass("animate__bounceOut");
            vermodal=0;
        }, 1000);
    }

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