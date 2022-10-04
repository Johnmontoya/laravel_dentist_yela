<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tiempo;

class TiempoController extends Controller
{
    public function index(Request $request){
        //SELECT tiempos.horas FROM tiempos WHERE tiempos.id NOT IN (SELECT citas.tiempo_id FROM citas WHERE citas.fecha LIKE '03-10-2022')
        
        $db = DB::table('tiempos')->select('id','horas')
        ->whereNotIn('tiempos.id', DB::table('citas')->select('citas.tiempo_id')->where('citas.fecha','=', $request->fecha))
        ->get();

        return $db;

    }
}
