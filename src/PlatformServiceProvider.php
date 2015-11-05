<?php

namespace Code4\Platform;

use App\Components\C4Form\C4Form;
use Code4\Platform\Components\View\AssetsHelper;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class PlatformServiceProvider extends ServiceProvider {

    public function register() {
        $this->mergeConfigFrom( __DIR__ . '/../config/platform.php', 'platform' );
        \View::addNamespace('c4form', app_path().'/Components/C4Form/Views');

        $this->registerProviders();
        $this->registerAliases();

        $this->app['assetsHelper'] = $this->app->share(function($app) {
            return new AssetsHelper($app['files']);
        });

        $this->app['c4form'] = $this->app->share(function($app){
            return new C4Form();
        });

        $this->app->singleton('platform', function($app) {

            $user = $app->make('sentinel')->getUser();
            //dd($user);

            return new Platform($user, $app->make('request'));
        });


    }

    public function boot() {
        $this->publishes([ __DIR__ . '/../migrations' => base_path('database/migrations')], 'migrations');
        $this->publishes([ __DIR__ . '/../config/permissions.php' => base_path('config/permissions.php')], 'config');
        $this->publishes([ __DIR__ . '/../config/platform.php' => base_path('config/platform.php')], 'config');
        $this->publishes([ __DIR__ . '/../config/menu-main.yaml' => base_path('config/menu-main.yaml')], 'config');
        $this->publishes([ __DIR__ . '/../config/menu-profile.yaml' => base_path('config/menu-profile.yaml')], 'config');
        $this->publishes([ __DIR__ . '/../config/cartalyst.sentinel.php' => base_path('config/cartalyst.sentinel.php')], 'config');
        $this->publishes([ __DIR__ . '/../assets' => public_path('platform')], 'public');

        //Platform routing
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/routes.php';
        }

        //Platform views
        $this->loadViewsFrom(__DIR__.'/../views', 'platform');

        //Init components
        $this->initComponents();

        //\Notifications::make();
    }

    public function terminate() {

    }

    private function initComponents() {
        \Menu::init();
    }

    private function registerProviders() {
        $this->app->register(\Cartalyst\Sentinel\Laravel\SentinelServiceProvider::class);
        $this->app->register(\Collective\Html\HtmlServiceProvider::class);
        $this->app->register(\Code4\Menu\MenuServiceProvider::class);
        $this->app->register(\Cartalyst\Alerts\Laravel\AlertsServiceProvider::class);
        $this->app->register(\Thomaswelton\LaravelGravatar\LaravelGravatarServiceProvider::class);
        $this->app->register(\Code4\Settings\SettingsServiceProvider::class);
        $this->app->register(\Code4\Notifications\NotificationsServiceProvider::class);
        $this->app->register(\Code4\DataTable\DataTableServiceProvider::class);
    }

    private function registerAliases() {
        $aliasLoader = AliasLoader::getInstance();
        $aliasLoader->alias('Assets', Facades\AssetsHelper::class);
        $aliasLoader->alias('Platform', Facades\Platform::class);
    }


}