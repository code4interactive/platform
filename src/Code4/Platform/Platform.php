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
        /*\App::register('Code4\Form\FormServiceProvider');*/
        \App::register('Cartalyst\Sentry\SentryServiceProvider');
        \App::register('Cartalyst\DataGrid\DataGridServiceProvider');
        \App::register('Code4\C4former\C4formerServiceProvider');
        /*\App::register('Former\FormerServiceProvider');*/

        $autoLoader->alias('Notification', 'Krucas\Notification\Facades\Notification');
        $autoLoader->alias('Sentry', 'Cartalyst\Sentry\Facades\Laravel\Sentry');
        $autoLoader->alias('DataGrid', 'Cartalyst\DataGrid\Facades\DataGrid');
        $autoLoader->alias('C4Former', 'Code4\C4former\Facades\C4Former');
       /* $autoLoader->alias('Former', 'Former\Facades\Former');*/



    }

    public function addPackageAliases () {

    }

    public function collectViewData() {

        $configApp = \Config::get('config');
        if (!is_array($configApp)) $configApp = array();

        $configPlatform = \Config::get('platform::config');
        $config = array_merge($configPlatform, $configApp);

        \Config::set('platform::config', $config);

        //  \View::share('platform', array('assetsPath'=>'/packages/code4/platform', 'templatePath' => 'assets/ace-1.1.2'));
        \View::share('platform', array('assetsPath'=>'/packages/code4/platform', 'templatePath' => 'assets/ace-v1.2--bs-v3.0.0'));


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

    public function keepNotifications() {

        $flashed = \Session::get('notifications_default');

        if($flashed && true)
        {
            \Session::forget('notifications_default');

            $messages = json_decode($flashed);

            if(is_array($messages))
            {
                foreach($messages as $key => $message)
                {

                    $config = array('message' => 'ok', 'format' => ':message');

                    if(isset($message->alias) && !is_null($message->alias))
                    {
                        $config['alias'] = $message->alias;
                    }

                    if(isset($message->position) && !is_null($message->position))
                    {
                        $config['position'] = $message->position;
                    }

                    $el = \Notification::add($message->type, $message->message, true, $message->format);

                    if (array_key_exists('alias', $config)) $el->alias($message->alias);
                    if (array_key_exists('position', $config)) $el->atPosition($message->position);

                }
            }
        }
    }

    public function __call($name, $args) {



    }

}