<?php

namespace Code4\Platform\Controllers;

use App\Http\Controllers\Controller;
use Code4\Forms\AbstractForm;
use Code4\Platform\Contracts\Auth;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;

class LoginController extends Controller {

    /**
     * Ekran logowania
     * @return \Illuminate\View\View
     */
    public function index() {
        return view('platform::auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request, Auth $auth)
    {
        $this->validate($request, [
            'email' => 'required', 'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        try
        {
            //if ($request->has('remember'))
            //{
                $auth->authenticate($credentials, $request->has('remember'));
                //\Sentinel::authenticate($credentials);
            //} else
            //{
                //\Sentinel::authenticate($credentials);
            //}
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

    /**
     * Generates lockout screen
     * @param $userId
     * @param Auth $auth
     * @return \Illuminate\Http\Response
     */
    public function lockout($userId, Auth $auth) {
        if (!($user = $auth->getUser($userId))) {
            return \PlatformResponse::redirect('/login');
        }
        echo \View::make('platform::auth.lockout', compact('user'))->render();
    }

    /**
     * Handles lockout post request
     * @param Request $request
     * @param Auth $auth
     * @return $this|\Code4\Platform\Components\Response\PlatformResponse|JsonResponse
     */
    public function postLockout(Request $request, Auth $auth) {

        $credentials = $request->only('email', 'password');
        $form = new AbstractForm();

        $form->customFieldRule('password', function($request) use ($credentials, $auth) {
            if (!($auth->authenticate($credentials, false, true))) {
                return 'Złe hasło';
            }
        });

        if (!$form->validate($request, ['email' => 'required', 'password' => 'required'])) {
            return $form->response();
        }

        return \PlatformResponse::exitLockScreen()->makeResponse();
    }

}