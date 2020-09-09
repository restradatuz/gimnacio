<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller{

    public function index(){

        $data = array(
            'page_content'  =>  'dashboard',
            'page_name'     =>  'Dashboard',
            'ruta'			=> 'gym'
        );

        return view('layout/_main')->with($data);
    }

}
