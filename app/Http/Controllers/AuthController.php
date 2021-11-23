<?php

namespace App\Http\Controllers;

use App\Mail\NewUserRegistred;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    /**
     * Prikazuje formu za registraciju
     * 
     * @return Response
     */
    public function registration()
    {
        return view('auth.registration');
    }

    /**
     * Prikazuje formu za login
     * 
     * @return Response
     */
    
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Ćuva detalje o novom Useru, registracija korisnika
     * 
     * @return Response
     */
    public function store()
    {

        $attributes = request()->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|confirmed|min:7|max:255',
        ]);

        $user = User::create($attributes);
        Mail::to('admin@cms.com')->send(new NewUserRegistred($user));

        return redirect('/login')->with('message','Uspešno ste kreirali nalog.');
        //ako zelite da je User ulogovan po registraciji, zakomentarisiste gornju liniju koda, a otkomentarisite sledece 2
        // Auth::attempt($attributes);
        // return redirect('/posts')->with('success','Uspešno ste kreirali nalog.');
    }

    /**
     * Čuva sesiju ulogovanog korisnika, logovanje
     * 
     * @return Response
     */
    public function sessionStore()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($attributes)) {
            session()->regenerate();
            return redirect('/posts');
        }

        return redirect()->back()->with('message','Nemamo poklapanje sa unešenim korisnikom. Pokušajte ponovo.');

    }

    /**
     * Uništava sesiju ulogovanog korisnika
     * 
     * @return Response
     * 
     */
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}
