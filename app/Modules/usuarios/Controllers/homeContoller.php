<?php

namespace App\Modules\usuarios\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;
use Carbon\Carbon;

class homeContoller extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    function index(Request $request) {
        return view('usuarios::usuario');
    }

    function admin(Request $request) {
        $this->validate($request, [
            '_name' => 'required|max:255',
            '_apellidos' => 'required|max:255',
            '_dni' => 'required|max:15',
            '_email' => 'required|email',
            '_tipo' => 'required',
        ],[
            '_name.required' => '_name,Obligatorio',
            '_name.max' => '_name,Maximo 255 caracteres',
            '_apellidos.required' => '_apellidos,Obligatorio',
            '_apellidos.max' => '_apellidos,Maximo 255 caracteres',
            '_dni.required' => '_dni,Obligatorio',
            '_dni.max' => '_dni,Maximo 15 caracteres',
            '_email.required' => '_email,Obligatorio',
            '_email.email' => '_email,El correo ingresado no es valido',
            '_tipo.required' => '_tipo,Obligatorio',
        ]);

        $id=addslashes($request->input('_id'));
        $name=addslashes($request->input('_name'));
        $apellidos=addslashes($request->input('_apellidos'));
        $dni=addslashes($request->input('_dni'));
        $phone=addslashes($request->input('_phone'));
        $email=addslashes($request->input('_email'));
        $foto=addslashes($request->input('_foto'));
        $tipo=addslashes($request->input('_tipo'));
        $email_verified_at=Carbon::now()->format('Y-m-d H:i:s');
        $password=Hash::make($request->input('_dni'));
        $remember_token="";
        $created_at=Carbon::now()->format('Y-m-d H:i:s');
        $updated_at=Carbon::now()->format('Y-m-d H:i:s');
        $idRol=addslashes($request->input('_idRol'));
        $rows=addslashes($request->input('_rows'));
        $accion=addslashes($request->input('_accion'));

        $resultado = DB::select('call pt_users(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',[$id,$name,$apellidos,$dni,$phone,$email,$foto,$tipo,$email_verified_at,$password,$remember_token,$created_at,$updated_at,$idRol,$rows,$accion]);
        return $resultado;
    }
}
