<?php

namespace Code4\Platform\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;

class LoginController extends Controller {

    /**
     * Ekran logowania
     * @return \Illuminate\View\View
     */
    public function index()     {
        return view('platform::auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required', 'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        try
        {
            if ($request->has('remember'))
            {
                \Sentinel::authenticateAndRemember($credentials);
            } else
            {
                \Sentinel::authenticate($credentials);
            }
        } catch (NotActivatedException $e) {
            return redirect('/login')
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'message' => 'Twoje konto nie zostało jeszcze aktywowane. Skontaktuj się z administratorem.',
                ]);
        }

        if ($user = \Sentinel::check())
        {
            return redirect('/dashboard');
        }

        return redirect('/login')
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => 'Zły login lub hasło',
            ]);
    }

    public function logout() {
        \Sentinel::logout();
        return redirect('/login');
    }

}