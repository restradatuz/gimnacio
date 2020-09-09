<?php

namespace App\Http\Controllers;

use App\Http\Requests\NuevoUsuario;
use App\Http\Requests\ActualizarUsuario;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Horario;

class Horarios extends Controller{

    public function index(){

        $horarios = Horario::where('id_sucursal', Auth::user()->id_sucursal)->get();

        $data = array(
            'page_content'  =>  'horarios/lista',
            'page_name'     =>  'Horarios',
            'ruta'          =>  'gym',
            'horarios'      =>  $horarios
        );

        return view('layout/_main')->with($data);
    }


    

    public function crear_horario(){


        $data = array(
            'page_content'  =>  'horarios/crear_horario',
            'page_name'     =>  'Crear Horarios',
            'ruta'          =>  'gym'
        );

        return view('layout/_main')->with($data);
    }



    public function actualizardias(Request $request){
        $data = array(
            "estatus"                => $request->value
        );
        $actualizarsemana = DB::table('dias_semana')->where('id', '=', $request->id);
        $actualizarsemana->update($data);
        return json_encode($actualizarsemana);
    }

    public function horario_guardar(Request $request){
            $nombrehorario = $request->nombre;
            $id_horario = DB::table('horarios')->insertGetId(['nombre_horario' =>  $nombrehorario, 'id_sucursal' => Auth::user()->id_sucursal]);


            for ($i=1; $i<= $request->cont; $i++) {

                $data = array(
                    'id_horario'    =>  $id_horario,
                    'horario'       =>  $request->input("hinicial".$i."")." - ".$request->input("hfinal".$i.""),
                    'consecutivo'   =>  $request->input("consecutivo".$i.""),
                    'id_sucursal'   =>  Auth::user()->id_sucursal
                );
                DB::table('horario_detalle')->insertGetId($data);

                
            }
            return redirect()->route('horarios');
    }

    

}
