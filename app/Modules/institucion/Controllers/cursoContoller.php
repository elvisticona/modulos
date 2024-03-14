<?php

namespace App\Modules\institucion\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;

class cursoContoller extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    } 

    function index(Request $request) {
        return view('institucion::curso');
    } 

    function admin(Request $request) {

        $idCurso=addslashes($request->input('_idCurso'));// int,
        $denominacion=addslashes($request->input('_denominacion'));//	varchar(255),
        $descripcion=addslashes($request->input('_descripcion'));//	text,
        $anioAcademico=Carbon::now()->format('Y-m-d H:i:s');//	datetime,
        $estado=addslashes($request->input('_estado'));//	int, -- 0 inactivo, 1 activo
        $miTokenCurso=addslashes($request->input('_miTokenCurso'));// varchar(255),
        $miTokenAula=addslashes($request->input('_miTokenAula'));//	varchar(255),
        $idDocente=addslashes($request->input('_idDocente'));// int,
        $comodinInt=addslashes($request->input('_comodinInt'));//	int,
        $comodinVarchar=addslashes($request->input('_comodinVarchar'));// varchar(255),
        $rows=addslashes($request->input('_rows'));// int,
        $accion=addslashes($request->input('_accion'));// varchar(255)

        if($accion=="insertar"){
            $miTokenCurso=$this->generarCadenaAleatoria();
        }

        $resultado = DB::select('call pt_curso(?,?,?,?,?,?,?,?,?,?,?,?)',[$idCurso,$denominacion,$descripcion,$anioAcademico,$estado,$miTokenCurso,$miTokenAula,$idDocente,$comodinInt,$comodinVarchar,$rows,$accion]);
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
