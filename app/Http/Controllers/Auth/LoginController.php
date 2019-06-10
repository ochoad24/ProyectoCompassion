<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
    
class LoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }
    public function login(Request $request){
        $this->validateLogin($request);
        if(Auth::attempt(['usuario'=>$request->usuario,'password'=>$request->password])){
            return redirect('/');
        }
        return back()
        ->withErrors(['usuario' => trans('auth.failed')])
        ->withInput(request(['usuario']));
    }
    protected function validateLogin(Request $request)
    {
        $this->validate($request,[
            'usuario'=>'required|string',
            'password'=>'required|string'
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
