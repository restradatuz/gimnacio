<?php

namespace App\Http\Controllers\API;

use App\Events\NuevoViaje;
use App\Http\Controllers\Controller;
use App\Providers\EventServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Concerns\HasAttributes;
use App\User;
use GuzzleHttp\Client;

class ViajesController extends Controller
{
    // Función que recibe una nueva solicitud de viaje del usuario
    public function nuevoViaje(Request $request){

        $id = DB::table('viajes')->insertGetId($request->all());

        $viaje = DB::table('viajes')->where('id', $id)->first();

        $res = array(
            'error' =>  false,
            'data'  =>  $viaje
        );

        return response()->json($res);

    }

    public function usuarioCancelaViaje(Request $request){

        $update = array(
            'estatus'               =>  'C',
            'solicitud_cancelada'   =>  date('Y-m-d h:i:s'),
            'usuario_cancela'       =>  1
        );

        DB::table('viajes')->where('id', $request->input('id'))->update($update);

        $viaje = DB::table('viajes')->where('id', $request->input('id'))->first();


        $res = array(
            'error' =>  false,
            'data'  =>  $viaje
        );

        return response()->json($res);

    }

    public function esperarChofer(Request $request){

        $viaje = DB::table('viajes')
                ->join('users', 'viajes.id_conductor', '0', 'users.id')
                ->where('viajes.id', $request->input('id_viaje'))
                ->select('users.*')
                ->first();

        if($viaje->id == 'A'){

            $response = array(
                'aceptado'  =>  true,
                'chofer'    => $viaje
            );
        }

        return response()->json($response);

    }

    public function aceptarViaje(Request $request){

        $data = array(
            'id_viaje'              =>  $request->input('id_viaje'),
            'id_conductor'          =>  $request->input('usuario'),
            'solicitud_aceptada'    =>  date('Y-m-d h:i:s'),
            'estatus'               =>  'A'
        );

        DB::table('viajes')->where('id', $data['id_viaje'])->update($data);

    }

    public function cancelarViaje(Request $request){

        $data = array(
            'id_viaje'              =>  $request->input('id_viaje'),
            'id_conductor'          =>  $request->input('usuario'),
            'solicitud_aceptada'    =>  date('Y-m-d h:i:s'),
            'estatus'               =>  'P'
        );

        DB::table('viajes')->where('id', $data['id_viaje'])->update($data);

    }

    // Función en la que se verifica si hay viajes que un chofer pueda tomar dependiendo de la ubicación y el estatus
    public function buscarViaje(Request $request){

        $viajes_disponibles = DB::table('viajes')
                                    ->where('viajes.estatus', 'P')
                                    ->join('users', 'viajes.id_usuario', '=', 'users.id')
                                    // ->where('id_conductor', '!=', $request->input('usuario'))
                                    // ->select('viajes.*', 'users.*')
                                    ->get();

        foreach ($viajes_disponibles as $v) {
            $origen_usuario = explode(',', $v->origen);
            $origen_chofer = explode(',', $request->ubicacion);

            $distancia = $this->calc_distance($origen_usuario[0], $origen_usuario[1], $origen_chofer[0], $origen_chofer[1]);

            if($distancia <= 2.80){

                DB::table('viajes')->where('id', $v->id)->update(
                    ['estatus' => 'R']
                );

                return response()->json([
                    'enviar_chofer' =>  true,
                    'data_viaje'    =>  $v
                ]);
            }

        }

        return response()->json($viajes_disponibles);

        // return response()->json([
        //     'enviar_chofer'  =>  false,
        //     'data_viaje'    =>  null
        // ]);

    }

    public function reverseLocation(Request $request){
        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$request->input('location')."&key=AIzaSyCE2uhGihxJfeRKnFnip75o-lsv3FHwyYs";

        $client = new Client([
            'base_uri'  =>  $url,
            'timeout'   =>  3.0
        ]);

        $response = $client->request('post');

        $body = json_decode($response->getBody()->getContents(), true);

        $body = $body['results'][0];

        $response = array(
            'error'     =>  false,
            'lat_lng'   =>  $request->input('location'),
            'address'   =>  $body['formatted_address'],
            'place_id'  =>  $body['place_id']
        );

        return response()->json($response, 200);
    }

    // Funciones middleware con el servicio de google
    public function getAddress(Request $request){

        $url = "https://maps.googleapis.com/maps/api/place/autocomplete/json?input=".$request->input('address')."&strictbounds=
        &key=AIzaSyCE2uhGihxJfeRKnFnip75o-lsv3FHwyYs&location=".$request->input('origin')."&radius=50000";

        $client = new Client([
            'base_uri'  =>  $url,
            'timeout'   =>  3.0
        ]);

        $response = $client->request('post');

        $body = json_decode($response->getBody()->getContents(), true);

        $response = array(
            'error' => false,
            'data'  =>  array()
        );

        foreach ($body['predictions'] as $b) {
            $response['data'][] = array(
                'address'   =>  $b['description'],
                'place_id'  =>  $b['place_id']
            );
        }

        return response()->json($response, 200);

    }

    public function getPlaceLocation(Request $request){

        $url = "https://maps.googleapis.com/maps/api/geocode/json?place_id=".$request->input('place_id')."&key=AIzaSyCE2uhGihxJfeRKnFnip75o-lsv3FHwyYs";

        $client = new Client([
            'base_uri'  =>  $url,
            'timeout'   =>  3.0
        ]);

        $response = $client->request('get');

        $body = json_decode($response->getBody()->getContents(), true);

        $response = array(
            'error' =>  false,
            'data'  =>  $body['results'][0]['geometry']['location']
        );

        return response()->json($response, 200);

    }

    public function getRoute(Request $request){

        $url = "https://maps.googleapis.com/maps/api/directions/json?origin=place_id:".$request->input('origin')."&destination=place_id:".$request->input('destination')."&laguage=es-419&key=AIzaSyCE2uhGihxJfeRKnFnip75o-lsv3FHwyYs";

        $client = new Client([
            'base_uri'  =>  $url,
            'timeout'   =>  3.0
        ]);

        $response = $client->request('get');

        $google_res = $response->getBody()->getContents();

        $body = json_decode($google_res, true);

        $body = $body['routes'][0]['legs'][0];

        $costo = $this->costoViaje($body['distance']['value']);

        $response = array(
            'place_origin'          =>  $request->input('origin'),
            'place_destination'     =>  $request->input('destination'),
            'distancia'             =>  $body['distance']['text'],
            'distancia_m'           =>  $body['distance']['value'],
            'duracion'              =>  $body['duration']['text'],
            'direccion_origen'      =>  $body['start_address'],
            'start_location_lat'    =>  $body['start_location']['lat'],
            'start_location_lng'    =>  $body['start_location']['lng'],
            'direccion_final'       =>  $body['end_address'],
            'end_location_lat'      =>  $body['end_location']['lat'],
            'end_location_lng'      =>  $body['end_location']['lng'],
            'costo'                 =>  $costo,
            'google_response'       =>  json_decode($google_res, true)
        );

        return response()->json($response);

    }

    public function costoViaje($trayecto){

        $rules = DB::table('reglas_negocio')->first();

        if( date('h:i:s') > $rules->tarifa_dia_inicio && date('h:i:s') < $rules->tarifa_dia_fin ){
            if($trayecto / 1000 <= 8){

                $costo = array(
                    'costo'         =>  floatval($rules->tarifa_dia),
                    'tarifa_base'   =>  floatval($rules->tarifa_dia),
                    'km_recorrido'  =>  floatval($rules->km),
                    'max_espera'    =>  $rules->espera
                );

            }else{

                $costo = array(
                    'costo'         =>  floatval(($trayecto / 1000 )* $rules->km),
                    'tarifa_base'   =>  floatval($rules->tarifa_dia),
                    'km_recorrido'  =>  floatval($rules->km),
                    'max_espera'    =>  $rules->espera
                );

            }
        }else{

            if($trayecto / 1000 <= 8){
                $costo = array(
                    'costo'         =>  floatval($rules->tarifa_noche),
                    'tarifa_base'   =>  floatval($rules->tarifa_noche),
                    'km_recorrido'  =>  floatval($rules->km_noche),
                    'max_espera'    =>  $rules->espera_noche
                );
            }else{
                $costo = array(
                    'costo'         =>  floatval(($trayecto / 1000) * $rules->km_noche),
                    'tarifa_base'   =>  floatval($rules->tarifa_dia),
                    'km_recorrido'  =>  floatval($rules->km),
                    'max_espera'    =>  $rules->espera
                );
            }
        }

        return $costo;

    }

}
