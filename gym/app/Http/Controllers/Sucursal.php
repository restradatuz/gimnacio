<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Sucursales;
use App\ReglasNegocio;
use App\Ubicacion;
use App\Dias_semana;
use Illuminate\Support\Facades\Auth;

class Sucursal extends Controller{

    public function index(){

        $sucursales = Sucursales::get();

        $data = array(
            'page_content'  =>  'sucursales/lista',
            'page_name'     =>  'Sucursales',
            'ruta'          =>  'gym',
            'sucursales'	=>	$sucursales
        );

        return view('layout/_main')->with($data);
    }

    public function crear_sucursal(){

    	$data = array(
            'page_content'  =>  'sucursales/crear_sucursal',
            'page_name'     =>  'Crear Sucursal',
            'ruta'          =>  'gym'
        );

        return view('layout/_main')->with($data);

    }



    public function nueva(Request $request){

    	$data = array(
            'nombre'        =>  strtoupper($request->nombre),
            'estatus'		=> 0
        );

        $id = DB::table('sucursales')->insertGetId($data);

        
        $reglas = new ReglasNegocio;
        $reglas->dias = 1;
        $reglas->cantidad_gym = 40;
        $reglas->cliente_reservacionxdia = 1;
        $reglas->resevaciones_permitidas = 1;
        $reglas->usuario = Auth::user()->id;
        $reglas->id_sucursal = $id;
        $reglas->save();

        $ubicacion = new Ubicacion;
        $ubicacion->nombre = 'GYM';
        $ubicacion->cordenadas1 = '20.96705005';
        $ubicacion->cordenadas2 = '-89.62377459';
        $ubicacion->id_sucursal = $id;
        $ubicacion->save();
        
        $diassemana = "DOMINGO,LUNES,MARTES,MIERCOLES,JUEVES,VIERNES,SABADO";
        $idcarbon = 0;
        
        for ($i=0; $i <= 6; $i++) { 

            $dia = explode(",",$diassemana);
            $diass = new Dias_semana;
            $diass->dia_semana  =  $dia[$i];
            $diass->id_horario = 0;
            $diass->id_semanacarbon = $idcarbon;
            $diass->estatus = 1;
            $diass->id_sucursal = $id;
            $diass->save();
            $idcarbon++;
            
        }
            
        return redirect()->route('sucursales');

    }


    

   

    

}
