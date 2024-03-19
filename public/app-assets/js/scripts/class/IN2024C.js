$(document).ready(function() {

    valores='';
    function informacion(){
        // $('body').find('ix').hide();
        $.ajax({
            url:'/institucion/curso',
            method:"POST",
            data:valores,
            dataType:'JSON',
            success:function(array){
                if(array.length !=0 && array[0].tipo==1){
                    if(array[0].coderror==0){
                        toastr.success(array[0].mensaje, 'En hora buena!');
                        addListaCurso(array);
                        $('#btnAnularForm').trigger('click');

                        var cantidades=array[0].cantidades.split(',');
                        $('#countAulas').html(cantidades[0]); $('#countCursos').html(cantidades[1]);
                    }else{
                        toastr.error(array[0].mensaje, 'Error!');
                    }
                }else if(array.length !=0 && array[0].tipo==2){
                    var cantidades=array[0].cantidades.split(',');
                    $('#countAulas').html(cantidades[0]); $('#countCursos').html(cantidades[1]);
                    addListaCurso(array);
                    for (let i = 0; i < array.length; i++) {
                        if(i==array.length-1){
                            listaAulas();
                         }
                    }
                }else if(array.length !=0 && array[0].tipo==3){
                    accion=1;
                    $('#card_'+id_miTokenCurso).prependTo('#listaCard').addClass("animate__fadeInUp");
                    $('#txtDenominacion').val(array[0].denominacion);
                    $('#txtDescripcion').val(array[0].descripcion);
                }else if(array.length !=0 && array[0].tipo==4){
                    $('#ulAulas').html('');
                    var ulAulas=$('#ulAulas').append('');
                    for (let i = 0; i < array.length; i++) {
                        ulAulas.append
                        ('<li id="liCheckbox_'+array[i].token+'" class="list-group-item pb-50" style="border-top: 0;border-bottom: solid;"><div class="d-flex justify-content-between mb-25">'+
                            '<fieldset><div class="vs-checkbox-con vs-checkbox-primary">'+
                                    '<input id="checkbox_'+array[i].token+'" class="listaCheckbox" type="checkbox" value="false" data-id="'+array[i].token+'">'+
                                    '<span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check"><i class="vs-icon feather icon-check"></i></span></span>'+
                                    '<span class="">'+array[i].denominacion+'</span>'+
                            '</div></fieldset>'+
                            '<div class=""><div class="badge badge-primary"><span>'+array[i].seccion+'</span></div></div>'+
                        '</div>'+
                            '<select id="idAula_'+array[i].token+'" class="select2 form-control losDocentes mb-1" disabled="true" style="border: solid 1px #7e7e7e;">'+
                                '<option value="">Docente:</option>'+
                            '</select>'+
                            '<div id="datoDocente_'+array[i].token+'" class="infoDocente p-25 d-flex justify-content-start align-items-center animate__animated animate__bounceIn mt-50" style="display:none !important;">'+
                                '<div class="avatar mr-50">'+
                                    '<img id="docenteImagen_'+array[i].token+'" src="../../../app-assets/images/portrait/small/administrador.jpg" alt="avtar img holder" height="35" width="35">'+
                                '</div>'+
                                '<div class="user-page-info desborde">'+
                                    '<h6 id="docenteMail_'+array[i].token+'" class="mb-0">ticona.ojeda@gmail.com</h6> <span id="docenteTelefono_'+array[i].token+'" class="font-small-2"><i class="feather icon-phone-call"></i> 939 277 175</span>'+
                                '</div>'+
                            '</div>'+
                        '</li>');
                        if(i==array.length-1){
                            setTimeout(function() { //traemos los cursos
                                valores={_idCurso:0,_denominacion:"=>",_descripcion:"=>",_estado:0,_idDocente:0,_comodinInt:0,_rows:0,_accion:"listar_turnos_Horario",'_token':$('input[name="_token"]').val()};
                                informacion();
                            }, 4000);
                        } 
                    }
                }else if(array.length !=0 && array[0].tipo==5){// actaiza las aulas sin asignar
                    listaDocentes();
                    $('#SpDenoCurso').html(array[0].denoCurso);
                    $('.losDocentes').prop("disabled", true);
                    $('.infoDocente').attr('style','display:none !important;');
                    $("#cboAula").html('<option value="">Aula</option>');
                    if(array[0].coderror==0){
                        for (let i = 0; i < array.length; i++) {
                            $("#checkbox_"+array[i].token).prop("checked", true);
                            $("#idAula_"+array[i].token).prop("disabled", false);
                            $("#cboAula").append('<option value="'+array[i].token+'">'+array[i].aulas+'</option>');
                        }
                    }

                }else if(array.length !=0 && array[0].tipo==6){
                    if(array[0].coderror==0){
                        toastr.success(array[0].mensaje, 'En hora buena!');
                        $('#ulAulas .listaCheckbox').change(function (e) { 
                            if($('#ulAulas .listaCheckbox').filter(':checked').length === 0){
                                $('.1divConfi_'+id_miTokenCurso).addClass('d-flex');
                                $('.2divConfi_'+id_miTokenCurso).hide();
                            }else{
                                $('.1divConfi_'+id_miTokenCurso).removeClass('d-flex');
                                $('.2divConfi_'+id_miTokenCurso).show();
                            }
                        });
                    }else{
                        toastr.error(array[0].mensaje, 'Error!');
                    }
                }else if(array.length !=0 && array[0].tipo==7){ // traemos a todos os docentes y ponemos en los cbos
                    $('.losDocentes').html('<option value="">Docente:</option>');
                    for (let i = 0; i < array.length; i++) {
                        $('.losDocentes').append('<option value="'+array[i].id+'">'+array[i].Docente+'</option>')
                        if(i==array.length-1){
                            listaDoscentesCurso();
                        }  
                    }
                    $(".select2").select2({
                        dropdownAutoWidth: true,
                        width: '100%'
                    });
                }else if(array.length !=0 && array[0].tipo==8){
                    if(array[0].coderror==0){
                        for (let i = 0; i < array.length; i++) {
                            var atosDocenteAula=array[i].texto.split('?');
                            $('#idAula_'+array[i].token).select2({width: '100%'}).val(array[i].idAlumno).trigger('change.select2');

                            $('#docenteImagen_'+array[i].token).attr('src',atosDocenteAula[0]);
                            $('#docenteMail_'+array[i].token).html(atosDocenteAula[1]);
                            $('#docenteTelefono_'+array[i].token).html(agregarEspacios(atosDocenteAula[2]));
                            $('#datoDocente_'+array[i].token).show();
                            
                        }
                    }
                    
                    if(vermodal==1){
                        $('#xlarge').modal('show');
                    }
                }else if(array.length !=0 && array[0].tipo==9){
                    var comodinVarcharDocente=array[0].foto+'?'+array[0].email+'?'+array[0].phone;
                    $('#docenteImagen_'+mi_idAula).attr('src',array[0].foto);
                    $('#docenteMail_'+mi_idAula).html(array[0].email);
                    $('#docenteTelefono_'+mi_idAula).html(array[0].phone);
                    $('#datoDocente_'+mi_idAula).show();

                    valores={_idCurso:0,_miTokenCurso:id_miTokenCurso,_miTokenAula:mi_idAula,_denominacion:"=>",_descripcion:"=>",_comodinVarchar:comodinVarcharDocente,_estado:0,_idDocente:array[0].id,_comodinInt:0,_rows:0,_accion:"asignar_aula_docente",'_token':$('input[name="_token"]').val()};
                    informacion();
                }else if(array.length !=0 && array[0].tipo==10){
                    $('#cboTurnoHorario').html('<option value="">Turno</option>');
                    for (let i = 0; i < array.length; i++) {
                        $('#cboTurnoHorario').append('<option value="'+array[i].turno+"-"+array[i].horas+'">'+array[i].turno+'</option>');
                    }
                }else{ 
                    $('#listaCard').html('<div class="card mb-1"><div class="card-content"><div class="card-body p-0"><div class="bd-example-row"><div class="row m-0">'+
                        '<div class="col-12 text-center">'+
                            '<h2 class="emoSinData animate__animated animate__heartBeat">&#128540;</h2>'+
                            '<p class="m-0">Lo lamento no existen cursos que mostrar</p>'+
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

    var accion=0;
    function listarCursos(){
        valores={_idCurso:0,_denominacion:"=>",_descripcion:"=>",_estado:0,_idDocente:0,_comodinInt:0,_rows:0,_accion:"listar_cursos",'_token':$('input[name="_token"]').val()};
        informacion();
    }listarCursos();

    function listaAulas(){
        valores={_idCurso:0,_denominacion:"=>",_descripcion:"=>",_estado:0,_idDocente:0,_comodinInt:0,_rows:0,_accion:"listar_las_aulas",'_token':$('input[name="_token"]').val()};
        informacion();
    }

    function listaDocentes(){
        valores={_idCurso:0,_denominacion:"=>",_descripcion:"=>",_estado:0,_idDocente:0,_comodinInt:0,_rows:0,_accion:"listar_los_docentes",'_token':$('input[name="_token"]').val()};
        informacion();
    }

    function listaDoscentesCurso(){
        valores={_idCurso:0,_miTokenCurso:id_miTokenCurso,_denominacion:"=>",_descripcion:"=>",_estado:0,_idDocente:0,_comodinInt:0,_rows:0,_accion:"listar_docente_cursos",'_token':$('input[name="_token"]').val()};
        informacion();
    }

    $('#btnGuardar').on('click', function () {
        if(accion==0){
            valores={_idCurso:0,_denominacion:$('#txtDenominacion').val(),_descripcion:$('#txtDescripcion').val(),_estado:0,_idDocente:0,_comodinInt:0,_rows:0,_accion:"insertar",'_token':$('input[name="_token"]').val()};
            informacion();
        }else if(accion==1){
            valores={_idCurso:0,_miTokenCurso:id_miTokenCurso,_denominacion:$('#txtDenominacion').val(),_descripcion:$('#txtDescripcion').val(),_estado:0,_idDocente:0,_comodinInt:0,_rows:0,_accion:"modificar",'_token':$('input[name="_token"]').val()};
            informacion();
        }
    });

    var id_miTokenCurso=0;
    $('#listaCard').on('click', 'div.micard', function(){
        var card=$(this).attr('id').split('_');
        id_miTokenCurso=card[1]; $(".listaCheckbox").prop("checked", false);
        $('.micard').removeClass('caardSelected'); $(this).addClass('caardSelected');
        valores={_idCurso:0,_miTokenCurso:id_miTokenCurso,_denominacion:"=>",_descripcion:"=>",_estado:0,_idDocente:0,_comodinInt:0,_rows:0,_accion:"listar_aulas_sin_cursos",'_token':$('input[name="_token"]').val()};
        informacion();
    });

    $('#ulAulas').on('click', 'input.listaCheckbox', function(){
        var _this=$(this);
        var idAula=$(this).attr('data-id');
        if($('.micard').hasClass('caardSelected')==true){
            valores={_idCurso:0,_miTokenCurso:id_miTokenCurso,_miTokenAula:idAula,_denominacion:"=>",_descripcion:"=>",_estado:0,_idDocente:0,_comodinInt:0,_rows:0,_accion:"asignarCursoAula",'_token':$('input[name="_token"]').val()};
            informacion();
            accion=3;
            $('.1divConfi_'+id_miTokenCurso).removeClass('d-flex');
            $('.2divConfi_'+id_miTokenCurso).show();

            if($(_this).prop("checked")){
                $("#idAula_"+idAula).prop("disabled", false);
            }else{
                $("#idAula_"+idAula).prop("disabled", true);
                $('#datoDocente_'+idAula).attr('style','display:none !important;');
            }
        }else{
            toastr.error("Seleccione un curso", 'Error!');
        };
    });

    function addListaCurso(array){
        if(accion==0){
            var listaCard=$('#listaCard').append(""), denominacion='', cursoAula;
            for (let i = 0; i < array.length; i++) {
                cursoAula=array[i].idAula;
                if(denominacion!=array[i].denominacion){
                    listaCard.prepend
                    ('<div id="card_'+array[i].miTokenCurso+'" class="card mb-1 micard animate__animated animate__flipInX"><div class="card-content"><div class="card-body p-0"><div class="row m-0">'+
                        '<div class="col-9 col-sm-10"><div class="bd-example-row"><div class="row">'+
                            '<div class="col-6 col-sm-8" style="font-size: 0.8rem;">'+
                                '<b>Denominación:</b><p id="cursoDenominacion" class="m-0">'+array[i].denominacion+'</p>'+
                            '</div>'+
                            '<div class="col-6 col-sm-4" style="font-size: 0.8rem;">'+
                                '<b>Año Académico:</b><p class="m-0">'+array[i].anioAcademico+'</p>'+
                            '</div>'+
                            '<div class="col-12 col-sm-12" style="font-size: 0.8rem;">'+
                                '<b>Descripción:</b><p id="cursoDescripcion" class="m-0">'+array[i].descripcion+'</p>'+
                            '</div>'+
                        '</div></div></div>'+
                        '<div class="col-3 col-sm-2">'+
                            '<div class="bd-example-row h-100"><div class="row h-100"><div class="1divConfi_'+array[i].miTokenCurso+' col-12 '+(array[i].idAula==null?'d-flex':' ')+' align-items-center justify-content-center pt-1">'+
                                '<div class="d-flex justify-content-center">'+
                                    '<button type="button" class="btnModificar btn btn-icon btn-flat-primary waves-effect waves-light" data-id="'+array[i].miTokenCurso+'"><i class="feather icon-edit"></i></button>'+
                                    '<button type="button" class="btnEliminar btn btn-icon btn-flat-danger waves-effect waves-light" data-id="'+array[i].miTokenCurso+'"><i class="feather icon-trash-2"></i></button>'+
                                '</div><div class="2divConfi_'+array[i].miTokenCurso+'" style="display:'+(array[i].idAula==null?'none':'block')+';"><hr>'+
                                    '<button type="button" class="btnConfigurar btn btn-icon btn-outline-success w-100 waves-effect waves-light" >'+
                                        '<div class="fonticon-wrap"><i class="feather icon-settings font-large-1 success"></i></div>'+
                                    '</button>'+
                                '</div>'+
                            '</div></div></div>'+
                        '</div>'+
                    '</div></div></div></div>');
                }
                denominacion=array[i].denominacion;
            }
        }else if(accion==1){
            $('#card_'+id_miTokenCurso).addClass('animate__bounce');
            $('#cursoDenominacion').html(array[0].denominacion);
            $('#cursoDescripcion').html(array[0].descripcion);
        }else if(accion==2){
            $('#card_'+id_miTokenCurso).addClass('animate__bounceOut');
            setTimeout(function() { $('#card_'+id_miTokenCurso).remove(); }, 1000);
        }
    }

    $('#listaCard').on('click', 'button.btnModificar', function(){
        id_miTokenCurso=$(this).attr('data-id');
        valores={_idCurso:0,_miTokenCurso:id_miTokenCurso,_denominacion:"=>",_descripcion:"=>",_estado:0,_idDocente:0,_comodinInt:0,_rows:0,_accion:"listar_recuperar",'_token':$('input[name="_token"]').val()};
        informacion();
        $('html, body').animate({scrollTop: 0}, 'slow', function () { 
            $('#btnFormulario').trigger('click');
        });
    });

    $('#listaCard').on('click', 'button.btnEliminar', function(){
        id_miTokenCurso=$(this).attr('data-id');
        Swal.fire({
            title: '¿Está seguro?',
            text: "¡No podrás revertir esto y se eliminara el curso!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, borrarlo',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-danger ml-1',
            buttonsStyling: false,
            cancelButtonText: 'Cancelar',
          }).then(function (result) {
            if (result.value) {
                accion=2;
                valores={_idCurso:0,_miTokenCurso:id_miTokenCurso,_denominacion:"=>",_descripcion:"=>",_estado:0,_idDocente:0,_comodinInt:0,_rows:0,_accion:"eliminar",'_token':$('input[name="_token"]').val()};
                informacion();
            }
          })
    });

    var vermodal=0;
    $('#listaCard').on('click', 'button.btnConfigurar', function () {
        vermodal=1;
        $('#cboTurnoHorario, #txtHoraInicio, #txtHoraFinal').val('');
        $('#dtbHorario td').html("");
    });

    var mi_idAula=0;
    $('#ulAulas').on('change', 'select.select2', function () {
        var recuIdAula=$(this).attr('id').split('_');
        mi_idAula=recuIdAula[1];
        valores={_idCurso:0,_miTokenCurso:id_miTokenCurso,_miTokenAula:mi_idAula,_denominacion:"=>",_descripcion:"=>",_estado:0,_idDocente:$(this).val(),_comodinInt:0,_rows:0,_accion:"listar_dato_docente",'_token':$('input[name="_token"]').val()};
        informacion();
        accion=3;
    });

    $('#btnFormulario').on('click', function(){
        $('.divInicio').hide(); $('.formulario').show();
    });

    $('#btnAnularForm').on('click', function(){
        $('.divInicio').show(); $('.formulario').hide();
        $('#formUsuario')[0].reset();
        accion=0;
    });

    function removerClass() {
        setTimeout(function() { 
            $('.animate__animated').removeClass("animate__flipInX");
            $('.animate__animated').removeClass("animate__fadeInUp");
            $('.animate__animated').removeClass("animate__bounce");
            $('.animate__animated').removeClass("animate__bounceOut");
            vermodal=0;
        }, 1000);
    }

    $("#txtBuscarAula").keyup(function(){
        _this = this;
        $.each($("#ulAulas li"), function() {
            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
               $(this).hide();
            else
               $(this).show();                
        });
    });

    function agregarEspacios(numero) {
        return numero.replace(/\D/g, '').replace(/(\d{3})(?=\d)/g, '$1 ');
    }

    //******************** */

    var valoresHorario='';
    function informacionHorario(){
        $('body').find('ix').hide();
        $.ajax({
            url:'/institucion/curso/horario',
            method:"POST", 
            data:valoresHorario,
            dataType:'JSON',
            success:function(array){
                if(array.length !=0 && array[0].tipo==1){
                    if(array[0].coderror==0){ 
                        toastr.success(array[0].mensaje, 'En hora buena!');
                        $('.btnAgregarHorario').prop("disabled", false);

                        addListaHorario(array);
                    }else{
                        toastr.error(array[0].mensaje, 'Error!');
                        $('.'+diaSemana).removeClass('active');
                        $('.btnAgregarHorario').prop("disabled", false);
                    }
                }else if(array.length !=0 && array[0].tipo==2){
                    $('#dtbHorario td').html("");
                    addListaHorario(array);
                }else{ 
                    $('#dtbHorario td').html("");
                }
            },error:function(msj){
                var resp_c = msj.responseJSON.errors;
                $.each(resp_c,function(key,value){
                    var iderror=value[0].split(','); $('.'+iderror[0]).show();
                    $('.'+iderror[0]).attr('data-original-title', iderror[1])
                    $('.'+iderror[0]).addClass("animate__bounce");
                    setTimeout(function() { $('.'+iderror[0]).removeClass("animate__bounce"); }, 2000);
                });
                $('.'+diaSemana).removeClass('active');
                $('.btnAgregarHorario').prop("disabled", false);
            }
        })
    };

    var diaSemana="";
    $('input.btnAgregarHorario').on('change', function () {
        diaSemana=$(this).attr('id');
        var elTurno=$('#cboTurnoHorario').val().split('-');
     
        valoresHorario={_idHorario:0, _turno:elTurno[0], _diaSemana:diaSemana, _horaInicio:$('#txtHoraInicio').val(), _horaFinal:$('#txtHoraFinal').val(), _miTokenAula:$('#cboAula').val(), _miTokenCurso:id_miTokenCurso, _comodinVarchar:$('#SpDenoCurso').html(), _comodinInt:0, _rows:0, _accion:"insertar", '_token':$('input[name="_token"]').val()}
        informacionHorario();

        $('.btnAgregarHorario').prop("disabled", true);
    });

    var limiteTime="00:00";
    $('#cboTurnoHorario').on('change', function () {
        limiteTime=$(this).val().split('-');
        $('#cboAula').val(''); $('.checkboxCheck').removeClass('active');
        $('#txtHoraInicio, #txtHoraFinal').val('');
    });

    var accionHorario=0;
    $('#cboAula').on('change', function () {
        if($('#cboTurnoHorario').val()!=""){
            var elTurno=$('#cboTurnoHorario').val().split('-');
            valoresHorario={_idHorario:0, _turno:elTurno[0], _horaInicio:'01:00', _horaFinal:'02:00', _miTokenAula:$(this).val(), _comodinInt:0, _rows:0, _accion:"listar", '_token':$('input[name="_token"]').val()}
            informacionHorario();
            $('.checkboxCheck').removeClass('active');
        }else{
            toastr.warning("Seleccione un turno");
        }
    });

    function addListaHorario(array){
        if(accionHorario==0){
            for (let i = 0; i < array.length; i++) {
                var laHoraInicio=array[i].horaInicio.split(':'), laHoraFinal=array[i].horaFinal.split(':');

                $('#td_'+array[i].diaSemana).append
                ('<div id="'+laHoraInicio[0]+":"+laHoraInicio[1]+'" class="horario p-1 animate__animated animate__fadeIn">'+
                    '<small class="text-muted">Hora</small><br>'+
                    '<h6>'+laHoraInicio[0]+":"+laHoraInicio[1]+' - '+laHoraFinal[0]+":"+laHoraFinal[1]+'</h6>'+
                    '<small class="text-muted">Curso</small><br>'+
                    '<h6>'+ acortarTexto(array[i].denoCurso) +'</h6>'+
                '</div>');

                var divs = $('#td_'+array[i].diaSemana+" div").toArray();
                divs.sort(function(a, b) {
                    var horaA = $(a).attr('id').split(':').join('');
                    var horaB = $(b).attr('id').split(':').join('');
                    return horaA - horaB;
                });

                // $('#td_'+array[i].diaSemana).empty();
                for (var k = 0; k < divs.length; k++) {
                    $('#td_'+array[i].diaSemana).append(divs[k]);
                }

            }
        }else if(accionHorario==1){
            // $('#card_'+id_miTokenCurso).addClass('animate__bounce');
            // $('#cursoDenominacion').html(array[0].denominacion);
            // $('#cursoDescripcion').html(array[0].descripcion);
        }else if(accionHorario==2){
            // $('#card_'+id_miTokenCurso).addClass('animate__bounceOut');
            // setTimeout(function() { $('#card_'+id_miTokenCurso).remove(); }, 1000);
        }
    }

    $('#txtHoraInicio, #txtHoraFinal').on('change', function () {
        if($('#txtHoraInicio').val()<limiteTime[1]){
            toastr.error("La hora de Inicio no debe ser menor que: "+limiteTime[1], 'Error!');
            $(this).val(limiteTime[1]);
        }else if($('#txtHoraFinal').val()>limiteTime[2]){
            toastr.error("La hora de Final no debe ser mayor que: "+limiteTime[2], 'Error!');
            $(this).val(limiteTime[2]);
        }
        $('.checkboxCheck').removeClass('active');
    });

    function acortarTexto(texto, longitudMaxima) {
        if (texto.length > longitudMaxima) {
          return texto.substring(0, longitudMaxima) + '...';
        } else {
          return texto;
        }
    }
});