<?php
namespace Code4\Platform;

use Cartalyst\Sentinel\Users\UserInterface;
use Code4\Platform\Components\Response\Actions;
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

    private $actions;

    public function __construct(Auth $auth, Request $request, Redirector $redirector, ResponseFactory $response) {
        $this->auth = $auth;
        $this->request = $request;
        $this->redirector = $redirector;
        $this->response = $response;
        $this->settings = new SettingsFactory(['platform', 'platform_user'], $this->auth->currentUserId());
        $this->actions = new Actions();
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
        return $this->actions;
    }

    /**
     * Makes response from passed data
     * @param array|\Code4\Forms\FormInterface $data
     * @param string|null $action Action of passed data. If null script will try determine action type
     * @return Response
     */
    public function makeResponse($data = null, $action = null) {

        $responseData = [];
        $statusCode   = 200;

        if (is_object($responseData)) {

            if (is_a($data, 'Code4\Forms\FormInterface')) {
                $responseData['formErrors'] = $data->messages()->toArray();
                $statusCode = 422;
            }

        }

        else if (is_array($data) && !is_null($action)) {
            $responseData[$action] = $data;
        }

        return $this->response->make($responseData, $statusCode);
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