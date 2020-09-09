<?php
namespace App\Http\Controllers;
use Validator;
use Response;
use Illuminate\Http\Request;
use App\Http\Requests\UbicacionRequest;
use App\Ubicacion;
use Illuminate\Support\Facades\Auth;

class UbicacionController extends Controller
{

  

  public function create()
  {

  	$ubicacion = Ubicacion::where('id_sucursal',  Auth::user()->id_sucursal)->first();

     $data = array(
            'page_content'  =>  'ubicaciones/alta',
            'page_name'     =>  'Ubicacion',
            'ruta'          =>  'gym',
            'ubicacion'        =>  $ubicacion
        );

        return view('layout/_main')->with($data);
  }



  public function updatestore(Request $request)
  {



      $eliminar = array("(", ")");
      $coordenadas = str_replace($eliminar, "", $request->cordenadas1);


      $ubicacion = explode(",", $coordenadas);
      $coord1 = $ubicacion[0];
      $coord2 = $ubicacion[1]; 
      

       $data = array(
            "nombre"                        => strtoupper($request->nombre),
            "cordenadas1"                  	=> $coord1,
            "cordenadas2"       			      => $coord2
        );

        Ubicacion::where('id_sucursal', Auth::user()->id_sucursal)->update($data);

      return back();
  }

  
}
