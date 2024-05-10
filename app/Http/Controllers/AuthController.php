<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function verify(Request $request){
        // $user = User::where('username', $request->username)->first();
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            // Authentication was successful
            $request->session()->regenerate();
            return redirect()->intended('/'); // Redirect to the intended URL
        }
        // if($user){
        //     if(Hash::check($request->password, $user->password)){
        //         $request->session()->put('user', $user);
        //         return redirect('/');
        //     }
        // }
        return redirect()->back()->withErrors('Username atau password salah !!');
    }
    
    public function logout(Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
