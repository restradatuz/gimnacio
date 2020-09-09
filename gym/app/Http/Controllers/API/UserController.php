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
use App\Imagenes;


class UserController extends Controller
{

    public $successStatus = 200;

    public function __construct()
    {
        $this->middleware('client.credentials')->only(['']);
    }

    public function login(Request $request){
        $request->validate([
            'email'     =>  'required|string',
            'password'  =>  'required|string'
        ]);

        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials)){

            $res = array(
                "error"     =>  true,
                "message"   =>  "Usuario o Contraseña incorrectosss"
            );

            return response()->json($res);
        }

        $user = $request->user();

        if($user->user_type != 2){
            $res = array(
                "error"     =>  true,
                "message"   =>  "No te has dado de alta como cliente"
            );
            return response()->json($res);
        }

        if($user->is_active != 1){
            $res = array(
                "error"     =>  true,
                "message"   =>  "Tu cuenta ha sido bloqueada"
            );
            return response()->json($res);
        }

        //$this->removeOldTokens($user->id);

        //$tokenResult = $user->createToken('Personal Access Token');

        //$token = $tokenResult->token;

        //$token->save();

        $res = array(
            "error"         =>  false,
            'token_type'    =>  'Bearer',
            'user_data'     =>  $user
        );

        return response()->json($res);
    }

    public function newUser(Request $request){

        $data = array(
            'nombre'        =>  strtoupper($request->nombre),
            'apellido'      =>  strtoupper($request->apellido),
            'tel'           =>  $request->celular,
            'email'         =>  $request->email,
            'password'      =>  bcrypt($request->password),              
            'user_type'     =>  $request->user_type,
            'is_active'     =>  1
        );

        try{

        	$validarcorreo = DB::table('users')->where('email', $request->email)->first();
        	if ($validarcorreo){
        		$res = array(
	                "error"         =>  true,
	                'msg'     		=>  'El email se encuentra en uso para otra cuenta'
	            );

        	}else{
        		$id_user = DB::table('users')->insertGetId($data);
	            $user = DB::table('users')->where('id', $id_user)->first();

	            $res = array(
	                "error"         =>  false,
	                'user_data'     =>  $user
	            );

        	}

            return response()->json($res);

        }catch(\Illuminate\Database\QueryException $e){

            $res = array(
                "error"         =>  true,
                'msg'           =>  $e->getMessage()
            );

            return response()->json($res);

        }
    }

    public function getUser(AuthenticationException $exception)
    {
        $user = DB::table('users')
            ->join('oauth_access_tokens', 'users.id', '=', 'oauth_access_tokens.user_id')
            ->select('users.*', 'oauth_access_tokens.id')
            ->get();

        return response()->json($user);
    }

    public function setUserOnline(Request $request){

        // $user = DB::table('users')->where('id', $request->input('id'))->first();

        // if($user->online == 0){
        //     DB::table('users')->where('id', $request->input('id'))->update(['online' => 1]);
        // }

        // if($user->online == 1){
        //     DB::table('users')->where('id', $request->input('id'))->update(['online' => 0]);
        // }

        // $user = DB::table('users')->where('id', $request->input('id'))->first();

        return response()->json($request->all());

    }

    function isApprovedUser(Request $request){

        $user = DB::table('users')
        ->where('users.firebase_uid', $request->input('firebase_uid'))
        ->leftjoin('documents', 'documents.id_usuario', '=', 'users.id')
        ->select('documents.INE_frente', 'documents.INE_reverso', 'documents.selfie')
        ->first();

        return response()->json($user);

    }

    function removeOldTokens($user_id){
        DB::table('oauth_access_tokens')->where('user_id', $user_id)->delete();
    }


    function obtener_reservaciones_cliente(Request $request){
        Date::setLocale('es');
        $id_cliente = $request->idcliente;
        $date = Carbon::now();

         $reservaciones = DB::table('reservaciones')
                ->where('fecha_citagym','>=', $date->format('Y-m-d'))
                ->where('id_cliente', $id_cliente)
                ->where('cancelado',0)
                ->orderBy('fecha_citagym','ASC')
                ->get(); 

         foreach ($reservaciones as $key ) {


            $fecha = new Date($key->fecha_citagym);

            $reservacio[] = [
            'fecha_citagym' => $fecha->format('l j F Y'),
            'fecha_normal' => $key->fecha_citagym,
            'fecha_registro' =>  $key->fecha_registro,
            'horario' => $key->horario,
            'id' => $key->id,
            'id_cliente' => $key->id_cliente,
            'id_horario' => $key->id_horario,
            'id_horario_detalle' => $key->id_horario_detalle,
            ];

         }             


        return response()->json($reservacio);
    }


    function obtener_ubicacion(){


         $ubicacion = DB::table('ubicaciones')->get();       


        return response()->json($ubicacion);
    }


    function obtener_imagesapp($id_sucursal){


        $imagen = Imagenes::where('estatus',1)->where('id_sucursal',$id_sucursal)->get();
         foreach ($imagen as $key ) {
            $imagenes[] = [
            'nombre' => '/imgapp2/'.$key->nombre
            ];
         }


        return response()->json($imagenes);
    }

   public function cancelarreservaciones(Request $request){

        DB::table('reservaciones')->where('id',$request->id)->update(['cancelado' => 1]);
        return response()->json(['exito'=> true]); 
   } 



}
