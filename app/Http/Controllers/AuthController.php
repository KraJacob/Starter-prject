<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        if(!Auth::check()){
            return view('login');
        }
        return view('welcome');
    }


    public function authenticate(Request $request)
    {
        $request->validate([
            'login' =>'required',
            'password' =>'required',
        ]);
        $credentials = $request->only('login', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'login' => 'Login ou mote de passe incorrect.',
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register(Request $request)
    {
        $request->validate([
            'login' =>'required|string',
            'nom' =>'required|string',
            'prenom' =>'required|string',
            'contact' =>'required|string',
            'role_id' =>'required|numeric',
            'agence_id' =>'required|numeric',

        ]);
       try{
            User::create([
            'nom' => 'Adminstrateur',
            'prenom' => 'admin',
            'contact' => '00000000',
            'login' => 'admin',
            'email' => 'admin@admin.com',
            'role_id' => $roles->id,
            'password' => bcrypt('P@ss0rd225@#'),
            'agence_id' => 1
        ]);

        return redirect('/users')->withErrors(['success'=>'Enregistrement effectué avec succès']);
       }  catch (\Exception $e) {
        return back()->withErrors([
            'register' => 'Une erreur est survenue lors de l\'enrigistrement.',
        ]);
       }

    }
}
