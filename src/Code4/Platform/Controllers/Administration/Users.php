<?php namespace Code4\Platform\Controllers;

class Administration_Users extends \BaseController {


    public function getIndex($id) {
        echo $id;
    }

    public function getUsers() {
        return \View::make('platform::administration.listUsers');
    }


    public function addUser() {


        return \View::make('platform::administration.users.add');


        $user = Sentry::getUserProvider()->create(array(
            'email'    => 'john.doe@example.com',
            'password' => 'test',
        ));
    }

    public function showUsers() {

        return \View::make('platform::administration.listUsers');

    }

}