$(document).ready(function() {

    valores='';
    function informacion(){
        $('body').find('ix').hide();
        $.ajax({
            url:'/institucion/aula',
            method:"POST",
            data:valores,
            dataType:'JSON',
            success:function(array){
                if(array.length !=0 && array[0].tipo==1){
                    if (array[0].coderror==0) {
                        toastr.success(array[0].mensaje, 'En hora buena!');
                        addListaCard(array);
                        $('#btnAnularForm').trigger('click');

                        try {
                            listaAlumnos();
                            var cantidades=array[0].cantidades.split(',');
                            $('#countAulas').html(cantidades[0]);   
                            $('#countCursos').html(cantidades[1]);      
                        } catch (error) {
                            $('#liCheckbox_'+array[0].id).addClass('animate__bounceOut');
                            setTimeout(function() {$('#liCheckbox_'+array[0].id).remove();}, 1000);
                            accionAulaAlumno=1;
                            if ($(".listaAulaAlumno").is(":hidden")) {
                                $(".listaAulaAlumno").show(); 
                            }
                            addLisAulaAlumno(array);
                        }
                    }else{
                        toastr.error(array[0].mensaje, 'Error!');
                    }
                }else if(array.length !=0 && array[0].tipo==2){
                    var listaCard=$('#listaCard').append("");
                    for (let i = 0; i < array.length; i++) {
                        var cantidades=array[i].cantidades.split(',');
                        $('#countAulas').html(cantidades[0]);
                        $('#countCursos').html(cantidades[1]);
                        listaCard.append
                        ('<div id="card_'+array[i].idAula+'" class="card mb-1 micard animate__animated animate__flipInX">'+
                            '<div class="card-content">'+
                                '<div class="card-body p-0">'+
                                    '<div class="bd-example-row">'+
                                        '<div class="row m-0">'+
                                            '<div class="col-12 col-sm-5" style="font-size: 0.8rem;">'+
                                                '<b>Denominación:</b>'+
                                                '<p id="denominacion_'+array[i].idAula+'" class="m-0">'+array[i].denominacion+'</p>'+
                                            '</div>'+
                                            '<div class="col-9 col-sm-5" style="font-size: 0.8rem;">                        '+
                                                '<p id="seccion_'+array[i].idAula+'" class="m-0"><b>Sección: </b>'+array[i].seccion+'</p>'+
                                                '<p id="capacidad_'+array[i].idAula+'" class="m-0"><b>Capacidad: </b>'+array[i].capacidad+'</p>'+
                                            '</div>'+
                                            '<div class="col-3 col-sm-2 d-flex align-items-center justify-content-center">'+
                                                '<div class="d-flex justify-content-center">'+
                                                    '<button type="button" class="btnModificar btn btn-icon btn-flat-primary waves-effect waves-light" data-id="'+array[i].idAula+'"><i class="feather icon-edit"></i></button>'+
                                                    '<button type="button" class="btnEliminar btn btn-icon btn-flat-danger waves-effect waves-light" data-id="'+array[i].idAula+'"><i class="feather icon-trash-2"></i></button>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                         '</div>');
                         if(i==array.length-1){
                            listaAlumnos();
                         }
                    }
                }else if(array.length !=0 && array[0].tipo==3){// recuperar los inscritos al aula
                    $('#card_'+mi_idAula).prependTo('#listaCard').addClass("animate__fadeInUp");
                    $('#txtDenominacion').val(array[0].denominacion);
                    $('#cboSeccion').val(array[0].seccion);
                    $('#txtCapacidad').val(array[0].capacidad);
                }else if(array.length !=0 && array[0].tipo==4){ // lsta allumnos                    
                    $('#ulAlumnos').html('');
                    var ulAlumnos=$('#ulAlumnos').append("");
                    var colors = ['primary', 'warning', 'success'];                    
                    if(array[0].coderror==0){
                        for (let i = 0; i < array.length; i++) {
                            var color = colors[i % colors.length];
                            ulAlumnos.append
                            ('<li id="liCheckbox_'+array[i].id+'" class="list-group-item animate__animated animate__fadeIn" style="border-top: 0;">'+
                                '<div class="d-flex justify-content-between">'+
                                    '<fieldset>'+
                                        '<div class="vs-checkbox-con vs-checkbox-primary">'+
                                            '<input id="checkbox_'+array[i].id+'" type="checkbox" class="listaCheckbox" value="false" data-id="'+array[i].id+'">'+
                                            '<span class="vs-checkbox vs-checkbox-sm">'+
                                                '<span class="vs-checkbox--check">'+
                                                    '<i class="vs-icon feather icon-check"></i>'+
                                                '</span>'+
                                            '</span>'+
                                            '<span class="">'+array[i].name+', '+array[i].apellidos+'</span>'+
                                        '</div>'+
                                    '</fieldset>'+
                                    '<div class="product-result"><i class="feather icon-user font-small-3 text-'+color+'"></i></div>'+
                                '</div>'+
                            '</li>');
                        }
                    }else if(array[0].coderror==1){
                        ulAlumnos.append
                        ('<li class="list-group-item sinAlumnos" style="border-top: 0;">'+
                            '<div class="col-12 text-center">'+
                                '<h2 class="emoSinData animate__animated animate__heartBeat">&#128540;</h2>'+
                                '<p class="m-0">En hora buena, todos los alumnos fueron asignados a sus aulas </p>'+
                            '</div>'+
                        '</li>');
                    }else{
                        ulAlumnos.append
                        ('<li class="list-group-item sinAlumnos" style="border-top: 0;">'+
                            '<div class="col-12 text-center">'+
                                '<h2 class="emoSinData animate__animated animate__heartBeat">&#128540;</h2>'+
                                '<p class="m-0">'+array[0].mensaje+'</p>'+
                            '</div>'+
                        '</li>');
                    }
                }else if(array.length !=0 && array[0].tipo==5){
                    if(array[0].coderror==0){
                        $('.listaAulaAlumno').show();
                        accionAulaAlumno=0;
                        addLisAulaAlumno(array);
                        listaAlumnos();
                    }else{
                        $('.listaAulaAlumno').hide();
                        $('#listaAulaAlumno').html('');
                    }
                }else if(array.length !=0 && array[0].tipo==6){
                    $('#aulaAlumno_'+array[0].idEliminado).addClass('animate__bounceOut');
                    setTimeout(function() {$('#aulaAlumno_'+array[0].idEliminado).remove();}, 1000);

                    toastr.success(array[0].mensaje, 'En hora buena!');
                    $('#ulAlumnos').prepend
                    ('<li id="liCheckbox_'+array[0].id+'" class="list-group-item animate__animated animate__fadeIn" style="border-top: 0;">'+
                        '<div class="d-flex justify-content-between">'+
                            '<fieldset>'+
                                '<div class="vs-checkbox-con vs-checkbox-primary">'+
                                    '<input id="checkbox_'+array[0].id+'" type="checkbox" class="listaCheckbox" value="false" data-id="'+array[0].id+'">'+
                                    '<span class="vs-checkbox vs-checkbox-sm">'+
                                        '<span class="vs-checkbox--check">'+
                                            '<i class="vs-icon feather icon-check"></i>'+
                                        '</span>'+
                                    '</span>'+
                                    '<span class="">'+array[0].name+', '+array[0].apellidos+'</span>'+
                                '</div>'+
                            '</fieldset>'+
                            '<div class="product-result"><i class="feather icon-user font-small-3 text-'+color+'"></i></div>'+
                        '</div>'+
                    '</li>');

                    $('.sinAlumnos').hide();
                }else{ 
                    if(listaAula==0){
                        $('#listaCard').html('<div class="card mb-1"><div class="card-content"><div class="card-body p-0"><div class="bd-example-row"><div class="row m-0">'+
                                '<div class="col-12 text-center">'+
                                    '<h2 class="emoSinData animate__animated animate__heartBeat">&#128540;</h2>'+
                                    '<p class="m-0">Lo lamento no existen permisos que mostrar </p>'+
                                '</div>'+
                            '</div></div></div></div></div>');
                    }
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
 
    var _rowAulas=0, listaAula=0;
    function lista(){
        listaAula=0;
        valores={_idAula:0,_denominacion:"=>",_seccion:"=>",_capacidad:0,_estado:0,_idAllumno:0,_rows:_rowAulas,_accion:"listar_aulas",'_token':$('input[name="_token"]').val()};
        informacion();
    }lista();

    var _rowAlumnos=0;
    function listaAlumnos(){
        listaAula=1;
        valores={_idAula:0,_denominacion:"=>",_seccion:"=>",_capacidad:0,_estado:0,_idAllumno:0,_rows:_rowAlumnos,_accion:"Alumnos_sin_Aula",'_token':$('input[name="_token"]').val()};
        informacion();
    }

    var accion=0;
    $('#btnGuardar').on('click', function(){
        if (accion==0) {
            valores={_idAula:0,_denominacion:$('#txtDenominacion').val(),_seccion:$('#cboSeccion').val(),_capacidad:$('#txtCapacidad').val(),_estado:0,_idAllumno:0,_rows:0,_accion:"insertar",'_token':$('input[name="_token"]').val()};
            informacion();            
        }else{
            valores={_idAula:0,_mtoken:mi_idAula,_denominacion:$('#txtDenominacion').val(),_seccion:$('#cboSeccion').val(),_capacidad:$('#txtCapacidad').val(),_estado:0,_idAllumno:0,_rows:0,_accion:"modificar",'_token':$('input[name="_token"]').val()};
            informacion(); 
        }
    });

    var mi_idAula=0;
    $('#listaCard').on('click', 'div.micard', function(){
        var card=$(this).attr('id').split('_');
        mi_idAula=card[1]; listaAula=1; $(".listaCheckbox").prop("checked", false);
        $('.micard').removeClass('caardSelected'); $(this).addClass('caardSelected');
        valores={_idAula:0,_mtoken:mi_idAula,_denominacion:"=>",_seccion:"=>",_capacidad:0,_estado:0,_idAllumno:0,_rows:_rowAlumnos,_accion:"listar_Aula_Alumnos",'_token':$('input[name="_token"]').val()};
        informacion();
    });

    $('#ulAlumnos').on('click', 'input.listaCheckbox', function(){
        var idAlumno=$(this).attr('data-id'); listaAula=1;
        if($('.micard').hasClass('caardSelected')==true){
            valores={_idAula:0,_mtoken:mi_idAula,_denominacion:"=>",_seccion:"=>",_capacidad:0,_estado:0,_idAllumno:idAlumno,_rows:_rowAlumnos,_accion:"asignar_aula_alumno",'_token':$('input[name="_token"]').val()};
            informacion();
            accion=3;
        }else{
            toastr.error("Seleccione un aula", 'Error!');
        };
    });

    function addListaCard(array){
        if(accion==0){
            array.forEach(function(element) {
                $('#listaCard').prepend
                ('<div id="card_'+array[0].idAula+'" class="card mb-1 micard animate__animated animate__flipInX">'+
                    '<div class="card-content">'+
                        '<div class="card-body p-0">'+
                            '<div class="bd-example-row">'+
                                '<div class="row m-0">'+
                                    '<div class="col-12 col-sm-5" style="font-size: 0.8rem;">'+
                                        '<b>Denominación:</b>'+
                                        '<p id="denominacion_'+array[0].idAula+'" class="m-0">'+array[0].denominacion+'</p>'+
                                    '</div>'+
                                    '<div class="col-9 col-sm-5" style="font-size: 0.8rem;">                        '+
                                        '<p id="seccion_'+array[0].idAula+'" class="m-0"><b>Sección: </b>'+array[0].seccion+'</p>'+
                                        '<p id="capacidad_'+array[0].idAula+'" class="m-0"><b>Capacidad: </b>'+array[0].capacidad+'</p>'+
                                    '</div>'+
                                    '<div class="col-3 col-sm-2 d-flex align-items-center justify-content-center">'+
                                        '<div class="d-flex justify-content-center">'+
                                        '<button type="button" class="btnModificar btn btn-icon btn-flat-primary waves-effect waves-light" data-id="'+array[0].idAula+'"><i class="feather icon-edit"></i></button>'+
                                            '<button type="button" class="btnEliminar btn btn-icon btn-flat-danger waves-effect waves-light" data-id="'+array[0].idAula+'"><i class="feather icon-trash-2"></i></button>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>');
            });
        }else if(accion==1){
            $('#card_'+array[0].idAula).addClass('animate__bounce');
            $('#denominacion_'+array[0].idAula).html(array[0].denominacion);
            $('#seccion_'+array[0].idAula).html('<b>Sección: </b>'+array[0].seccion);
            $('#capacidad_'+array[0].idAula).html('<b>Capacidad: </b>'+array[0].capacidad);
        }else if(accion==2){
            $('#card_'+array[0].idAula).addClass('animate__bounceOut');
            setTimeout(function() { $('#card_'+array[0].idAula).remove(); }, 1000);

            $("#listaAulaAlumno").empty();
            $('.listaAulaAlumno').hide();
        }
    }

    $('#listaCard').on('click', 'button.btnModificar', function(){
        accion=1; mi_idAula=$(this).attr("data-id");
        valores={_idAula:0,_mtoken:mi_idAula,_denominacion:"=>",_seccion:"=>",_capacidad:0,_estado:0,_idAllumno:0,_rows:0,_accion:"recupear",'_token':$('input[name="_token"]').val()};
        informacion();
        $('html, body').animate({scrollTop: 0}, 'slow', function () { 
            $('#btnFormulario').trigger('click');
         });
    });

    $('#listaCard').on('click', 'button.btnEliminar', function(){
        mi_idAula=$(this).attr('data-id');
        Swal.fire({
            title: '¿Está seguro?',
            text: "¡No podrás revertir esto y se eliminara el aula!",
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
                valores={_idAula:0,_mtoken:mi_idAula,_denominacion:"=>",_seccion:"=>",_capacidad:0,_estado:0,_idAllumno:0,_rows:0,_accion:"eliminar",'_token':$('input[name="_token"]').val()};
                informacion();
            }
          })
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
        $('#listaCard .card').removeClass("animate__fadeInUp");
        $('#listaCard .card').removeClass("animate__bounce");
        $('.animate__animated').removeClass("animate__fadeIn");
    }, 2000);
    }

    var accionAulaAlumno=0;
    function addLisAulaAlumno(array){
        if(accionAulaAlumno==0){
            $('#listaAulaAlumno').html('');
            for (let i = 0; i < array.length; i++) {
                $('#listaAulaAlumno').prepend
                ('<div id="aulaAlumno_'+array[i].idAulaAlumno+'" class="d-flex justify-content-start align-items-center mb-1 micard animate__animated animate__flipInX">'+
                    '<div class="avatar mr-50"><img src="'+array[i].foto+'" alt="avtar img holder" height="35" width="35"></div>'+
                    '<div class="user-page-info"><h6 class="mb-0">'+array[i].name+', '+array[i].apellidos+'</h6><span class="font-small-2">'+array[i].dni+'</span></div>'+
                    '<button type="button" class="quitarAlumnoAula btn btn-primary btn-icon ml-auto waves-effect waves-light" data-id="'+array[i].idAulaAlumno+'"><i class="feather icon-user-minus"></i></button>'+
                '</div>');            
            }
        }else{
            for (let i = 0; i < array.length; i++) {
                $('#listaAulaAlumno').prepend
                ('<div id="aulaAlumno_'+array[i].idAulaAlumno+'" class="d-flex justify-content-start align-items-center mb-1 micard animate__animated animate__flipInX">'+
                    '<div class="avatar mr-50"><img src="'+array[i].foto+'" alt="avtar img holder" height="35" width="35"></div>'+
                    '<div class="user-page-info"><h6 class="mb-0">'+array[i].name+', '+array[i].apellidos+'</h6><span class="font-small-2">'+array[i].dni+'</span></div>'+
                    '<button type="button" class="quitarAlumnoAula btn btn-primary btn-icon ml-auto waves-effect waves-light" data-id="'+array[i].idAulaAlumno+'"><i class="feather icon-user-minus"></i></button>'+
                '</div>');            
            }
        }
    }

    $('#listaAulaAlumno').on('click', 'button.quitarAlumnoAula', function(){
        valores={_idAula:$(this).attr('data-id'),_denominacion:"=>",_seccion:"=>",_capacidad:0,_estado:0,_idAllumno:0,_rows:_rowAulas,_accion:"quitar_alumno_aula",'_token':$('input[name="_token"]').val()};
        informacion();
    });

    $("#txtbuscarAlumno").keyup(function(){
        _this = this;
        $.each($("#ulAlumnos li"), function() {
            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
               $(this).hide();
            else
               $(this).show();                
        });
    });

    $("#btnBuscarAlumno").on('click', function(){
        valores={_idAula:0,_denominacion:$("#txtbuscarAlumno").val(),_seccion:"=>",_capacidad:0,_estado:0,_idAllumno:0,_rows:_rowAlumnos,_accion:"buscar_alumno_sin_aulla",'_token':$('input[name="_token"]').val()};
        informacion();
        $('#btnBuscarAlumnoAnular').show();
    });

    $("#btnBuscarAlumnoAnular").on('click', function(){
        listaAlumnos(); $("#txtbuscarAlumno").val('');
        $(this).hide();
    });

    
}); 