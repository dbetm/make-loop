<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;


class LoginController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    public function login() {
        return view('auth.login');
    }

    public function postLogin(Request $request) {
        $this->validate($request, [
          'email' => 'required|email', 'password' => 'required'
        ]);
        //$credentials['email'] = 'fierroformo@gmail.com'; //$request->get('email');
        //$credentials['password'] = 'vinco'; //$request->get('password');
        //dd($credentials);
        $user = User::where('email', $request->get('email'))->first();
        //dd($user);
        Auth::login($user);
        //Auth::guard('home')->login($user);

        return redirect('home');
    }

}
