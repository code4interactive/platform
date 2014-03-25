<?php namespace Code4\Platform;

use ClassPreloader\Config;
use Illuminate\Support\ServiceProvider;
use Code4\Menu\Facades\Menu;
use Krucas\Notification\Facades\Notification;
use Cartalyst\DataGrid\Facades\DataGrid;


/**
 * TESTS
 */

\Route::get('tests/datagridTest1', 'Code4\Platform\Controllers\Tests_Tablegrid@datagridTest1');
\Route::get('tests/formsTest1', 'Code4\Platform\Controllers\Tests_Forms@formsTest1');




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

\Route::get('administration/users/add', 'Code4\Platform\Controllers\Administration_Users@addUser');
\Route::get('administration/users/get', 'Code4\Platform\Controllers\Administration_Users@getUsers');
\Route::post('administration/users/add', 'Code4\Platform\Controllers\Administration_Users@saveForm');

\Route::get('/', array('as' => 'platformHome', function() {

    Menu::breadcrumbs()->add(array('id'=>'test', 'name'=>'Test', 'url'=>\URL::route('platformHome')))->at(2);
    //$view = \View::make('platform::dashboard');
    $view = \View::make('theme::dashboard');
    return $view;

}));

\Route::get('administration/users/list/ajax', function() {

    return \View::make('platform::administration.users.list');

});


\Route::get('testInclude', function() {
   return \View::make('platform::includetest');
});


\Route::post('getNotifications', function(){
    if (\Request::ajax())
    {

        $temp = Notification::all()->toArray();

        Notification::clearAll();
        \Session::forget('notifications_default');

        \Response::json($temp);
        return $temp;
    }
});

\Route::post('dataSrc', function(){

    $user = new \Code4\Platform\Models_Konta;

    $dataGrid = DataGrid::make($user, array(
        'id', 'konto', 'opis'
    ));
    return $dataGrid;
});

\App::error(function($exception, $code){
    switch ($code)
    {
       /* case 403:
            return Response::view('errors.403', array(), 403);*/

        case 404:
            Menu::breadcrumbs()->add(array('id'=>'404', 'name'=>'404 Page Not Found', 'active'=>true))->at();
            return \Response::view('platform::errors.404', array(), 404);

        /*case 500:
            return Response::view('errors.500', array(), 500);

        default:
            return Response::view('errors.default', array(), $code);*/
    }
});