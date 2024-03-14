<?php

/**

 * Route for Home modules

 * Declare route normally like all other :D

 * For most case, your module name will be the parent path (Ex: /home/abc, /home/xxxx)

 */



$module_namespace = "App\Modules\usuarios\Controllers";



Route::prefix('/usuarios')->namespace($module_namespace)->group(function () {

    Route::group(['middleware' => ['web']], function () {

        Route::get('/', "homeContoller@index");
        Route::post('/admin', "homeContoller@admin");
        Route::get('/roles', "rolesContoller@index");
        Route::post('/roles/admin', "rolesContoller@admin");
        Route::get('/permisos', "permisosContoller@index");
        Route::post('/permisos/admin', "permisosContoller@admin");

    });
});
