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


Route::get('/', array('as' => 'platformHome', function()
{


    Menu::breadcrumbs()->add(array('id'=>'test', 'name'=>'Test', 'url'=>URL::route('platformHome')))->at(2);

   // Notification::success('Success message');
  //  Notification::error("Error message");
  //  Notification::warning("Warning message");
  //  Notification::info("Info message");
    $view = View::make('platform::test');

    Notification::clearAll();


    return $view;
}));


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

        $temp = Notification::all()->toJson();

        Notification::clearAll();
        return $temp;
    }


    //return $view;
});
