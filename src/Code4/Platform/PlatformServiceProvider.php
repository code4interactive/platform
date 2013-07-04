<?php namespace Code4\Platform;

use Illuminate\Support\ServiceProvider;

class PlatformServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('code4/platform');
        include __DIR__.'/../../routes.php';
        include __DIR__.'/../../config/icons.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app['platform'] = $this->app->share(function($app)
        {
            return new Platform;
        });

        $this->app['menu'] = $this->app->share(function($app)
        {
            return new Menu;
        });

        $this->app['platform']->registerDependentPackages();
        $this->app['platform']->addPackageAliases();
        $this->app['platform']->collectViewData();

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
        return array('platform');
	}

}