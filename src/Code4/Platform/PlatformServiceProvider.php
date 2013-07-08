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

        $this->app['platform']->collectViewData();
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

        include __DIR__.'/Helpers/helpers.php';

        $this->app['platform'] = $this->app->share(function($app)
        {
            return new Platform;
        });

        $this->app['platform']->registerDependentPackages();
        $this->app['platform']->addPackageAliases();

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