<?php
namespace Code4\Platform;

use Cartalyst\Sentinel\Users\UserInterface;
use Code4\Settings\Settings;
use Code4\Settings\SettingsFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\ResponseFactory;

class Platform {

    private $settings;
    /**
     * @var UserInterface | \Code4\Platform\Models\User
     */
    private $user;

    public function __construct(UserInterface $user, Request $request, Redirector $redirector, ResponseFactory $response) {
        $this->user = $user;
        $this->request = $request;
        $this->redirector = $redirector;
        $this->response = $response;
        $this->settings = new SettingsFactory(['platform', 'platform_user'], $this->user->getUserId());
    }

    /**
     * @return SettingsFactory
     */
    public function settings() {
        return $this->settings;
    }

    /**
     * @return \Cartalyst\Sentinel\Users\UserInterface | \Code4\Platform\Models\User
     */
    public function user() {
        return $this->user;
    }



    public function notify($errorType) {

    }




    public function permission($permissions) {
        return $this->user->hasAccess($permissions);
    }


    public function checkPermission($permissions) {
        if (!$this->user->hasAccess($permissions)) {
            if ($this->request->ajax()) {
                //echo response('Forbidden.', 403);
                echo $this->response->make('Forbidden', 403);
                //echo \Response::make('Forbidden', 403);
            } else {
                //echo redirect()->back();
                echo $this->redirector->back();
            }
            die();
        }
    }

    public function checkRole($roleName) {

    }


    public function checkShowInMenu($menuPermission) {

    }
}