<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function Index()
    {
        return view('login');
    }

    public function Login(LoginRequest $r)
    {
        $email = $r->email;
        $password = $r->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect('admin/acc');
        } else {
            return redirect()->back();
        }
    }

    public function Logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
