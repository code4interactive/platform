<?php namespace Code4\Platform\Controllers;

use Krucas\Notification\Notification;

class Tests_Tablegrid extends \BaseController {


	public function datagridTest1() {
		return \View::make('platform::tests.tablegrid');
	}


}