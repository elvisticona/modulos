<?php

namespace App\Modules\usuarios\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Carbon\Carbon;

class rolesContoller extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    function index(Request $request) {
        return view('usuarios::roles');
    }

    function admin(Request $request) {
        $this->validate($request, [
            '_name' => 'required|max:255'
        ],[
            '_name.required' => '_name,Obligatorio'
        ]);

        $id=addslashes($request->input('_id'));
        $name=addslashes($request->input('_name'));
        $guard_name="web";
        $created_at=Carbon::now()->format('Y-m-d H:i:s');
        $updated_at=Carbon::now()->format('Y-m-d H:i:s');
        $idPermiso=addslashes($request->input('_idPermiso'));
        $arrayPermiso=addslashes($request->input('_arrayPer'));
        $accion=addslashes($request->input('_accion'));

        $resultado = DB::select('call pt_roles(?,?,?,?,?,?,?)',[$id,$name,$guard_name,$created_at,$updated_at,$idPermiso,$accion]);
        if($accion=="rol_permiso" && $id!=0){
            $role = Role::find($id);

            $permissions=explode(",",$arrayPermiso);

            $permissions = array_map(function ($item) {
                return (int)$item;
            }, $permissions);
                
            if (!empty($permissions)){
                $role->syncPermissions($permissions);
            }
        }
        return $resultado;
    }
}
