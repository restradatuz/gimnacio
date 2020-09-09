<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Conekta\Conekta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConektaController extends Controller
{

    public function clienteConekta(Request $request){

        \Conekta\Conekta::setApiKey("key_kwSrENU565wgHfXKyNFcFg");
        \Conekta\Conekta::setApiVersion("2.0.0");
        \Conekta\Conekta::setLocale('es');

        $user = DB::table('users')
            ->join('oauth_access_tokens', 'users.id', '=', 'oauth_access_tokens.user_id')
            ->join('usuarios_conekta', 'users.id', '=', 'usuarios_conekta.id_usuario')
            ->select('usuarios_conekta.*')
            ->where('users.id', $request->user)
            ->first();


            $customer = \Conekta\Customer::find($user->id_usuario_conekta);
            return response()->json($customer);



    }

    public function nuevoCliente(Request $request)
    {
        \Conekta\Conekta::setApiKey("key_kwSrENU565wgHfXKyNFcFg");
        \Conekta\Conekta::setApiVersion("2.0.0");
        \Conekta\Conekta::setLocale('es');

        $user = DB::table('users')->where('id', $request->user)->first();

        $cliente =  array(
            'name'  => $user->nombre." ".$user->apellido,
            'email' => $user->email,
            'phone' => "+52".$user->tel,
            'corporate' => false
        );

        $res = \Conekta\Customer::create($cliente);

        return response()->json($res);
    }

    public function asignarTarjeta()
    {

        \Conekta\Conekta::setApiKey("key_kwSrENU565wgHfXKyNFcFg");
        \Conekta\Conekta::setApiVersion("2.0.0");
        \Conekta\Conekta::setLocale('es');

        $user = DB::table('usuarios_conekta')->where('id_usuario', 1)->first();

        $customer = \Conekta\Customer::find($user->id_usuario_conekta);

        $data = array(
            "token_id"  =>  'tok_test_visa_4242',
            'type'      =>  'card'
        );

        $source = $customer->createPaymentSource($data);

        $data = array(
            'id'    =>  $source->id,
            'user'  =>  1
        );

        print_r($source->id);



    }

    public function crearOrden()
    {

        \Conekta\Conekta::setApiKey("key_kwSrENU565wgHfXKyNFcFg");
        \Conekta\Conekta::setApiVersion("2.0.0");
        \Conekta\Conekta::setLocale('es');

        $order_data = array(
            'currency' => 'MXN',
            'customer_info' => array(
                'customer_id' => 'cus_2mgnWTryCe5deTLmG'
            ),
            'line_items' => array(
                array(
                    'name' => 'Paq. 7 días plataforma Reisen',
                    'unit_price' => 5000,
                    'quantity' => 1
                )
            ),
            'charges' => array(
                array(
                    'payment_method' => array(
                        'type' => 'default'
                    )
                )
            )
        );

        $order = \Conekta\Order::create($order_data);

        echo json_encode($order);


    }
}
