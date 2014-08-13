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

use Cartalyst\DataGrid\DataHandlers\HandlerInterface as DataHandlerInterface;
use Illuminate\Support\Contracts\ArrayableInterface;
use Illuminate\Support\Contracts\JsonableInterface;

class DataGrid implements ArrayableInterface, JsonableInterface {

	/**
	 * The data grid environment.
	 *
	 * @var Cartalyst\DataGrid\Environment
	 */
	protected $env;

	/**
	 * The data object passed to the
	 * datagrid, used for manipulation
	 * and returning of results.
	 *
	 * @var mixed
	 */
	protected $data;

	/**
	 * The data source, responsible for returning
	 * appropriate information from the data provided.
	 *
	 * @var Cartalyst\DataGrid\DataHandler\HandlerInterface
	 */
	protected $dataHandler;

	/**
	 * Array of columns presented in the
	 * data-grid. The values of this array
	 * should match the properties (or indexes)
	 * of each result returned from the data.
	 *
	 * @var array
	 */
	protected $columns = array();

	/**
	 * Creates a new data grid object.
	 *
	 * @param  Cartalyst\DataGrid\Environment  $env
	 * @param  mixed  $data
	 * @param  array  $columns
	 * @return void
	 */
	public function __construct(Environment $env, $data, array $columns)
	{
		$this->env     = $env;
		$this->data    = $data;
		$this->columns = $columns;
	}

	/**
	 * Sets up the data grid context (with filters, ordering,
	 * searching etc).
	 *
	 * This method simply calls a bunch of other methods. The
	 * way SQL works means the order we call the methods in
	 * matters.
	 *
	 * @return Cartalyst\DataGrid\DataGrid
	 */
	public function setupDataGridContext()
	{
		$this->dataHandler = $this->createDataHandler();
		$this->dataHandler->setupDataHandlerContext();

		return $this;
	}

	/**
	 * Creates a data handler instance from the given data type by
	 * matching it to a mapping that's registered with the
	 * environment instance.
	 *
	 * @return Cartalyst\Datagrid\DataHandlers\HandlerInterface
	 */
	public function createDataHandler()
	{
		foreach ($this->env->getDataHandlerMappings() as $class => $test)
		{
			if ($test($this->data) === true)
			{
				// By calling the setter method we can be sure
				// the resolved class implements the correct
				// interface.
				$instance = new $class($this);
				$this->setDataHandler($instance);
				return $instance;
			}
		}

		$descriptor = gettype($this->data);
		if (is_object($this->data)) $descriptor = get_class($this->data);

		throw new \RuntimeException("Could not determine an appropriate data source for data of type [$descriptor].");
	}

	/**
	 * Return the environment use in the data grid.
	 *
	 * @return Cartalyst\DataGrid\Environment
	 */
	public function getEnvironment()
	{
		return $this->env;
	}

	/**
	 * Returns the data used in the data grid.
	 *
	 * @return mixed
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * Returns the columns associated with the data grid.
	 *
	 * @return array
	 */
	public function getColumns()
	{
		return $this->columns;
	}

	/**
	 * Returns the data handler.
	 *
	 * @return Cartalyst\DataGrid\DataHandlers\HandlerInterface
	 */
	public function getDataHandler()
	{
		return $this->dataHandler;
	}

	/**
	 * Sets the data handler.
	 *
	 * @param  Cartalyst\DataGrid\DataHandlers\HandlerInterface  $dataHandler
	 * @return void
	 */
	public function setDataHandler(DataHandlerInterface $dataHandler)
	{
		$this->dataHandler = $dataHandler;
	}

	/**
	 * Get the instance as an array.
	 *
	 * @return array
	 */
	public function toArray()
	{
		$handler = $this->dataHandler;

		return array(
			'total_count'    => $handler->getTotalCount(),
			'filtered_count' => $handler->getFilteredCount(),
			'page'           => $handler->getPage(),
			'pages_count'    => $handler->getPagesCount(),
			'previous_page'  => $handler->getPreviousPage(),
			'next_page'      => $handler->getNextPage(),
			'per_page'       => $handler->getPerPage(),
			'results'        => $handler->getResults(),
		);
	}

	/**
	 * Convert the object to its JSON representation.
	 *
	 * @param  int  $options
	 * @return string
	 */
	public function toJson($options = 0)
	{
		return json_encode($this->toArray(), $options);
	}

	/**
	 * Conver the data grid to its string representation.
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->toJson();
	}

}
