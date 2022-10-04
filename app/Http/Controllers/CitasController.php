<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;

class CitasController extends Controller
{
    public function index(){
        return Cita::all();
    }

    public function guardar(Request $request){
        
         try {
            $request->validate([
                'fecha'=>'required',
                'hora'=> 'required',
                'user_id'=>'required'
             ]);
             return Cita::create($request->all());
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function actualizar(Request $request, $id){
       
        try {
            $citas = Cita::find($id);
            $citas -> update($request->all());
            return $citas;
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function eliminar($id){
        
        try {
            return Cita::destroy($id);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function buscar(Request $request){
       
        try {
            $cita = $request->fecha;
            return Cita::where('fecha','like','%'.$cita.'%')->get();
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
