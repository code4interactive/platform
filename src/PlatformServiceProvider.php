<?php

namespace Code4\Platform;

use App\Components\C4Form\C4Form;
use Code4\Platform\Components\Response\PlatformResponse;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class PlatformServiceProvider extends ServiceProvider {

    public function register() {
        $this->mergeConfigFrom( __DIR__ . '/../config/platform.php', 'platform' );

        $this->registerProviders();
        $this->registerAliases();

        $this->app['c4form'] = $this->app->share(function($app){
            return new C4Form();
        });

        $this->app->bind('Code4\Platform\Contracts\Auth', 'Code4\Platform\Components\Auth\SentinelEngine');

        $this->app->singleton('platform', function($app) {
            $auth = $app->make('Code4\Platform\Contracts\Auth');
            return new Platform($auth, $app->make('request'), $app->make('redirect'), $app->make('Illuminate\Contracts\Routing\ResponseFactory'));
        });

        $this->app['platformResponse'] = $this->app->share(function($app){
            return new PlatformResponse($app->make('Illuminate\Contracts\Routing\ResponseFactory'));
        });
    }

    public function boot() {
        $this->publishes([ __DIR__ . '/../migrations' => base_path('database/migrations')], 'migrations');
        $this->publishes([
            __DIR__ . '/../config/permissions.php' => base_path('config/permissions.php'),
            __DIR__ . '/../config/platform.php' => base_path('config/platform.php'),
            __DIR__ . '/../config/menu-main.yaml' => base_path('config/menu-main.yaml'),
            __DIR__ . '/../config/menu-profile.yaml' => base_path('config/menu-profile.yaml'),
            __DIR__ . '/../config/cartalyst.sentinel.php' => base_path('config/cartalyst.sentinel.php'),
            __DIR__ . '/../config/c4view.php' => base_path('config/c4view.php')
        ], 'config');
        $this->publishes([ __DIR__ . '/../resources/assets' => public_path('platform')], 'public');

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
        $this->app->register(\Thomaswelton\LaravelGravatar\LaravelGravatarServiceProvider::class);
        $this->app->register(\Code4\View\ViewServiceProvider::class);
        $this->app->register(\Code4\Forms\FormsServiceProvider::class);
        $this->app->register(\Code4\Menu\MenuServiceProvider::class);
        $this->app->register(\Code4\Settings\SettingsServiceProvider::class);
        $this->app->register(\Code4\Notifications\NotificationsServiceProvider::class);
        $this->app->register(\Code4\DataTable\DataTableServiceProvider::class);
        $this->app->register(\Cmgmyr\Messenger\MessengerServiceProvider::class);
    }

    private function registerAliases() {
        $aliasLoader = AliasLoader::getInstance();
        $aliasLoader->alias('Platform', Facades\Platform::class);
        $aliasLoader->alias('Auth', Facades\Auth::class);
        $aliasLoader->alias('PlatformResponse', Facades\PlatformResponse::class);
    }

    public function provides() {
        return ['\Code4\Platform\Contracts\Auth'];
    }
}