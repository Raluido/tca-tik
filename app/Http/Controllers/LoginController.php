<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{

    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Handle account login request
     *
     * @param LoginRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        if (RateLimiter::tooManyAttempts('login', 5)) {
            return redirect()->back()->withErrors('Has alcanzado el número máximo de intentos, no podrás volver a intentarlo hasta pasado un minuto.');
        }

        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->intended('/');
        } else {

            RateLimiter::hit('login', 60);

            if (RateLimiter::tooManyAttempts('login', 5)) {
                return redirect()->back()->withErrors('Has alcanzado el número máximo de intentos, no podrás volver a intentarlo hasta pasado un minuto.');
            } else {
                return redirect()->back()->withErrors('La combinación de usuario/contraseña utilizada no es correcta. Te quedan ' . RateLimiter::remaining('login', 5) . ' intentos.');
            }
        }

        if (RateLimiter::remaining('login', 5)) {


            if (RateLimiter::tooManyAttempts('login', 5)) {
                return redirect()->back()->withErrors('Has alcanzado el número máximo de intentos, no podrás volver a intentarlo hasta pasado un minuto.');
            } else {
                return redirect()->back()->withErrors('La combinación de usuario/contraseña utilizada no es correcta. Te quedan ' . RateLimiter::remaining('login', 5) . ' intentos.');
            }
        } else {
            return redirect()->back()->withErrors('Has alcanzado el número máximo de intentos, no podrás volver a intentarlo hasta pasado un minuto.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login.show');
    }
}
