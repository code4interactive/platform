<?php
namespace Code4\Platform;

use Cartalyst\Sentinel\Users\UserInterface;
use Code4\Settings\Settings;
use Code4\Settings\SettingsFactory;
use Illuminate\Http\Request;

class Platform {

    private $settings;
    /**
     * @var UserInterface | \Code4\Platform\Models\User
     */
    private $user;

    public function __construct(UserInterface $user, Request $request) {
        $this->user = $user;
        $this->request = $request;
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


    public function checkPermission($permissions) {
        if (!$this->user->hasAccess($permissions)) {
            if ($this->request->ajax()) {
                //echo response('Forbidden.', 403);
                echo \Response::make('Forbidden', 403);
            } else {
                //echo redirect()->back();
                echo \Redirect::back();
            }
            die();
        }
    }

    public function checkRole($roleName) {

    }


    public function checkShowInMenu($menuPermission) {

    }
}