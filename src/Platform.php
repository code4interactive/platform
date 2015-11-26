<?php
namespace Code4\Platform;

use Cartalyst\Sentinel\Users\UserInterface;
use Code4\Platform\Components\Response\PlatformResponse;
use Code4\Platform\Components\Settings\SettingsCollection;
use Code4\Platform\Contracts\Auth;
//use Code4\Settings\Settings;
//use Code4\Settings\SettingsFactory;
use Illuminate\Config\Repository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Collection;

class Platform {

    private $settingsCollection;

    /**
     * @var Auth
     */
    private $auth;

    public function __construct(Auth $auth, Repository $config, Request $request, Redirector $redirector, ResponseFactory $response) {
        $this->auth = $auth;
        $this->request = $request;
        $this->redirector = $redirector;
        $this->response = $response;
        $this->settingsCollection = new SettingsCollection($auth->currentUserId(), $config);
    }

    /**
     * @return SettingsCollection
     */
    public function settings($key = null, $default = null) {
        if (is_null($key)) {
            return $this->settingsCollection;
        } else {
            $block = explode('.', $key);
            try {
                return $this->settingsCollection->settings()->get($key);
            } catch (\Exception $e) {
                return $default;
            }
        }
    }

    /**
     * @return \Code4\Settings\SettingsFactory
     */
    public function getSettingsFactory() {
        return $this->settingsCollection->settings();
    }

}