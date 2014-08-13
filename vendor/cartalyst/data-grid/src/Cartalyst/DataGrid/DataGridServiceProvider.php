<?php namespace Cartalyst\DataGrid;
/**
 * Part of the Data Grid package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.  It is also available at
 * the following URL: http://www.opensource.org/licenses/BSD-3-Clause
 *
 * @package    Data Grid
 * @version    2.0.0
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011 - 2013, Cartalyst LLC
 * @link       http://cartalyst.com
 */

use Cartalyst\DataGrid\RequestProviders\IlluminateProvider;
use Illuminate\Support\ServiceProvider;

class DataGridServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->package('cartalyst/data-grid', 'cartalyst/data-grid');

		$this->registerIlluminateRequestProvider();

		$this->registerDataGrid();
	}

	protected function registerIlluminateRequestProvider()
	{
		$this->app['datagrid.request'] = $this->app->share(function($app)
		{
			$dividend  = $app['config']['cartalyst/data-grid::dividend'];
			$threshold = $app['config']['cartalyst/data-grid::threshold'];
			$throttle  = $app['config']['cartalyst/data-grid::throttle'];
			$direction = $app['config']['cartalyst/data-grid::direction'];

			$requestProvider = new IlluminateProvider($app['request']);
			$requestProvider->setDefaultDividend($dividend);
			$requestProvider->setDefaultThreshold($threshold);
			$requestProvider->setDefaultThrottle($throttle);
			$requestProvider->setDefaultDirection($direction);

			return $requestProvider;
		});
	}

	protected function registerDataGrid()
	{
		$this->app['datagrid'] = $this->app->share(function($app)
		{
			$dataHandlerMappings = $app['config']['cartalyst/data-grid::handlers'];

			return new Environment($app['datagrid.request'], $dataHandlerMappings);
		});
	}

}
