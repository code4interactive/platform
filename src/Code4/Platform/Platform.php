<?php
/**
 * Created by CODE4 Interactive
 * User: Artur Bartczak
 * Date: 27.06.13
 * Time: 13:10
 */

namespace Code4\Platform;
use Symfony\Component\Yaml\Parser;

class Platform {

    public function __construct() {

        //$yaml = new Parser();
        //$this->menu = $yaml->parse(file_get_contents(__DIR__.'/../../config/platform.yml'));

    }


    public function registerDependentPackages() {

        \App::register('Krucas\Notification\NotificationServiceProvider');
        //\App::register('Code4\Notification\NotificationServiceProvider');

    }

    public function addPackageAliases () {

        $autoLoader = \Illuminate\Foundation\AliasLoader::getInstance();

        $autoLoader->alias('Platform', 'Code4\Platform\Facades\Platform');
        $autoLoader->alias('Menu', 'Code4\Platform\Menu\Facades\Menu');
        $autoLoader->alias('Notification', 'Krucas\Notification\Facades\Notification');
       // $autoLoader->alias('Notification', 'Code4\Notification\Facades\Notification');

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