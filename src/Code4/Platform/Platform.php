<?php
/**
 * Created by CODE4 Interactive
 * User: Artur Bartczak
 * Date: 27.06.13
 * Time: 13:10
 */

namespace Code4\Platform;

class Platform {

    public function __construct() {


    }


    public function registerDependentPackages() {

        \App::register('Krucas\Notification\NotificationServiceProvider');

    }

    public function addPackageAliases () {

        $autoLoader = \Illuminate\Foundation\AliasLoader::getInstance();

        $autoLoader->alias('Platform', 'Code4\Platform\Facades\Platform');
        $autoLoader->alias('Notification', 'Krucas\Notification\Facades\Notification');

    }

    public function collectViewData() {

        \View::share('platform', array('assetsPath'=>'/packages/code4/platform'));


    }


    public function handleRequests() {

        if (Request::ajax())
        {
            //Check for notification requests
        }

    }

}