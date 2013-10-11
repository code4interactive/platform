<?php namespace Code4\Platform\Controllers;

use Krucas\Notification\Notification;

class Administration_Users extends \BaseController {


    public function getIndex($id) {
        echo $id;
    }

    public function getUsers() {
        \Notification::success('Success message');
        \Notification::success('Success message2');
        \Notification::error('Success message');
//        /\Menu::breadcrumbs()->add(array('id'=>'Administration', 'name'=>'Administration', 'url'=>\URL::route('administration')))->at();
        return \View::make('platform::administration.listUsers');
    }


    public function addUser() {


        return \View::make('platform::administration.users.add');


        /*$user = Sentry::getUserProvider()->create(array(
            'email'    => 'john.doe@example.com',
            'password' => 'test',
        ));*/
    }

    public function showUsers() {
        Menu::breadcrumbs()->add(array('id'=>'test', 'name'=>'Test', 'url'=>\URL::route('platformHome')))->at(2);

        return \View::make('platform::administration.listUsers');

    }

}