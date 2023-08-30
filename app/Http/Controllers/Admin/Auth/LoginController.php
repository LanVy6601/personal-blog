<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function loginForm()
    {
        // if (Auth::guard('admin')->check()) {
        //     return redirect()->route('admin.article.index');
        // }
        return Inertia::render('Admin/Auth/Login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt($data)) {
            $request->session()->regenerate();

            return redirect()->intended('admin/article');
        }
    }

    function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login.get');
    }
}
