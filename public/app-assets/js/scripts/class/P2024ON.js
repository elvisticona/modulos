$(document).ready(function() {
    
    valores='';
    function informacion(){
        $.ajax({
            url:'/usuarios/permisos/admin',
            method:"POST",
            data:valores,
            dataType:'JSON',
            success:function(array){
                if(array.length !=0 && array[0].tipo==2){
                    $('#listaCard').html('');
                    var listaCard=$('#listaCard').append('');
                    for (let i = 0; i < array.length; i++) {
                        var cantidades=array[i].cantidades.split(',')
                        $('#countUser').html(cantidades[0]); $('#countRol').html(cantidades[1]); $('#countPermisos').html(cantidades[2]); 
                        listaCard.append
                        ('<div class="card mb-1 animate__animated animate__flipInX">'+
                            '<div class="card-content">'+
                                '<div class="card-body p-0">'+
                                    '<div class="bd-example-row">'+
                                        '<div class="row m-0">'+
                                            '<div class="col-12 col-sm-4 col-md-3">'+
                                                '<h6 class="mb-0">Denominación:</h6>'+
                                                '<p class="m-0">'+array[i].name+'</p>'+
                                            '</div>'+
                                            '<div class="col-12 col-sm-8 col-md-9">'+
                                                '<h6 class="mb-0">Descripción:</h6>'+
                                                '<p class="m-0">'+array[i].descripcion+'</p>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>');
                    }
                }else{ 
                    $('#listaCard').html('<div class="card mb-1"><div class="card-content"><div class="card-body p-0"><div class="bd-example-row"><div class="row m-0">'+
                            '<div class="col-12 text-center">'+
                                '<h2 class="emoSinData animate__animated animate__heartBeat">&#128540;</h2>'+
                                '<p class="m-0">Lo lamento no existen permisos que mostrar </p>'+
                            '</div>'+
                        '</div></div></div></div></div>');
                }
            }

        })
    };

    function lista(){
        valores={_id:0, _accion:'Lista_permision','_token':$('input[name="_token"]').val()};
        informacion();
    }lista();



});