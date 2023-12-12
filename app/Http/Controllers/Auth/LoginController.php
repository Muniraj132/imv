<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use Auth;
   
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
  
  
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
  
     /**
     * Write code on Method
     *
     * @return response()
     */
    public function login($id=false)
    {
        $credentials = [];
        if(!empty($id)){
            $id = Crypt::decryptString($id);
            $userdata = explode('/CRI/',$id);

            $credentials = ["email"=>base64_decode($userdata[0]), "password"=>base64_decode($userdata[1])];

            if (Auth::attempt($credentials)) {
                return redirect()->intended('dashboard')->with('success','You have Successfully logged in');
            } else {
                return redirect()->intended('login')->with('error','Some issue with the given link');
            }
        } else {
            if (Auth::attempt($credentials)) {
                return redirect()->intended('dashboard')->with('success','You have Successfully logged in');
            }
            return redirect("login")->with('error','Sorry! You have entered invalid credentials');
        }
    }
}