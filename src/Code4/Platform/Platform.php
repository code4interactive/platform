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
        \App::register('Code4\Menu\MenuServiceProvider');
        \App::register('Code4\Form\FormServiceProvider');
        \App::register('Cartalyst\Sentry\SentryServiceProvider');
        \App::register('Cartalyst\DataGrid\DataGridServiceProvider');

    }

    public function addPackageAliases () {

        $autoLoader = \Illuminate\Foundation\AliasLoader::getInstance();

        $autoLoader->alias('Platform', 'Code4\Platform\Facades\Platform');
        $autoLoader->alias('Notification', 'Krucas\Notification\Facades\Notification');
        $autoLoader->alias('Sentry', 'Cartalyst\Sentry\Facades\Laravel\Sentry');
        $autoLoader->alias('DataGrid', 'Cartalyst\DataGrid\Facades\DataGrid');

    }

    public function collectViewData() {

        $configApp = \Config::get('platform');
        if (!is_array($configApp)) $configApp = array();

        $configPlatform = \Config::get('platform::platform');
        $config = array_merge($configPlatform, $configApp);

        \Config::set('platform::platform', $config);



        \View::share('platform', array('assetsPath'=>'/packages/code4/platform', 'templatePath' => 'assets/ace-1.1.2'));

        \Menu::loadMenuFromConfig(\Config::get('platform::config'));
        \Menu::breadcrumbs()->add(array('id'=>'test', 'name'=>'Test', 'url'=>\URL::route('platformHome')));

    }


    public function handleRequests() {

        if (Request::ajax())
        {
            //Check for notification requests
        }

    }


    public function getView() {

        return $this->view;

    }


    public function __call($name, $args) {



    }

}