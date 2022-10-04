<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;

class ServiciosController extends Controller
{
    public function index(){
        return Servicio::all();
    }

    public function guardar(Request $request){
        
        try {
            $request->validate([
                'nombre'=>'required',
                'precio'=> 'required',
             ]);
             return Servicio::create($request->all());
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function actualizar(Request $request, $id){
       
        try {
            $servicios = Servicio::find($id);
            $servicios -> update($request->all());
            return $servicios;
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function eliminar($id){
        
        try {
            return Servicio::destroy($id);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
