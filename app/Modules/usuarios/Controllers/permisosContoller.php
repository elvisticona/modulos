<?php

namespace App\Modules\usuarios\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class permisosContoller extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    function index(Request $request) {
        return view('usuarios::permisos');
    }

    function admin(Request $request) {
        $id=addslashes($request->input('_id'));
        $nombre=addslashes($request->input('_nombre'));
        $descripcion=addslashes($request->input('_descripcion'));
        $guard_name=addslashes($request->input('_guard_name'));
        $created_at=Carbon::now()->format('Y-m-d H:i:s');
        $updated_at=Carbon::now()->format('Y-m-d H:i:s');
        $accion=addslashes($request->input('_accion'));
        
        $resultado = DB::select('call pt_permissions(?,?,?,?,?,?,?)',[$id,$nombre,$descripcion,$guard_name,$created_at,$updated_at,$accion]);
        return $resultado;
    }
}
