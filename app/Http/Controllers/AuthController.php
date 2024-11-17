<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'account' => 'required|unique:login,account',
            'password' => 'required|min:8',
            'name' => 'required',
        ]);

        //創建使用者
        Login::create($request->all());
        return redirect()->route('Login.index')->with('success', '註冊成功，請登入。');
    }

    public function showLogin(){
        return view('Login.index');
    }

    public function login(Request $request){
        $request->validate([
            'account' => 'required',
            'password' => 'required',
        ]);

        $user=Login::where('account',$request->account)->first();
        
        if($user && $request->password === $user->password){
            Auth::login($user);
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'account' => '提供的帳號或密碼不正確。',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}
