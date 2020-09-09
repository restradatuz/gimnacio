<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use Carbon\Carbon;
use Jenssegers\Date\Date;


class Calendario extends Controller
{

    public $successStatus = 200;

    public function __construct()
    {
        $this->middleware('client.credentials')->only(['']);
    }


    

    public function obtenercalendario($id_sucursal, $id_usuario){
        Date::setLocale('es');
        $simsArreglo = array();
        $dia = DB::table('reglas_negocio')->where('id_sucursal', $id_sucursal)->first();

        $fechaactual = Carbon::now();
        $validaUser = User::where('id',$id_usuario)->first();

        if( $validaUser->fecha_mesualidad  <   $fechaactual->format('Y-m-d')){
            
            return response()->json(['errors'=> 1]);

        }else{
            for ($i=1; $i <= $dia->dias; $i++) {
            $date = Carbon::now();
            $date1 = $date->addDay($i);

            $date1->format('Y-m-d');
            $date_nuevo = new Date($date1);
            $dayOfTheWeek = $date1->dayOfWeek;

            if($idhorario = DB::table('dias_semana')->where('id_semanacarbon',$dayOfTheWeek)->where('estatus', 1)->where('id_sucursal',$id_sucursal)->first()){

                $simsArreglo[] = [
                    'fecha' => $date1->format('Y-m-d'),
                    'dias' => $dayOfTheWeek,
                    'nueva_fecha' => $date_nuevo->format('l j F Y'),
                    'id_horario' => $idhorario->id_horario,
                ];

            }

            }
            return response()->json($simsArreglo);
        }
    }


public function obtenerhorario($id_horario,$fecha,$id_cliente,$id_sucursal){
    Date::setLocale('es');
    $date_nuevo = new Date($fecha);
    $reglasnegocio = DB::table('reglas_negocio')->where('id_sucursal', $id_sucursal)->first();
    $horarios_obtenidos = DB::table('horario_detalle')->where('id_horario',$id_horario)->where('id_sucursal', $id_sucursal)->orderBy('id', 'asc')->get();


    $totalclientexdia = DB::table('reservaciones')
                ->where('fecha_citagym',$fecha)
                ->where('id_horario', $id_horario)
                ->where('id_cliente', $id_cliente)
                ->where('cancelado',0)
                ->where('id_sucursal',$id_sucursal) 
                ->count();

    $date = Carbon::now();

     $totalcliente = DB::table('reservaciones')
                ->where('fecha_citagym','>=', $date->format('Y-m-d'))
                ->where('id_cliente', $id_cliente)
                ->where('cancelado',0) 
                ->where('id_sucursal',$id_sucursal)
                ->count();         


     if ($totalclientexdia >= $reglasnegocio->cliente_reservacionxdia){

        return response()->json(['errors'=> 1]);
     }elseif( $totalcliente >= $reglasnegocio->resevaciones_permitidas){
        return response()->json(['errors'=> 2]);
     }      



    foreach ($horarios_obtenidos as $key ) {

    			$reservacionesxhorario = DB::table('reservaciones')
			    ->where('fecha_citagym',$fecha)
			    ->where('id_horario', $id_horario)
			    ->where('id_horario_detalle', $key->id)
                ->where('cancelado',0)
                ->where('id_sucursal',$id_sucursal) 
			    ->count();

			$horarios[] = [
            'id_horario_detalle' => $key->id,
            'id_horario' =>  $key->id_horario,
            'horario' => $key->horario,
            'fecha' => $fecha,
            'fecha_formato' => $date_nuevo->format('l j F Y'),
            'estatus_ioncard' => true,
            'total_reservaciones' => $reservacionesxhorario,
            'clientes_permitidos' => $reglasnegocio->cantidad_gym,
        ];
    }

    return response()->json($horarios);

}






public function insertar_reservacion(Request $request){

    $id_sucursal = $request->id_sucursal;
    $id_horario = $request->id_horario;
    $fecha = $request->fecha_citagym;
    $id_cliente = $request->id_cliente;
    $id_horario_detalle = $request->id_horario_detalle;


    $reglasnegocio = DB::table('reglas_negocio')->where('id_sucursal', $id_sucursal)->first();
    $horarios_obtenidos = DB::table('horario_detalle')->where('id_horario',$id_horario)->where('id_sucursal', $id_sucursal)->orderBy('id', 'asc')->get();


        $totalclientexdia = DB::table('reservaciones')
                    ->where('fecha_citagym',$fecha)
                    ->where('id_horario', $id_horario)
                    ->where('id_cliente', $id_cliente)
                    ->where('cancelado',0)
                    ->where('id_sucursal',$id_sucursal) 
                    ->count();

        $date = Carbon::now();

         $totalcliente = DB::table('reservaciones')
                    ->where('fecha_citagym','>=', $date->format('Y-m-d'))
                    ->where('id_cliente', $id_cliente)
                    ->where('cancelado',0) 
                    ->where('id_sucursal',$id_sucursal)
                    ->count(); 

        $reservacionesxhorario = DB::table('reservaciones')
                    ->where('fecha_citagym',$fecha)
                    ->where('id_horario', $id_horario)
                    ->where('id_horario_detalle', $id_horario_detalle)
                    ->where('cancelado',0)
                    ->where('id_sucursal',$id_sucursal) 
                    ->count();        


         if ($totalclientexdia >= $reglasnegocio->cliente_reservacionxdia){

            return response()->json(['errors'=> 1]);
         }elseif( $totalcliente >= $reglasnegocio->resevaciones_permitidas){
            return response()->json(['errors'=> 2]);
         }elseif ( $reservacionesxhorario >= $reglasnegocio->cantidad_gym ) {
            return response()->json(['errors'=> 3]);
         }else{

            $id = DB::table('reservaciones')->insertGetId($request->all());
            $viaje = DB::table('reservaciones')->where('id', $id)->first();
            $res = array(
                'exito'  =>  $viaje
            );
            return response()->json($res);
         }     


       

}
    
}
