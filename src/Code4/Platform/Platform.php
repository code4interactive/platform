<?php
/**
 * Created by CODE4 Interactive
 * User: Artur Bartczak
 * Date: 27.06.13
 * Time: 13:10
 */

namespace Code4\Platform;

use Illuminate\Support\Collection;
use Krucas\Notification\Notification;

class Platform {

    protected $script;
    protected $css;
    protected $js;

    public function __construct() {
        $this->css = new Collection();
        $this->scripts = new Collection();
        $this->js = new Collection();
    }

    public function registerDependentPackages() {

        $autoLoader = \Illuminate\Foundation\AliasLoader::getInstance();

        \App::register('Krucas\Notification\NotificationServiceProvider');
        $autoLoader->alias('Platform', 'Code4\Platform\Facades\Platform');

        \App::register('Basset\BassetServiceProvider');
        $autoLoader->alias('Basset', 'Basset\Facade');

        \App::register('Code4\Menu\MenuServiceProvider');
        \App::register('Code4\Form\FormServiceProvider');
        \App::register('Cartalyst\Sentry\SentryServiceProvider');
        \App::register('Cartalyst\DataGrid\DataGridServiceProvider');

        $autoLoader->alias('Notification', 'Krucas\Notification\Facades\Notification');
        $autoLoader->alias('Sentry', 'Cartalyst\Sentry\Facades\Laravel\Sentry');
        $autoLoader->alias('DataGrid', 'Cartalyst\DataGrid\Facades\DataGrid');

    }

    public function addPackageAliases () {

    }

    public function collectViewData() {

        $configApp = \Config::get('config');
        if (!is_array($configApp)) $configApp = array();

        $configPlatform = \Config::get('platform::config');
        $config = array_merge($configPlatform, $configApp);

        \Config::set('platform::config', $config);

        \View::share('platform', array('assetsPath'=>'/packages/code4/platform', 'templatePath' => 'assets/ace-1.1.2'));

        \Menu::loadMenuFromConfig(\Config::get('platform::menu'));
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