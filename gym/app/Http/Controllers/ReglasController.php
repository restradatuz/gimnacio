<?php

namespace App\Http\Controllers;

use App\ReglasNegocio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReglasController extends Controller{

    public function index(){

        $reglas = ReglasNegocio::where('id_sucursal',Auth::user()->id_sucursal)->first();

        $data = array(
            'page_content'  =>  'reglas/reglas',
            'page_name'     =>  'Reglas de negocio',
            'js_page'       =>  'reglas_negocio.js',
            'ruta'          =>  'gym',
            'reglas'        =>  $reglas
        );

        return view('layout/_main')->with($data);

    }

    public function actualizarReglas(Request $request){

        $data = array(
            "dias"                          => $request->input('dias'),
            "cantidad_gym"                  => $request->input('cantidad_gym'),
            "cliente_reservacionxdia"       => $request->input('cliente_reservacionxdia'),
            "resevaciones_permitidas"       => $request->input('resevaciones_permitidas'),
            "usuario"                       => Auth::user()->id
        );

        ReglasNegocio::where('id_sucursal', Auth::user()->id_sucursal)->update($data);

        return back();

    }

}
