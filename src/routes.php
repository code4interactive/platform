<?php


/** LOGIN **/
Route::get('/login', [ 'as' => 'login', 'uses' => 'Code4\Platform\Controllers\LoginController@index' ]);
Route::post('/login', ['uses'=>'Code4\Platform\Controllers\LoginController@postLogin']);
Route::get('/logout', [ 'as' => 'logout', 'uses' => 'Code4\Platform\Controllers\LoginController@logout' ]);
Route::get('/lockout/{userId}', 'Code4\Platform\Controllers\LoginController@lockout');
Route::post('/lockout', 'Code4\Platform\Controllers\LoginController@postLockout');
/** END LOGIN **/

Route::group(['middleware' => ['auth']], function (){

    /** NOTIFICATIONS **/
    Route::post('/getNotifications', function(){
        return \PlatformResponse::makeResponse(\Alert::all(true), 'notifications');
    });
    /** END NOTIFICATIONS **/

    /** ACTIVITY **/
    Route::post('/getActivityFeed', 'Code4\Platform\Controllers\ActivityController@getActivityFeed');
    Route::post('/writeComment', 'Code4\Platform\Controllers\ActivityController@comment');
    Route::get('/watchThread/{threadId}', 'Code4\Platform\Controllers\ActivityController@watchThread');

    Route::get('/testMessages', function() {

        $userId = \Auth::currentUserId();
        $user = \Code4\Platform\Models\User::find($userId);
        $user->threadsWithNewOrLatestMessages();

    });

    /** END ACTIVITY **/

    /** DASHBOARD **/
    Route::get('dashboard', function(){
        return view('platform::dashboard');
    });

    /** USERS **/
    Route::get('administration/user/{id}', 'Code4\Platform\Controllers\UsersController@show');
    Route::post('administration/user/{id}', 'Code4\Platform\Controllers\UsersController@saveProfile');
    Route::post('administration/users/index', 'Code4\Platform\Controllers\UsersController@indexDataTable');
    Route::get('administration/users/{id}/delete', 'Code4\Platform\Controllers\UsersController@destroy');
    //Route::get('user/profile/{id}', 'Code4\Platform\Controllers\UsersController@profile');
    Route::resource('administration/users', 'Code4\Platform\Controllers\UsersController');

    /** ROLES **/
    Route::post('administration/roles/index', 'Code4\Platform\Controllers\RolesController@indexDataTable');
    Route::get('administration/roles/{id}/delete', 'Code4\Platform\Controllers\RolesController@destroy');
    Route::resource('administration/roles', 'Code4\Platform\Controllers\RolesController');

    /** SETTINGS **/
    Route::get('settings/general', 'Code4\Platform\Controllers\SettingsController@general');
    Route::post('settings/general', 'Code4\Platform\Controllers\SettingsController@store');
    Route::get('settings/general/user', 'Code4\Platform\Controllers\SettingsController@generalUser');
    Route::post('settings/general/user', 'Code4\Platform\Controllers\SettingsController@storeGeneralUser');

    /** GLOBAL SEARCH **/
    Route::post('search', 'Code4\Platform\Controllers\SearchController@index');
});