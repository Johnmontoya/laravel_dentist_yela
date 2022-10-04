<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CitaServicio;
use App\Models\Servicio;
use App\Models\Cita;

class CitaServicioController extends Controller
{
    public function guardar(Request $request){

        $servicio = $request->id_servicio;       
        
        try {
           $request->validate([
               'fecha'=>'required',
               'hora'=> 'required',
               'user_id'=>'required',
               'tiempo_id' => 'required'
            ]);

            //$cita = Cita::create($request->all());

            $cita = new Cita();
            $cita->fecha = $request->fecha;
            $cita->hora = $request->hora;
            $cita->user_id = $request->user_id;
            $cita->tiempo_id = $request->tiempo_id;
            $cita->save();

            foreach ($servicio as $key => $items) {
                $newCita = CitaServicio::create([
                    'citaId' => $cita -> id,
                    'servicioId' => $items
                ]);
            }      
    
            return $newCita;
       } catch (\Throwable $th) {
           return response()->json([
               'status' => false,
               'message' => $th->getMessage()
           ], 500);
       }
   }
}


/*
$fecha_hora = Cita::all();
        $fecha="16-10-2022";
        $hora="5:10:20";

        
        
        $citas = Cita::where('fecha','=','12-10-2022')
        ->select('fecha','hora')
        ->orderBy('hora','asc')->get();
        
        $versiones = array(
            "citas" => array(
                array(
                    "fecha" => $fecha,
                    "hora" => "$hora"
                )
            )
        );
        $my = json_encode($versiones);

        //$compare = array_diff($citas, $new);
        //echo ($compare);
        
        //return ['citas' => $citas];
        
         */