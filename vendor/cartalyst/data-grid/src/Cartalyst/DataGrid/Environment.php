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
 * @version    1.0.0
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011 - 2013, Cartalyst LLC
 * @link       http://cartalyst.com
 */

use Cartalyst\DataGrid\RequestProviders\NativeProvider;
use Cartalyst\DataGrid\RequestProviders\ProviderInterface as RequestProviderInterface;
use Closure;
use Illuminate\Database\Eloquent\Builder as EloquentQueryBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Environment {

	/**
	 * The request instance.
	 *
	 * @var Symfony\Component\HttpFoundation\Request
	 */
	protected $requestProvider;

	/**
	 * Array of data source mappings for data types,
	 * where the key is the applicable class and the
	 * value is a closure which determines if the class
	 * is applicable for the data type.
	 *
	 * @var array
	 */
	protected $dataHandlerMappings = array();

	/**
	 * Create a new pagination environment.
	 *
	 * @param  Cartalyst\DataGrid\RequestProviders\ProviderInterface  $requestProvider
	 * @return void
	 */
	public function __construct(RequestProviderInterface $requestProvider = null, array $dataHandlerMappings = array())
	{
		$this->requestProvider = $requestProvider ?: new NativeProvider;
		$this->dataHandlerMappings = $dataHandlerMappings;
	}

	/**
	 * Show a new data grid instance.
	 *
	 * @param  mixed  $dataHandler
	 * @param  array  $columns
	 * @return Cartalyst\DataGrid\DataGrid
	 */
	public function make($dataHandler, array $columns)
	{
		return $this->createDataGrid($dataHandler, $columns)->setupDataGridContext();
	}

	/**
	 * Creates a new instance of the data grid.
	 *
	 * @param  mixed  $dataHandler
	 * @param  array  $columns
	 * @return Cartalyst\DataGrid\DataGrid
	 */
	public function createDataGrid($dataHandler, array $columns)
	{
		return new DataGrid($this, $dataHandler, $columns);
	}

	/**
	 * Get the active request instance.
	 *
	 * @return Cartalyst\DataGrid\RequestProviders\ProviderInterface
	 */
	public function getRequestProvider()
	{
		return $this->requestProvider;
	}

	/**
	 * Set the active request instance.
	 *
	 * @param  Cartalyst\DataGrid\RequestProviders\ProviderInterface  $requestProvider
	 * @return void
	 */
	public function setRequestProvider(RequestProviderInterface $requestProvider)
	{
		$this->requestProvider = $requestProvider;
	}

	/**
	 * Returns the data handler mappings.
	 *
	 * @return array
	 */
	public function getDataHandlerMappings()
	{
		return $this->dataHandlerMappings;
	}

	/**
	 * Adds a data handler mapping.
	 *
	 * @param  string   $class
	 * @param  Closure  $test
	 * @return void
	 */
	public function addDataHandlerMapping($class, Closure $test)
	{
		$this->dataHandlerMappings[$class] = $test;
	}

}
