$(document).ready(function() {
    $('form').attr('autocomplete', 'off');
    var valores='', rows=0, tipolista=0;
    function informacion(){
        $('body').find('ix').hide();
        $.ajax({
            url:'/usuarios/admin',
            method:"POST",
            data:valores,
            dataType:'JSON',
            success:function(array){                
                setTimeout(function() { $('#listaCard .card').removeClass("animate__flipInX"); }, 2000);
                if(array.length !=0 && array[0].tipo==1){
                    if(array[0].coderror==0){
                        toastr.success(array[0].mensaje, 'En hora buena!');
                        addListaCard(array);
                        $('#btnAnularForm').trigger('click');

                        var cantidades=array[0].cantidades.split(',');
                        $('#countUser').html(cantidades[0]); $('#countRol').html(cantidades[1]); $('#countPermisos').html(cantidades[2]);
                    }else{
                        toastr.error(array[0].mensaje, 'Error!');
                    }
                }else if(array.length !=0 && array[0].tipo==2){
                    $('#listaCard').html('');
                    var listaCard=$('#listaCard').append(''); eldni='';
                    var colorUsuario="";
                    for (let i = 0; i < array.length; i++) {
                        array[i].tipoUsuario=="ASMINISTRADOR" ? colorUsuario="danger" : array[i].tipoUsuario=="Director" ? colorUsuario="primary" : array[i].tipoUsuario=="Secretario" ? colorUsuario="info" : array[i].tipoUsuario=="Docente" ? colorUsuario="warning" : array[i].tipoUsuario=="Alumno" ? colorUsuario="success" : array[i].tipoUsuario=="Auxiliar" ? colorUsuario="secondary" : colorUsuario="secondary" ;
                        var cantidades=array[i].cantidades.split(',');
                        $('#countUser').html(cantidades[0]); $('#countRol').html(cantidades[1]); $('#countPermisos').html(cantidades[2]); 
                        if (eldni!=array[i].dni) {
                            listaCard.append
                            ('<div id="card_'+array[i].id+'" class="card mb-1 micard animate__animated animate__flipInX" data-id="'+array[i].id+'">'+
                                '<div class="card-content">'+
                                    '<div class="card-body p-0">'+
                                        '<div class="bd-example-row">'+
                                            '<div class="row m-0">'+
                                                '<div class="col-3 col-sm-2 text-center">'+
                                                    '<img src="'+array[i].foto+'" class="rounded" alt="profile image" height="64" width="64">'+
                                                    '<div id="m_tipoUsuario" class="badge badge-'+colorUsuario+'"> '+ acortarTexto(array[i].tipoUsuario, 7)+' </div>'+
                                                '</div>'+
                                                '<div class="col-6 col-sm-8" style="font-size: 0.8rem;">                        '+
                                                    '<p id="m_name" class="m-0"><b>Nombre: </b> '+array[i].name+', '+array[i].apellidos+'</p>'+
                                                    '<p id="m_dni" class="m-0"><b>Documento: </b> '+array[i].dni+'</p>'+
                                                    '<p id="m_phone" class="m-0"><b>Celular: </b> '+array[i].phone+'</p>'+
                                                    '<p id="m_email" class="m-0"><b>Correo: </b> '+array[i].email+'</p>'+
                                                '</div>'+
                                                '<div class="col-3 col-sm-2 d-flex align-items-center justify-content-center">'+
                                                    '<div class="d-flex justify-content-center">'+
                                                        '<button type="button" class="btnModificar btn btn-icon btn-flat-primary waves-effect waves-light" data-id="'+array[i].id+'"><i class="feather icon-edit"></i></button>'+
                                                        '<button type="button" class="btnEliminar btn btn-icon btn-flat-danger waves-effect waves-light" data-id="'+array[i].id+'"><i class="feather icon-trash-2"></i></button>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>');                            
                        }eldni=array[i].dni;

                        if(i==array.length-1){
                            listaRol();
                            setTimeout(function() { $('#listaCard .card').removeClass("animate__flipInX"); }, 2000);
                        }
                    }
                }else if(array.length !=0 && array[0].tipo==3){
                    $('#ulRole').html('');
                    var ulRole=$('#ulRole').append('');
                    for (let i = 0; i < array.length; i++) {
                        ulRole.append
                        ('<li class="list-group-item" style="border-top: 0;"">'+
                            '<div class="d-flex justify-content-between">'+
                                '<fieldset>'+
                                    '<div class="vs-checkbox-con vs-checkbox-primary">'+
                                        '<input id="checkbox_'+array[i].id+'" type="checkbox" value="false" class="listaCheckbox" data-id="'+array[i].id+'">'+
                                        '<span class="vs-checkbox">'+
                                            '<span class="vs-checkbox--check">'+
                                                '<i class="vs-icon feather icon-check"></i>'+
                                            '</span>'+
                                        '</span>'+
                                        '<span class="">'+array[i].name+'</span>'+
                                    '</div>'+
                                '</fieldset>'+
                            '</div>'+
                        '</li>'); 
                    }
                }else if(array.length !=0 && array[0].tipo==4){
                    $('.llistaPermiso').show();
                    var ulPermisos=$('#ulPermisos').append('');
                    var colors = ['primary', 'warning', 'success'];

                    asignarRol();

                    for (let i = 0; i < array.length; i++) {
                        var color = colors[i % colors.length];
                        if(listaPermisos==0){
                            if ($('#ulPermisos li#liPer_'+array[i].id).length === 0) {
                                ulPermisos.append
                                ('<li id="liPer_'+array[i].id+'" class="list-group-item animate__animated animate__fadeIn" style="border-top: 0;">'+
                                    '<a href="#" class="d-flex justify-content-between">'+
                                        '<div class="series-info">'+
                                            '<i class="feather icon-check-square text-'+color+'"></i>'+
                                            '<span class="text-bold-600">&nbsp;'+array[i].name+'</span>'+
                                        '</div>'+
                                        '<div class="product-result">'+
                                            '<i class="feather icon-info cursor-pointer text-dark" data-toggle="tooltip" data-placement="top" title="" data-original-title="Obligatorio"></i>'+
                                        '</div>'+
                                    '</a>'+
                                '</li>')                            
                            }
                        }else{
                            $('li#liPer_'+array[i].id).remove();
                            if(i==array.length-1){
                                valores={_id:elIdUser,_name:"=>",_apellidos:'=>',_dni:'=>',_email:'x@g.c',_tipo:'=>',_idRol:0,_rows:rows,_accion:'lista_usuario_roleds_permisos','_token':$('input[name="_token"]').val()};
                                informacion();                                
                            }
                        }
                    }
                }else if(array.length !=0 && array[0].tipo==5){
                    $('.llistaPermiso').show();
                    $('#ulPermisos').html('');
                    var ulPermisos=$('#ulPermisos').append(''); los_Permisos='';
                    var colors = ['primary', 'warning', 'success'];
                    for (let i = 0; i < array.length; i++) {
                        $("#checkbox_"+array[i].idRol).prop("checked", true);

                        var color = colors[i % colors.length];
                        if(los_Permisos!=array[i].denoPermiso){
                            ulPermisos.append
                            ('<li id="liPer_'+array[i].idPermiso+'" class="list-group-item animate__animated animate__fadeIn" style="border-top: 0;">'+
                                '<a href="#" class="d-flex justify-content-between">'+
                                    '<div class="series-info">'+
                                        '<i class="feather icon-check-square text-'+color+'"></i>'+
                                        '<span class="text-bold-600">&nbsp;'+array[i].denoPermiso+'</span>'+
                                    '</div>'+
                                    '<div class="product-result">'+
                                        '<i class="feather icon-info cursor-pointer text-dark" data-toggle="tooltip" data-placement="top" title="" data-original-title="Obligatorio"></i>'+
                                    '</div>'+
                                '</a>'+
                            '</li>');
                        }los_Permisos=array[i].denoPermiso;
                    }
                }else if(array.length !=0 && array[0].tipo==6){
                    $('#card_'+elIdUser).prependTo('#listaCard').addClass("animate__fadeInUp");
                    $('#txtNombre').val(array[0].name); 
                    $('#txtApellido').val(array[0].apellidos);
                    $('#txtDDocumento').val(array[0].dni);
                    $('#txtCelular').val(array[0].phone);
                    $('#txtCorreo').val(array[0].email);
                    $('#cboTipoUsuario').val(array[0].tipoUsuario);
                    setTimeout(function() { $('.divInicio').hide(); $('.formulario').show(); }, 500); // abrir el formulario en 100
                }else{ 
                    if(tipolista==0){
                        $('#listaCard').html('<div class="card mb-1"><div class="card-content"><div class="card-body p-0"><div class="bd-example-row"><div class="row m-0">'+
                                '<div class="col-12 text-center">'+
                                    '<h2 class="emoSinData animate__animated animate__heartBeat">&#128540;</h2>'+
                                    '<p class="m-0">Lo lamento no existen permisos que mostrar </p>'+
                                '</div>'+
                            '</div></div></div></div></div>');
                    }
                }
            },
            error:function(msj){
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

    function listaPersonas(){
        tipolista=0;
        valores={_id:0,_name:"=>",_apellidos:'=>',_dni:'=>',_email:'x@g.c',_tipo:'=>',_idRol:0,_rows:rows,_accion:'lista_usuarios','_token':$('input[name="_token"]').val()};
        informacion();
    }listaPersonas();

    function listaRol(){
        tipolista=1;
        valores={_id:0,_name:"=>",_apellidos:'=>',_dni:'=>',_email:'x@g.c',_tipo:'=>', _idRol:0,_rows:rows,_accion:'lista_roles','_token':$('input[name="_token"]').val()};
        informacion();
    }

    function asignarRol(){
        valores={_id:elIdUser,_name:"=>",_apellidos:'=>',_dni:'=>',_email:'x@g.c',_tipo:'=>',_idRol:elIdRl,_rows:rows,_accion:'usuario_roles','_token':$('input[name="_token"]').val()};
        informacion();
    }

    var elIdUser;
    $('#listaCard').on('click', 'div.micard', function(){
        tipolista=1; elIdUser=$(this).attr('data-id');
        $(".listaCheckbox").prop("checked", false); $('.micard').removeClass('caardSelected'); $(this).addClass('caardSelected');
        $('.llistaPermiso').hide();
        valores={_id:elIdUser,_name:"=>",_apellidos:'=>',_dni:'=>',_email:'x@g.c',_tipo:'=>',_idRol:0,_rows:rows,_accion:'lista_usuario_roleds_permisos','_token':$('input[name="_token"]').val()};
        informacion();
    });

    var listaPermisos=0, elIdRl=0;
    $('#ulRole').on('click', 'input.listaCheckbox', function(){
        tipolista=1; elIdRl=$(this).attr('data-id');
        if($('.micard').hasClass('caardSelected')==true){
            valores={_id:0,_name:"=>",_apellidos:'=>',_dni:'=>',_email:'x@g.c',_tipo:'=>',_idRol:elIdRl,_rows:rows,_accion:'lista_permisos','_token':$('input[name="_token"]').val()};
            informacion();
            laAccion=4;
            $(this).prop('checked') ? listaPermisos=0 : listaPermisos=1;
        }else{
            toastr.error("Seleccione un usuario", 'Error!');
            
        }
    });

    var laAccion=0;
    $('#btnGuardar').on('click', function(){
        if(laAccion==0){
            valores={_id:0,_name:$('#txtNombre').val(),_apellidos:$('#txtApellido').val(),_dni:$('#txtDDocumento').val(),_phone:$('#txtCelular').val(),_email:$('#txtCorreo').val(),_tipo:$('#cboTipoUsuario').val(),_idRol:0,_rows:rows,_accion:'insertar','_token':$('input[name="_token"]').val()};
            informacion();
        }else{
            valores={_id:elIdUser,_name:$('#txtNombre').val(),_apellidos:$('#txtApellido').val(),_dni:$('#txtDDocumento').val(),_phone:$('#txtCelular').val(),_email:$('#txtCorreo').val(),_tipo:$('#cboTipoUsuario').val(),_idRol:0,_rows:rows,_accion:'modificar','_token':$('input[name="_token"]').val()};
            informacion();
        }
    });

    function addListaCard(array){
        if(laAccion==0){ // insertar
            var colorUsuario="";
            array.forEach(function(element) {
                array[0].tipoUsuario=="ASMINISTRADOR" ? colorUsuario="danger" : array[0].tipoUsuario=="Director" ? colorUsuario="primary" : array[0].tipoUsuario=="Secretario" ? colorUsuario="info" : array[0].tipoUsuario=="Docente" ? colorUsuario="warning" : array[0].tipoUsuario=="Alumno" ? colorUsuario="success" : array[0].tipoUsuario=="Auxiliar" ? colorUsuario="secondary" : colorUsuario="secondary" ;
                $('#listaCard').prepend
                ('<div id="card_'+array[0].id+'" class="card mb-1 micard animate__animated animate__flipInX" data-id="'+array[0].id+'">'+
                    '<div class="card-content">'+
                        '<div class="card-body p-0">'+
                            '<div class="bd-example-row">'+
                                '<div class="row m-0">'+
                                    '<div class="col-3 col-sm-2 text-center">'+
                                        '<img src="../../../app-assets/images/portrait/small/user.png" class="rounded" alt="profile image" height="64" width="64">'+
                                        '<div id="m_tipoUsuario" class="badge badge-'+colorUsuario+'"> '+ acortarTexto(array[0].tipoUsuario, 7)+' </div>'+
                                    '</div>'+
                                    '<div class="col-6 col-sm-8" style="font-size: 0.8rem;">                        '+
                                        '<p id="m_name" class="m-0"><b>Nombre: </b> '+array[0].name+', '+array[0].apellidos+'</p>'+
                                        '<p id="m_dni" class="m-0"><b>Documento: </b> '+array[0].dni+'</p>'+
                                        '<p id="m_phone" class="m-0"><b>Celular: </b> '+array[0].phone+'</p>'+
                                        '<p id="m_email" class="m-0"><b>Correo: </b> '+array[0].email+'</p>'+
                                    '</div>'+
                                    '<div class="col-3 col-sm-2 d-flex align-items-center justify-content-center">'+
                                        '<div class="d-flex justify-content-center">'+
                                            '<button type="button" class="btnModificar btn btn-icon btn-flat-primary waves-effect waves-light" data-id="'+array[0].id+'"><i class="feather icon-edit"></i></button>'+
                                            '<button type="button" class="btnEliminar btn btn-icon btn-flat-danger waves-effect waves-light" data-id="'+array[0].id+'"><i class="feather icon-trash-2"></i></button>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>'); 
            });
        }else if(laAccion==1){
            $('#m_name').html('<b>Nombre: </b> '+array[0].name+', '+array[0].apellidos);
            $('#m_dni').html('<b>Documento: </b> '+array[0].dni);
            $('#m_phone').html('<b>Celular: </b> '+array[0].phone);
            $('#m_email').html('<b>Correo: </b> '+array[0].email);
            var colorUsuario="";
            array[0].tipoUsuario=="ASMINISTRADOR" ? colorUsuario="badge badge-danger" : array[0].tipoUsuario=="Director" ? colorUsuario="badge badge-primary" : array[0].tipoUsuario=="Secretario" ? colorUsuario="badge badge-info" : array[0].tipoUsuario=="Docente" ? colorUsuario="badge badge-warning" : array[0].tipoUsuario=="Alumno" ? colorUsuario="badge badge-success" : array[0].tipoUsuario=="Auxiliar" ? colorUsuario="badge badge-secondary" : colorUsuario="badge badge-secondary" ;
            $('#m_tipoUsuario').attr('class',"").addClass(colorUsuario).html(acortarTexto(array[0].tipoUsuario, 7));

        }else{
            $('#card_'+array[0].id).addClass('animate__bounceOut');
            setTimeout(function() { $('#card_'+array[0].id).remove(); }, 1000);
        }
    }

    $('#listaCard').on('click', 'button.btnModificar', function(){
        laAccion=1; elIdUser=$(this).attr('data-id');
        valores={_id:elIdUser,_name:"=>",_apellidos:'=>',_dni:'=>',_email:'x@g.c',_tipo:'=>',_idRol:elIdRl,_rows:rows,_accion:'recupear','_token':$('input[name="_token"]').val()};
        informacion();
        $('html, body').animate({scrollTop: 0}, 'slow');
    });

    $('#listaCard').on('click', 'button.btnEliminar', function(){
        laAccion=2; elIdUser=$(this).attr('data-id');
        Swal.fire({
            title: '¿Está seguro?',
            text: "¡No podrás revertir esto y se eliminara el usuario!",
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
                valores={_id:elIdUser,_name:"=>",_apellidos:'=>',_dni:'=>',_email:'x@g.c',_tipo:'=>',_idRol:elIdRl,_rows:rows,_accion:'eliminar','_token':$('input[name="_token"]').val()};
                informacion();
            }
          })
    });

    $('#btnFormulario').on('click', function(){
        $('.divInicio').hide(); $('.formulario').show();
    });

    $('#btnAnularForm').on('click', function(){
        $('.divInicio').show(); $('.formulario').hide();
        laAccion=0;
        $('#formUsuario')[0].reset();
    });

    function acortarTexto(texto, longitudMaxima) {
        if (texto.length > longitudMaxima) {
          return texto.substring(0, longitudMaxima) + '...';
        } else {
          return texto;
        }
    }
});