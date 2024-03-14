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

}
