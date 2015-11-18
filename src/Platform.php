<?php
namespace Code4\Platform;

use Cartalyst\Sentinel\Users\UserInterface;
use Code4\Platform\Components\Response\PlatformResponse;
use Code4\Platform\Contracts\Auth;
use Code4\Settings\Settings;
use Code4\Settings\SettingsFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Collection;

class Platform {

    private $settings;

    /**
     * @var Auth
     */
    private $auth;

    public function __construct(Auth $auth, Request $request, Redirector $redirector, ResponseFactory $response) {
        $this->auth = $auth;
        $this->request = $request;
        $this->redirector = $redirector;
        $this->response = $response;
        $this->settings = new SettingsFactory(['platform', 'platform_user'], $this->auth->currentUserId());
        //$this->actions = new Actions();
    }

    /**
     * @return SettingsFactory
     */
    public function settings() {
        return $this->settings;
    }


    public function notify($errorType) {

    }

    /**
     * Returns response actions
     * @return Actions
     */
    public function action() {
        //return $this->actions;
    }



    public function checkPermission($permissions) {
        if (!$this->auth->hasAccess($permissions)) {
            if ($this->request->ajax()) {
                echo $this->response->make('Forbidden', 403);
            } else {
                \Alert::error('Nie masz uprawnień do tego zasobu!');
                echo $this->redirector->back();
            }
            die();
        }
    }
}