<?php namespace Code4\Platform;


\App::before(function($request)
{
	if (! \Request::is('getNotifications')) {
		\Platform::keepNotifications();
	}
	
});