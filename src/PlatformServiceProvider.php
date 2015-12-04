<?php

namespace Code4\Platform;

use Carbon\Carbon;
use Code4\Platform\Components\Response\PlatformResponse;
use Code4\Platform\Components\Activity\Activity;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class PlatformServiceProvider extends ServiceProvider {

    public function register() {
        $this->mergeConfigFrom( __DIR__ . '/../config/platform.php', 'platform' );

        $this->registerProviders();
        $this->registerAliases();

        $this->app->bind('Code4\Platform\Contracts\Auth', 'Code4\Platform\Components\Auth\SentinelEngine');

        $this->app->singleton('platform', function($app) {
            $auth = $app->make('Code4\Platform\Contracts\Auth');
            return new Platform($auth, $app->make('config'), $app->make('request'), $app->make('redirect'), $app->make('Illuminate\Contracts\Routing\ResponseFactory'));
        });

        $this->app['activity'] = $this->app->share(function($app){
            return new Activity();
        });

        $this->app['platformResponse'] = $this->app->share(function($app){
            return new PlatformResponse($app->make('Illuminate\Contracts\Routing\ResponseFactory'), $app->make('request'));
        });

        $this->mergeConfigFrom(
            __DIR__ . '/../config/permissions.php', 'permissions'
        );

        $this->mergeConfigFrom(
            __DIR__ . '/../config/platform.php', 'platform'
        );

        $this->mergeConfigFrom(
            __DIR__ . '/../config/menu.php', 'menu'
        );

        $this->mergeConfigFrom(
            __DIR__ . '/../config/general.php', 'general'
        );

        $this->mergeConfigFrom(
            __DIR__ . '/../config/general_user.php', 'general_user'
        );
    }

    public function boot() {
        $this->publishes([ __DIR__ . '/../migrations' => base_path('database/migrations')], 'migrations');
        $this->publishes([ __DIR__ . '/../public' => public_path()], 'public');
        $this->publishes([ __DIR__ . '/../resources/stubs' => base_path('resources/stubs')], 'resources');
        $this->publishes([ __DIR__ . '/../src/Console/Commands' => base_path('app/Console/Commands')], 'commands');
        $this->publishes([
            __DIR__ . '/../config/permissions.php' => base_path('config/permissions.php'),
            __DIR__ . '/../config/platform.php' => base_path('config/platform.php'),
            __DIR__ . '/../config/general.php' => base_path('config/general.php'),
            __DIR__ . '/../config/general_user.php' => base_path('config/general_user.php'),
            __DIR__ . '/../config/general-settings.yaml' => base_path('config/general-settings.yaml'),
            __DIR__ . '/../config/general-settings-user.yaml' => base_path('config/general-settings-user.yaml'),
            __DIR__ . '/../config/menu.php' => base_path('config/menu.php'),
            __DIR__ . '/../config/menu-main.yaml' => base_path('config/menu-main.yaml'),
            __DIR__ . '/../config/menu-profile.yaml' => base_path('config/menu-profile.yaml'),
            __DIR__ . '/../config/cartalyst.sentinel.php' => base_path('config/cartalyst.sentinel.php'),
            __DIR__ . '/../config/c4view.php' => base_path('config/c4view.php')
        ], 'config');

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
        Carbon::setLocale('pl');
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
        $aliasLoader->alias('Activity', Facades\Activity::class);
        $aliasLoader->alias('Sentinel', \Cartalyst\Sentinel\Laravel\Facades\Sentinel::class);
        $aliasLoader->alias('Gravatar', \Thomaswelton\LaravelGravatar\Facades\Gravatar::class);
        $aliasLoader->alias('PlatformResponse', Facades\PlatformResponse::class);
    }

    public function provides() {
        return ['\Code4\Platform\Contracts\Auth'];
    }
}