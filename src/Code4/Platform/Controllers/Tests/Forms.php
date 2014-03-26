<?php namespace Code4\Platform\Controllers;

class Tests_Forms extends \BaseController {


	public function formsTest1() {
		return \View::make('platform::tests.forms1');
	}


	public function formTestValidation() {
		$temp = \C4Former::getNewInstance();
        $temp->load('platform::Tests/testform.testform1');

        //$wlasny = array();
        //$wlasny[] = array("id" => "nazwa_klienta", "message"=>"Moj błąd");
        //$temp->throwError("nazwa_klienta", "Mój błąd");

        $temp->validate(array('!password'));

        return $temp->response();
	}

}