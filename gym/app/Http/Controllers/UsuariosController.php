<?php

namespace App\Http\Controllers;

use App\Http\Requests\NuevoUsuario;
use App\Http\Requests\ActualizarUsuario;
use App\Http\Requests\ActualizarUsuario2;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Imagenes;
use App\Reservaciones;
use Carbon\Carbon;
use App\User;
use Jenssegers\Date\Date;
use App\Sucursales;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller{

    public function index(){

        $users = User::whereIn('user_type', ['1', '3','4'])->orderBy('user_type')->get();

        $data = array(
            'page_content'  =>  'usuarios/lista',
            'page_name'     =>  'Lista de Usuarios',
            'js_page'       =>  'usuarios_lista.js',
            'ruta'          =>  'gym',
            'usuarios'      =>  $users
        );

        return view('layout/_main')->with($data);
    }


    public function usuariosgerente(){

        $id_sucursal = Auth::user()->id_sucursal;

        $users = User::whereIn('user_type', ['1', '3','4'])->where('id_sucursal',$id_sucursal)->orderBy('user_type')->get();

        $data = array(
            'page_content'  =>  'usuarios/lista',
            'page_name'     =>  'Lista de Usuarios',
            'js_page'       =>  'usuarios_lista.js',
            'ruta'          =>  'gym',
            'usuarios'      =>  $users
        );

        return view('layout/_main')->with($data);
    }


    public function clientes(){

        if (Auth::user()->user_type == 1){
            $users = User::where('user_type', '2')->get();
        }else{
            $id_sucursal = Auth::user()->id_sucursal;
            $users = User::where('user_type', '2')->where('id_sucursal',$id_sucursal)->get();
        }

        
        $data = array(
            'page_content'  =>  'clientes/lista',
            'page_name'     =>  'Lista de Clientes',
            'js_page'       =>  'usuarios_lista.js',
            'ruta'          =>  'gym',
            'usuarios'      =>  $users
        );

        return view('layout/_main')->with($data);
    }

    public function clientesgerente(){

        $id_sucursal = Auth::user()->id_sucursal;
        $users = User::where('user_type', '2')->where('id_sucursal',$id_sucursal)->get();
        $data = array(
            'page_content'  =>  'clientes/lista',
            'page_name'     =>  'Lista de Clientes',
            'js_page'       =>  'usuarios_lista.js',
            'ruta'          =>  'gym',
            'usuarios'      =>  $users
        );

        return view('layout/_main')->with($data);
    }

    public function ver_usuario($id){

        // $contents = Storage::get('/public/1/ine_frente/09bLmmZI0oQOc4sxsb15RcmYGrmVKnPCHecTIRqe.png');

        $user = DB::table('users')
                    ->join('user_types', 'users.user_type', '=', 'user_types.id')
                    ->select('users.*', 'user_types.nombre as tipo_usuario')
                    ->where('users.id', '=', $id)
                    ->first();

        $user_types = DB::table('user_types')->get();

        $data = array(
            'page_content'  =>  'usuarios/user',
            'page_name'     =>  'Usuario: '.ucfirst(strtolower($user->nombre))." ".ucfirst(strtolower($user->apellido)),
            'js_page'       =>  'usuarios_lista.js',
            'ruta'          =>  'gym',
            'user'          =>  $user,
            'user_types'    =>  $user_types,
            // 'contents'      =>  $contents
        );

        return view('layout/_main')->with($data);
    }


    public function ver_cliente($id){

        // $contents = Storage::get('/public/1/ine_frente/09bLmmZI0oQOc4sxsb15RcmYGrmVKnPCHecTIRqe.png');

        $user = DB::table('users')
                    ->join('user_types', 'users.user_type', '=', 'user_types.id')
                    ->select('users.*', 'user_types.nombre as tipo_usuario')
                    ->where('users.id', '=', $id)
                    ->first();

        $user_types = DB::table('user_types')->get();

        $data = array(
            'page_content'  =>  'usuarios/user',
            'page_name'     =>  'Usuario: '.ucfirst(strtolower($user->nombre))." ".ucfirst(strtolower($user->apellido)),
            'js_page'       =>  'usuarios_lista.js',
            'ruta'          =>  'gym',
            'user'          =>  $user,
            'user_types'    =>  $user_types,
            // 'contents'      =>  $contents
        );

        return view('layout/_main')
                ->with($data);
    }

    public function nuevo_usuario(){

        $user_types = DB::table('user_types')->get();

        $data = array(
            'page_content'  =>  'usuarios/nuevo_usuario',
            'page_name'     =>  'Agregar Usuarios',
            'ruta'          =>  'gym',
            // 'js_page'       =>  'agregar_usuarios.js'
            'user_types'    =>  $user_types
        );

        return view('layout/_main')->with($data);
    }

    public function agregar_usuario(NuevoUsuario $request){

        $validated = $request->validated();

        $id = DB::table('users')->insertGetId($request->except("confirmar_password"));

        return redirect()->route('usuario/'.$id);

    }

    public function actualizar_usuario(ActualizarUsuario $request){


        $validated = $request->validated();

        $data = array(
            "nombre"                => $request->input('nombre'),
            "apellido"              => $request->input('apellido'),
            "email"                 => $request->input('email'),
            "tel"                   => $request->input('tel'),
            "user_type"             => $request->input('user_type')
        );

        $query = DB::table('users')->where('id', '=', $request->input('id'));

        if($request->input('password') != ''){
            $data['password'] = bcrypt($request->input('password'));
        }

        $query->update($data);
        return back();
    }

    public function subir_archivos(Request $request, $id){

        if(!empty($request->ine_frente)){
            $request->ine_frente->storeAs('public/'.$id, 'ine_frente.'.$request->ine_frente->extension());
        }

        if(!empty($request->ine_reverso)){
            $request->ine_reverso->storeAs('public/'.$id, 'ine_reverso.'.$request->ine_reverso->extension());
        }

        if(!empty($request->licencia)){
            $request->licencia->storeAs('public/'.$id, 'licencia.'.$request->licencia->extension());
        }

        if(!empty($request->carta_antecedentes)){
            $request->carta_antecedentes->storeAs('public/'.$id, 'carta_antecedentes.'.$request->carta_antecedentes->extension());
        }

        if(!empty($request->poliza)){
            $request->poliza->storeAs('public/'.$id, 'poliza.'.$request->poliza->extension());
        }

        if(!empty($request->comprobante_domicilio)){
            $request->comprobante_domicilio->storeAs('public/'.$id, 'comprobante_domicilio.'.$request->comprobante_domicilio->extension());
        }

        return back();

    }

    public function uploadimagesapp(){
       $id_sucursal = Auth::user()->id_sucursal;
       $imagenes = Imagenes::where('id_sucursal',$id_sucursal)->get();



        $data = array(
            'page_content'  =>  'imagenes/imagenesapp',
            'page_name'     =>  'Imagenes Aplicación',
            'ruta'          =>  'gym',
            'imagen'        =>  $imagenes
        );

        return view('layout/_main')->with($data);
    }

    public function subir_archivosapp(Request $request){
        $id_sucursal = Auth::user()->id_sucursal;

        if(!empty($request->imagen1)){
            $existeimagen = Imagenes::where('id_sucursal', $id_sucursal)->where('num_imagen',1)->first();

                if($existeimagen){

                    $file = $request->file('imagen1');
                    Imagenes::where('id', $existeimagen->id)->update(['nombre' => 'imagen1.'.$request->imagen1->extension(),'estatus' => 1]);
                    $file->move('imgapp2', 'imagen1.'.$request->imagen1->extension());
            

                }else{ 

                    $imagenes = new Imagenes;
                    $imagenes->nombre = 'imagen1.'.$request->imagen1->extension();
                    $imagenes->estatus = 1;
                    $imagenes->num_imagen = 1;
                    $imagenes->id_sucursal = $id_sucursal;
                    $imagenes->save();

                    $file = $request->file('imagen1');
                    $file->move('imgapp2', 'imagen1.'.$request->imagen1->extension());



                }

                

        }

        if(!empty($request->imagen2)){
            $existeimagen2 = Imagenes::where('id_sucursal', $id_sucursal)->where('num_imagen',2)->first();

                if($existeimagen2){
                    $file = $request->file('imagen2');
                    Imagenes::where('id', $existeimagen2->id)->update(['nombre' => 'imagen2.'.$request->imagen2->extension(),'estatus' => 1]);
                    $file->move('imgapp2', 'imagen2.'.$request->imagen2->extension());
            

                }else{ 

                    $imagenes = new Imagenes;
                    $imagenes->nombre = 'imagen2.'.$request->imagen2->extension();
                    $imagenes->estatus = 1;
                    $imagenes->num_imagen = 2;
                    $imagenes->id_sucursal = $id_sucursal;
                    $imagenes->save();

                    $file = $request->file('imagen2');
                    $file->move('imgapp2', 'imagen2.'.$request->imagen2->extension());

                }
            

        }

        if(!empty($request->imagen3)){

             $existeimagen3 = Imagenes::where('id_sucursal', $id_sucursal)->where('num_imagen',3)->first();

                if($existeimagen3){
                    $file = $request->file('imagen3');
                    Imagenes::where('id', $existeimagen3->id)->update(['nombre' => 'imagen3.'.$request->imagen3->extension(),'estatus' => 1]);
                    $file->move('imgapp2', 'imagen3.'.$request->imagen3->extension());
            

                }else{ 

                    $imagenes = new Imagenes;
                    $imagenes->nombre = 'imagen3.'.$request->imagen3->extension();
                    $imagenes->estatus = 1;
                    $imagenes->num_imagen = 3;
                    $imagenes->id_sucursal = $id_sucursal;
                    $imagenes->save();

                    $file = $request->file('imagen3');
                    $file->move('imgapp2', 'imagen3.'.$request->imagen3->extension());



                }
            
        }

        return back();
    }

     public function cambiarestatus_imagen($id){

            Imagenes::where('id', $id)->update(['estatus' => 0]);

        return back();
    }

    public function eliminarUsuario($id){

             $query = DB::table('users')->where('id', '=', $id);
             $query->delete();

        return redirect()->route('usuarios');
    }

    public function eliminarcliente($id){

             $query = DB::table('users')->where('id', '=', $id);
             $query->delete();

        return redirect()->route('clientes');
    }



    public function reservaciones(){
        $id_sucursal = Auth::user()->id_sucursal;
        $date = Carbon::now();
        $dayOfTheWeek = $date->dayOfWeek;
        $diasemana = DB::table('dias_semana')->where('id_semanacarbon', $dayOfTheWeek)->where('id_sucursal', $id_sucursal)->orderBy('id', 'asc')->first();
        $horarios = DB::table('horario_detalle')->where('id_horario',$diasemana->id_horario)->orderBy('id', 'asc')->get();

        

        $data = array(
            'page_content'  =>  'reservaciones/lista',
            'page_name'     =>  'Reservaciones',
            'js_page'       =>  'usuarios_lista.js',
            'ruta'          =>  'gym',
            'horario'       => $horarios,
            'reservaciones' =>  false
        );

        return view('layout/_main')->with($data);
    }


    public function buscarreservaciones(Request $request){
        $id_sucursal = Auth::user()->id_sucursal;
        $date = Carbon::now();
        $dayOfTheWeek = $date->dayOfWeek;

        $dateformat = $date->format('Y-m-d');
        $diasemana = DB::table('dias_semana')->where('id_semanacarbon', $dayOfTheWeek)->where('id_sucursal', $id_sucursal)->orderBy('id', 'asc')->first();
        $horarios = DB::table('horario_detalle')->where('id_horario',$diasemana->id_horario)->orderBy('id', 'asc')->get();

        $reservaciones = Reservaciones::where('id_horario_detalle',$request->reservacion)->where('fecha_citagym',$dateformat)->where('cancelado',0)->where('id_sucursal',$id_sucursal)->orderBy('id', 'asc')->get();

        

        $data = array(
            'page_content'  =>  'reservaciones/lista',
            'page_name'     =>  'Reservaciones',
            'js_page'       =>  'usuarios_lista.js',
            'ruta'          =>  'gym',
            'horario'       =>  $horarios,
            'reservaciones' =>  $reservaciones,
            'idselect'      =>  $request->reservacion
        );

        return view('layout/_main')->with($data);
    }


    public function nuevo_usuarioadm(){

        $user_types = DB::table('user_types')->get();
        $sucursales =Sucursales::get();

        $data = array(
            'page_content'  =>  'sucursales/nuevo_usuarioadm',
            'page_name'     =>  'Agregar Usuarios',
            'ruta'          =>  'gym',
            // 'js_page'       =>  'agregar_usuarios.js'
            'user_types'    =>  $user_types,
            'sucursales'    =>  $sucursales
        );

        return view('layout/_main')->with($data);
    }

    public function agregarusuarioadm(NuevoUsuario $request){
            $date = Carbon::now();

        if ($request->user_type == 2){
            $mensauliadad = $request->mensualidad;
            
            $endDate = $date->addMonth($request->mensualidad);
            $sucursal = $request->sucursal;

        }else if ($request->user_type == 1){
            $mensauliadad = 0;
            $endDate = $date;
            $sucursal = 0;

        }else{
            $mensauliadad = 0;
            $endDate = $date;
            $sucursal = $request->sucursal;
        }
        

        $validated = $request->validated();

        $data = array(
            'nombre'        =>  $request->nombre,
            'apellido'      =>  $request->apellido,
            'tel'           =>  $request->tel,
            'email'         =>  $request->email,
            'password'      =>  bcrypt($request->password),              
            'user_type'     =>  $request->user_type,
            'is_active'     =>  1,
            'mensualidad'   =>  $mensauliadad,
            'fecha_mesualidad'  => $endDate,
            'id_sucursal'   =>  $sucursal
        );

        $id = DB::table('users')->insertGetId($data);
        //return redirect()->route('cliente/'.$id);
        
        if(Auth::user()->user_type == 1){
             if($request->user_type == 2){
                     return redirect()->route('clientes'); 
                }else{
                    return redirect()->route('usuarios');
                    
                } 
        }else{

             if($request->user_type == 2){
                     return redirect()->route('clientesgerente'); 
                }else{
                    return redirect()->route('usuarios-gerente');
                    
            } 
        } 
               
    }




     public function agregarusuario2(NuevoUsuario $request){

        $date = Carbon::now();
        $mensauliadad = $request->mensualidad; 
        $endDate = $date->addMonth($request->mensualidad);
        $sucursal = $request->sucursal;


        $validated = $request->validated();

        $data = array(
            'nombre'        =>  $request->nombre,
            'apellido'      =>  $request->apellido,
            'tel'           =>  $request->tel,
            'email'         =>  $request->email,
            'password'      =>  bcrypt($request->password),              
            'user_type'     =>  $request->user_type,
            'is_active'     =>  1,
            'mensualidad'   =>  $mensauliadad,
            'fecha_mesualidad'  => $endDate,
            'id_sucursal'   =>  $sucursal
        );

        $id = DB::table('users')->insertGetId($data);
        //return redirect()->route('cliente/'.$id);
        
        return redirect()->route('clientes'); 
       
       

    }


     public function clientesSC(){
        $id_sucursal = Auth::user()->id_sucursal;
        $users = User::where('user_type', '2')->where('id_sucursal',$id_sucursal)->get();
        $data = array(
            'page_content'  =>  'servicio_cliente/lista',
            'page_name'     =>  'Lista de Clientes',
            'js_page'       =>  'usuarios_lista.js',
            'ruta'          =>  'gym',
            'usuarios'      =>  $users
        );

        return view('layout/_main')->with($data);
    }


    public function editarclienteSc($id){

        $date = Carbon::now();
        $user = DB::table('users')
                    ->join('user_types', 'users.user_type', '=', 'user_types.id')
                    ->select('users.*', 'user_types.nombre as tipo_usuario')
                    ->where('users.id', '=', $id)
                    ->first();

        $user_types = DB::table('user_types')->get();

        $data = array(
            'page_content'  =>  'servicio_cliente/user',
            'page_name'     =>  'Usuario: '.ucfirst(strtolower($user->nombre))." ".ucfirst(strtolower($user->apellido)),
            'js_page'       =>  'usuarios_lista.js',
            'ruta'          =>  'gym',
            'user'          =>  $user,
            'user_types'    =>  $user_types,
            'fecha'         =>  $date->format('Y-m-d'),
            // 'contents'      =>  $contents
        );

        return view('layout/_main')
                ->with($data);
    }


    public function actualizar_usuarioSC(ActualizarUsuario2 $request){


        $validated = $request->validated();

        $data = array(
            "nombre"                => $request->input('nombre'),
            "apellido"              => $request->input('apellido'),
            "email"                 => $request->input('email'),
            "tel"                   => $request->input('tel'),
            "fecha_mesualidad"      => $request->input('menbresia')
        );

        $query = DB::table('users')->where('id', '=', $request->input('id'));

        if($request->input('password') != ''){
            $data['password'] = bcrypt($request->input('password'));
        }

        $query->update($data);
        return redirect()->route('clientesSC'); 
    }



}
