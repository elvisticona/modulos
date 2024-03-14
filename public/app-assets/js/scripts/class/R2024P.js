$(document).ready(function() {
    
    var valores='', lista='0', accion=0;
    function informacion(){
        $('body').find('ix').hide();
        $.ajax({
            url:'/usuarios/roles/admin',
            method:"POST",
            data:valores,
            dataType:'JSON',
            success:function(array){                
                setTimeout(function() { $('#listaCard .card').removeClass("animate__flipInX"); }, 2000);
                if(array.length !=0 && array[0].tipo==1){
                    if(array[0].coderror==0){
                        toastr.success(array[0].mensaje, 'En hora buena!');
                        addListaCard(array);
                        $('#txtRol').val('');
                        accion=0; idrol=0;
                        $('#listaCard .micard').removeClass('caardSelected');//
                        var cantidadesx=array[0].cantidades.split(',');
                        $('#countUser').html(cantidadesx[0]); $('#countRol').html(cantidadesx[1]); $('#countPermisos').html(cantidadesx[2]); 
                    }else{
                        toastr.error(array[0].mensaje, 'Error!');
                    }
                }else if(array.length !=0 && array[0].tipo==2){
                    $('#listaCard').html(''); $('#ulPermisos').html(''); 
                    var listaCard=$('#listaCard').append(''), ulPermisos=$('#ulPermisos').append(''), elRol=0, elPermiso=0;
                    for (let i = 0; i < array.length; i++) {
                        var cantidades=array[i].cantidades.split(',');
                        $('#countUser').html(cantidades[0]); $('#countRol').html(cantidades[1]); $('#countPermisos').html(cantidades[2]); 
                        if(array[i].Rol!=elRol && array[i].Rol!=null){
                            listaCard.append
                            ('<div id="card_'+array[i].idRol+'" class="card mb-1 micard animate__animated animate__flipInX">'+
                                '<div class="card-content">'+
                                    '<div class="card-body p-0">'+
                                        '<div class="bd-example-row">'+
                                            '<div class="row m-0">'+
                                                '<div class="col-8 col-sm-10">'+
                                                    '<h6 class="mb-0">Denominación:</h6>'+
                                                    '<p id="Denominación_'+array[i].idRol+'" class="m-0">'+array[i].Rol+'</p>'+
                                                '</div>'+
                                                '<div class="col-4 col-sm-2 justify-content-between">'+
                                                    '<div class="d-flex justify-content-center">'+
                                                    '<button type="button" class="btnModificar btn btn-icon btn-flat-primary waves-effect waves-light" data-id="'+array[i].idRol+'"><i class="feather icon-edit"></i></button>'+
                                                    '<button type="button" class="btnEliminar btn btn-icon btn-flat-danger waves-effect waves-light" data-id="'+array[i].idRol+'"><i class="feather icon-trash-2"></i></button>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>');
                        }elRol=array[i].Rol;

                        var nuevoElemento = array[i].Permiso;
                        if ($("#ulPermisos").find("li:contains('" + nuevoElemento + "')").length === 0) {
                            ulPermisos.append
                            ('<li class="list-group-item" style="border-top: 0;"">'+
                                '<div class="d-flex justify-content-between">'+
                                    '<fieldset>'+
                                        '<div class="vs-checkbox-con vs-checkbox-primary">'+
                                            '<input id="checkbox_'+array[i].idPermiso+'" type="checkbox" value="false" class="listaCheckbox" data-id="'+array[i].idPermiso+'">'+
                                            '<span class="vs-checkbox">'+
                                                '<span class="vs-checkbox--check">'+
                                                    '<i class="vs-icon feather icon-check"></i>'+
                                                '</span>'+
                                            '</span>'+
                                            '<span class="">'+array[i].Permiso+'</span>'+
                                        '</div>'+
                                    '</fieldset>'+
                                    '<div class="product-result">'+
                                        '<i class="feather icon-info cursor-pointer"></i>'+
                                    '</div>'+
                                '</div>'+
                            '</li>');            
                        }
                    }
                }else if(array.length !=0 && array[0].tipo==3){
                    for (let i = 0; i < array.length; i++) {
                        $("#checkbox_"+array[i].idPermiso).prop("checked", true);
                    }
                }else if(array.length !=0 && array[0].tipo==4){
                    $('#txtRol').val(array[0].name);
                }else if(array.length !=0 && array[0].tipo==5){
                    if(array[0].coderror==0){
                        toastr.success(array[0].mensaje, 'En hora buena!');
                    }else{
                        toastr.error(array[0].mensaje, 'Error!');
                    }
                }else{ 
                    if(lista==0){
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

    function listaar(){
        lista='0'; 
        valores={_id:0, _name:'=>',_idPermiso:0, _accion:'lista_roles','_token':$('input[name="_token"]').val()};
        informacion();
    }listaar();

    var idrol=0;
    $('#listaCard').on('click', 'div.micard', function(){
        var card=$(this).attr('id').split('_');
        lista='1'; $(".listaCheckbox").prop("checked", false); idrol=card[1];
        $('.micard').removeClass('caardSelected'); $(this).addClass('caardSelected');
        valores={_id:card[1], _name:'==>', _idPermiso:0, _accion:'lista_roles_seleccionado','_token':$('input[name="_token"]').val()};
        informacion();
    });

    $('#accionRol').on('click', function(){
        lista='1'; 
        if(accion==0){
            valores={_id:0, _name:$('#txtRol').val(), _idPermiso:0, _accion:'insertar','_token':$('input[name="_token"]').val()};
            informacion();
        }else{
            valores={_id:idrol, _name:$('#txtRol').val(), _idPermiso:0, _accion:'modificar','_token':$('input[name="_token"]').val()};
            informacion();
        }
    });

    function addListaCard(array){
        if(accion==0){
            array.forEach(function(element) {
                $('#listaCard').prepend
                ('<div id="card_'+array[0].id+'" class="card mb-1 micard animate__animated animate__flipInX">'+
                    '<div class="card-content">'+
                        '<div class="card-body p-0">'+
                            '<div class="bd-example-row">'+
                                '<div class="row m-0">'+
                                    '<div class="col-8 col-sm-10">'+
                                        '<h6 class="mb-0">Denominación:</h6>'+
                                        '<p id="Denominación_'+array[0].id+'" class="m-0">'+array[0].name+'</p>'+
                                    '</div>'+
                                    '<div class="col-4 col-sm-2 justify-content-between">'+
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
        }else if(accion==1){
            $('#Denominación_'+array[0].id).html(array[0].name);
        }else{
            $('#card_'+array[0].id).addClass('animate__bounceOut');
            setTimeout(function() { $('#card_'+array[0].id).remove(); }, 1000);
        }
    }

    $('#listaCard').on('click', 'button.btnModificar', function(){
        accion=1; idrol=$(this).attr('data-id');
        valores={_id:$(this).attr('data-id'), _name:"===>", _idPermiso:0, _accion:'recupear','_token':$('input[name="_token"]').val()};
        informacion();
    });

    $('#listaCard').on('click', 'button.btnEliminar', function(){
        accion=2;
        valores={_id:$(this).attr('data-id'), _name:"====>", _idPermiso:0, _accion:'eliminar','_token':$('input[name="_token"]').val()};
        informacion();
    });

    $('#ulPermisos').on('click', 'input.listaCheckbox', function(){
        var activos = "";
        $('#ulPermisos input[type="checkbox"]').each(function() {
            if ($(this).prop('checked')) {
                activos += $(this).attr('data-id') + ",";
            }
        });
        activos = activos.replace(/,$/, "");
        valores={_id:idrol, _name:"====>", _idPermiso:$(this).attr('data-id'),_arrayPer:activos, _accion:'rol_permiso','_token':$('input[name="_token"]').val()};
        informacion();
    });
})

