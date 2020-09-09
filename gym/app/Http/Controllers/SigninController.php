<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SigninController extends Controller{

    public function index(){

        return view('login');

    }
    
  public function authenticate(Request $request){

       
         $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            return redirect()->route('dashboard');


        }else{
            $errors = array(
                'login' => "El usuario y/o contraseña no son correctos"
            );

            return back()->withErrors($errors);

        }
        
        
  }
}
/** 
  public function verifyPassword($email, $password)
    {
        try {
            $response = $this->firebase->getAuth()->verifyPassword($email, $password);
            return $response->uid;

        } catch(FirebaseEmailExists $e) {
            logger()->info('Error login to firebase: Tried to create an already existent user');
        } catch(Exception $e) {
            logger()->error('Error login to firebase: ' . $e->getMessage());
        }
        return false;
    } 
    */