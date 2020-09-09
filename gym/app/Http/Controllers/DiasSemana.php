<?php

namespace App\Http\Controllers;

use App\Http\Requests\NuevoUsuario;
use App\Http\Requests\ActualizarUsuario;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Dias_semana;
use App\Horario_detalle;
use Illuminate\Support\Facades\Auth;

class DiasSemana extends Controller{

    public function index(){
        $diassemana = Dias_semana::where('id_sucursal',Auth::user()->id_sucursal)->get();

        $data = array(
            'page_content'  =>  'diassemana/lista',
            'page_name'     =>  'Dias semana',
            'ruta'          =>  'gym',
            'diassemana'      =>  $diassemana
        );
        return view('layout/_main')->with($data);
    }


    

    public function actualizar_usuario(ActualizarUsuario $request, $id){
        $validated = $request->validated();
        $data = array(
            "nombre"                => $request->input('nombre'),
            "apellido"              => $request->input('apellido'),
            "email"                 => $request->input('email'),
            "tel"                   => $request->input('tel'),
            "user_type"             => $request->input('user_type')
        );

        $query = DB::table('users')
                    ->where('id', '=', $id);

        if($request->input('password') != ''){
            $data['password'] = bcrypt($request->input('password'));
        }

        $query->update($data);
        return back();
    }



    public function actualizardias(Request $request){
        $data = array(
            "estatus"                => $request->value
        );
        $actualizarsemana = DB::table('dias_semana')->where('id', '=', $request->id);
        $actualizarsemana->update($data);
        return json_encode($actualizarsemana);
    }


    public function editarhorario($id,$dia){
        $horarios = DB::table('horarios')->where('id_sucursal',Auth::user()->id_sucursal)->get();
        $data = array(
            'page_content'  =>  'diassemana/editar',
            'page_name'     =>  'Dias semana',
            'ruta'          =>  'gym',
            'dia'           =>   $dia,
            'horario'       =>   $horarios,
            'idhorario'     =>   $id
        );
        return view('layout/_main')->with($data);
    }


    public function guardarhorarioelegir(Request $request){

        $actualizarsemana = DB::table('dias_semana')->where('id', '=', $request->idhorario);
        $actualizarsemana->update(['id_horario' => $request->horario]);

        return redirect()->route('diassemana');
    }

    public function ver_horario($id,$nombre){

        $horario = Horario_detalle::where('id_horario',$id)->orderBy('consecutivo')->get();
        $data = array(
            'page_content'      =>  'horarios/editar_horario',
            'page_name'         =>  'Editar Horarios',
            'ruta'              =>  'gym',
            'horarios'          =>  $horario,
            'nombre_horario'    =>  $nombre
        );

        return view('layout/_main')->with($data);

    }


    public function actualizarhorario($id,$horario,$consecutivo){

        echo "sdasdasdasdasdasdasda";

    }



    public function eliminarhorario($id){

        $validardia = Dias_semana::where('id_horario',$id)->first();
        if( $validardia){

            $msg='No puedes eliminar el horario '.  $validardia->nombrehorario->nombre_horario .' por que esta asignado a un dia de la semana.';
            return redirect()->route('horarios')->with('msg',$msg);

        }else{

           $horario = DB::table('horarios')->where('id', '=', $id)->delete();
           $horariodelatte = DB::table('horario_detalle')->where('id_horario', '=', $id)->delete();

           return redirect()->route('horarios');

        }

    }
}
