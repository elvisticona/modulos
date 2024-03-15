<?php

namespace App\Modules\institucion\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;
use Carbon\Carbon;

class institucionContoller extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    } 
 
    function index(Request $request) {
        return view('institucion::institucion');
    }
    
    function admin(Request $request) {
        $this->validate($request, [
            '_turno' => 'required',
            '_horaInicio' => 'required',
            '_horaFinal' => 'required',
        ],[
            '_turno.required' => '_turno,Obligatorio',
            '_horaInicio.required' => '_horaInicio,Obligatorio',
            '_horaFinal.required' => '_horaFinal,Obligatorio',
        ]);

        $id=addslashes($request->input('_id'));//	int,
        $turno=addslashes($request->input('_turno'));//	varchar(100),
        $horaInicio=addslashes($request->input('_horaInicio'));// varchar(10),
        $horaFinal=addslashes($request->input('_horaFinal'));// varchar(10),
        $accion=addslashes($request->input('_accion'));// varchar(255)

        $resultado = DB::select('call pt_turnos(?,?,?,?,?)',[$id,$turno,$horaInicio,$horaFinal,$accion]);
        return $resultado;
    }

}
