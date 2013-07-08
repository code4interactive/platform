<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
    $tokens = 100;

    if ($tokens < 10) {
        Notification::warning("Zamów tokeny");
    }

    //Menu::topMenu()->offsetGet(0)->add(array("id"=>"aaa","name"=>"aasas"));

    Notification::success('Success message');
    Notification::error("Error message");
    Notification::warning("Warning message");
    Notification::info("Info message");
    $view = View::make('platform::templates.ace.dashboard');

    Notification::clearAll();
    //Notification::showAll();

    return $view;
});

Route::get('test/{id}', 'AdministrationController@showProfile');

Route::post('/', function()
{

    Notification::success('Success message');
    Notification::error("Error message");
    Notification::warning("Warning message");
    Notification::info("Info message");
    //$view = View::make('platform::templates.ace.dashboard');

    if (Request::ajax())
    {
        Notification::success("Yeeeeee");

        return Notification::all()->toJson();
    }


    //return $view;
});
