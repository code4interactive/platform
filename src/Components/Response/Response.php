<?php

namespace Code4\Platform\Components\Response;

use Code4\Forms\FormInterface;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Routing\ResponseFactory;

class Response {

    private $request;

    private $response;

    public function __construct(Request $request, ResponseFactory $response) {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @param FormInterface $form
     * @return array
     */
    public function makeFormResponse(FormInterface $form) {
        $messages = $form->messages()->toArray();
        return ['formErrors' => $messages];
    }


    public function makeResponse(Actions $actions) {

        foreach($actions->toArray()['actions'] as $action) {



        }

        //check all actions and determine what type of response code is needed
        return $this->response->make($actions->toJson(), $statusCode);

    }

}