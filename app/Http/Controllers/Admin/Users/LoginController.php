<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    protected $nameAdminLogin;
    public function index(){
        return view('admin.users.login', [
            'title' => 'Login System'
        ]);
    }

    public function store(Request $request, User $user){
        $this->validate($request, [
            'email'=>'required|email:filter',
            'password'=>'required'
        ]);

        if(Auth::attempt([
            'email' => $request->input('email'), 
            'password' => $request->input('password')
        ], $request->input('remember'))){
            return redirect()->route('admin');
        }

        Session::flash('error', 'Data is not valilable');
        return redirect()->back();
    }
}
