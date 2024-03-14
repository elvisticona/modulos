<?php

namespace App\Modules\institucion\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class aulaContoller extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    function index(Request $request) {
        return view('institucion::aula');
    } 

    function admin(Request $request) {
        $this->validate($request, [
            '_denominacion' => 'required',
            '_seccion' => 'required|max:2',
            '_capacidad' => 'required|numeric',
        ],[
            '_denominacion.required' => '_denominacion,Obligatorio',
            '_seccion.required' => '_seccion,Obligatorio',
            '_seccion.max' => '_seccion,Maximo 2 caracteres',
            '_capacidad.required' => '_capacidad,Obligatorio',
            '_capacidad.numeric' => '_capacidad,Número no válido',
        ]);

        $idAula=addslashes($request->input('_idAula'));
        $denominacion=addslashes($request->input('_denominacion'));
        $seccion=addslashes($request->input('_seccion'));
        $capacidad=addslashes($request->input('_capacidad'));
        $estado=addslashes($request->input('_estado'));
        $token=addslashes($request->input('_mtoken'));
        $dataInsert=Carbon::now()->format('Y-m-d H:i:s');

        $idAllumno=addslashes($request->input('_idAllumno'));
        $rows=addslashes($request->input('_rows'));
        $accion=addslashes($request->input('_accion'));

        if($accion=="insertar"){
            $token=$this->generarCadenaAleatoria();
        }

        $resultado = DB::select('call pt_aulas(?,?,?,?,?,?,?,?,?,?)',[$idAula,$denominacion,$seccion,$capacidad,$estado,$token,$dataInsert,$idAllumno,$rows,$accion]);
        return $resultado;

    }
    
    public function generarCadenaAleatoria() {
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $longitud = 20;
        $cadena = '';
        $numCaracteres = strlen($caracteres);
        for ($i = 0; $i < $longitud; $i++) {
            $cadena .= $caracteres[rand(0, $numCaracteres - 1)];
        }

        return $cadena;
    }
}
