<?php

namespace Code4\Platform\Components\Response;

use App\Http\Requests\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Collection;

class PlatformResponse extends Collection {

    private $response;

    private $responseData = [];

    public function __construct(ResponseFactory $response) {
        $this->response = $response;
    }

    /**
     * Executes passed JS script
     * @param $evalScript
     * @return $this
     */
    public function jsEval($evalScript) {
        $this->push(['eval' => $evalScript]);
        return $this;
    }

    /**
     * Sends command to redirect browser to given urk
     * @param string $url
     * @return \Illuminate\Http\Response
     */
    public function redirect($url) {
        return $this->response->make($url, 302);
    }

    /**
     * Sends command to reload browser window
     * @param bool $forceGet - If true - forces reload to get current page from server not cache
     * @return $this
     */
    public function reload($forceGet = false) {
        $this->push(['reload'=>$forceGet]);
        return $this;
    }

    /**
     * Sends command to reload activity feed
     * @param $feed
     * @return $this
     */
    public function reloadFeed($feed) {
        $this->push(['reloadFeed'=>$feed]);
        return $this;
    }

    /**
     * Sends command to exit lock screen
     * @return $this
     */
    public function exitLockScreen() {
        $this->push(['exitLockout' => true]);
        return $this;
    }

    /**
     * Sends command to DataTable to reload
     * @param string $dataTableName
     * @return $this
     */
    public function reloadDataTable($dataTableName) {
        $this->push(['reloadDataTable' => '#dt-'.$dataTableName]);
        return $this;
    }

    /**
     * Sends command to check notifications
     * @return $this
     */
    public function checkNotifications() {
        $this->push(['checkNotifications' => true]);
        return $this;
    }

    /**
     * Makes response from passed data
     * @param array|\Code4\Forms\FormInterface $data
     * @param string|null $action Action of passed data. If null script will try determine action type
     * @param int $statusCode
     * @return Response
     */
    public function makeResponse($data = null, $action = null, $statusCode = 200) {
        if (is_object($data)) {
            //Handle passed object
            if (is_a($data, 'Code4\Forms\FormInterface')) {
                $this->responseData['formErrors'] = $data->messages()->toArray();
                $statusCode = 422;
            }

            //If one of previous actions changed status code
            if ($statusCode != 200) {
                return $this->response->make($this->responseData, $statusCode);
            }
        }

        //Handle passed array
        if (is_array($data) && !is_null($action)) {
            $this->responseData[$action] = $data;
        }

        //If previous actions are still 200
        //handle stored locally actions
        if ($statusCode == 200) {
            $this->responseData['actions'] = $this->toArray();
        }

        return $this->response->make($this->responseData, $statusCode);
    }

    /**
     *
     */
    public function runtimeErrorResponse(Request $request, $error){
        return $this->response->make(['runtimeError'=>$error], 406); //Unacceptable
    }
}