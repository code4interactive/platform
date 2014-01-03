<?php namespace Code4\Platform\Controllers;

use Krucas\Notification\Notification;

class Administration_Users extends \BaseController {


    public function getIndex($id) {
        echo $id;
    }

    public function getUsers() {
        //\Notification::success('Success message');
       // \Notification::success('Success message2');
       // \Notification::error('Success message');
//        /\Menu::breadcrumbs()->add(array('id'=>'Administration', 'name'=>'Administration', 'url'=>\URL::route('administration')))->at();
        return \View::make('platform::administration.listUsers');
    }


    public function addUser() {
        \Menu::breadcrumbs()->add(array('id'=>'test', 'name'=>'Test', 'url'=>\URL::route('platformHome')))->at(2);
        //\Notification::success('Success message2')->atPosition(1);
        //\Notification::error('Success message')->atPosition(2);



        $temp = \C4Former::getNewInstance();
        $temp->load('testform.form1');


        return \View::make('platform::administration.users.add');


        /*$user = Sentry::getUserProvider()->create(array(
            'email'    => 'john.doe@example.com',
            'password' => 'test',
        ));*/
    }

    public function saveForm() {

        $temp = \C4Former::getNewInstance();
        $temp->load('testform.form1');

        //$wlasny = array();
        //$wlasny[] = array("id" => "nazwa_klienta", "message"=>"Moj błąd");
        $temp->throwError("nazwa_klienta", "Mój błąd");

        $temp->validate(array('!password'));

        return $temp->response();

    }

    public function showUsers() {
        Menu::breadcrumbs()->add(array('id'=>'test', 'name'=>'Test', 'url'=>\URL::route('platformHome')))->at(2);

        return \View::make('platform::administration.listUsers');

    }

}