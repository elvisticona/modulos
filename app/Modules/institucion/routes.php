<?php

/**

 * Route for Home modules

 * Declare route normally like all other :D

 * For most case, your module name will be the parent path (Ex: /home/abc, /home/xxxx)

 */

 

$module_namespace = "App\Modules\institucion\Controllers"; 
 


Route::prefix('/institucion')->namespace($module_namespace)->group(function () {

    Route::group(['middleware' => ['web']], function () {

        Route::get('/', "institucionContoller@index");
        Route::post('/admin', "institucionContoller@admin");

        Route::get('/aula', "aulaContoller@index");
        Route::post('/aula', "aulaContoller@admin");

        Route::get('/curso', "cursoContoller@index");
        Route::post('/curso', "cursoContoller@admin");
 
    });
});
