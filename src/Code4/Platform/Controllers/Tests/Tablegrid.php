<?php namespace Code4\Platform\Controllers;

use Krucas\Notification\Notification;

class Tests_Tablegrid extends \BaseController {


	public function datagridTest1() {

        \Log::error(\Request::header());
		\Notification::success("Jeeeeeee");
		return \View::make('platform::tests.tablegrid');
	}


}