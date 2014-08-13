<?php namespace Cartalyst\DataGrid\DataHandlers;
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

use Cartalyst\DataGrid\DataGrid;

abstract class BaseHandler implements HandlerInterface {

	/**
	 * The shared data grid instance.
	 *
	 * @var Cartalyst\DataGrid\DataGrid
	 */
	protected $dataGrid;

	/**
	 * The data we use.
	 *
	 * @var mixed
	 */
	protected $data;

	/**
	 * The request provider.
	 *
	 * @var Cartalyst\DataGrid\RequestProviders\ProviderInterface
	 */
	protected $request;

	/**
	 * Cached total (unfiltered) count of results.
	 *
	 * @var int
	 */
	protected $totalCount = 0;

	/**
	 * Cached filtered count of results.
	 *
	 * @var int
	 */
	protected $filteredCount = 0;

	/**
	 * Cached current page.
	 *
	 * @var int
	 */
	protected $page = 1;

	/**
	 * Cached number of pages.
	 *
	 * @var int
	 */
	protected $pagesCount = 1;

	/**
	 * Cached previous page.
	 *
	 * @var int|null
	 */
	protected $previousPage;

	/**
	 * Cached next page.
	 *
	 * @var int|null
	 */
	protected $nextPage;

	/**
	 * Cached number of results per page.
	 *
	 * @var int|null
	 */
	protected $perPage;

	/**
	 * Cached results.
	 *
	 * @var array
	 */
	protected $results = array();

	/**
	 * Create a new data handler.
	 *
	 * @param  Cartalyst\DataGrid\DataGrid  $dataGrid
	 * @return void
	 */
	public function __construct(DataGrid $dataGrid)
	{
		$this->dataGrid = $dataGrid;
		$this->data     = $this->validateData($dataGrid->getData());
		$this->request  = $this->dataGrid->getEnvironment()->getRequestProvider();
	}

	/**
	 * Sets up the data source context.
	 *
	 * @return Cartalyst\DataGrid\Handler\HandlerInterface
	 */
	public function setupDataHandlerContext()
	{
		// Before we apply any filters, we need to setup the total count.
		$this->prepareTotalCount();

		// We'll now setup what columns we will select
		$this->prepareSelect();

		// Apply all the filters requested
		$this->prepareFilters();

		// Setup the requested sorting
		$this->prepareSort();

		// Setup filtered count
		$this->prepareFilteredCount();

		// And we'll setup pagination, pagination
		// is rather unique in the data grid.
		$this->preparePagination();

		// Hydrate our results
		$this->hydrate();

		return $this;
	}

	/**
	 * Get the total (unfiltered) count
	 * of results.
	 *
	 * @return int
	 */
	public function getTotalCount()
	{
		return $this->totalCount;
	}

	/**
	 * Get the filtered count of results.
	 *
	 * @return int
	 */
	public function getFilteredCount()
	{
		return $this->filteredCount;
	}

	/**
	 * Get the current page we are on.
	 *
	 * @return int
	 */
	public function getPage()
	{
		return $this->page;
	}

	/**
	 * Get the number of pages.
	 *
	 * @return int
	 */
	public function getPagesCount()
	{
		return $this->pagesCount;
	}

	/**
	 * Get the previous page.
	 *
	 * @return int|null
	 */
	public function getPreviousPage()
	{
		return $this->previousPage;
	}

	/**
	 * Get the next page.
	 *
	 * @return int|null
	 */
	public function getNextPage()
	{
		return $this->nextPage;
	}

	/**
	 * Get the number of results per page
	 *
	 * @return int|null
	 */
	public function getPerPage()
	{
		return $this->perPage;
	}

	/**
	 * Get the results.
	 *
	 * @return int
	 */
	public function getResults()
	{
		return $this->results;
	}

	/**
	 * Validate the data store.
	 *
	 * @param  mixed  $data
	 * @return mixed  $data
	 * @throws Exception
	 */
	abstract public function validateData($data);

	/**
	 * Prepares the total count of results before
	 * we apply filters.
	 *
	 * @return void
	 */
	abstract public function prepareTotalCount();

	/**
	 * Prepares the "select" component of the statement
	 * based on the columns array provided.
	 *
	 * @return void
	 */
	abstract public function prepareSelect();

	/**
	 * Loops through all filters provided in the data
	 * and manipulates the data.
	 *
	 * @return void
	 */
	abstract public function prepareFilters();

	/**
	 * Sets up the filtered results count (before pagination).
	 *
	 * @return void
	 */
	abstract public function prepareFilteredCount();

	/**
	 * Sets up the sorting for the data.
	 *
	 * @return void
	 */
	abstract public function prepareSort();

	/**
	 * Sets up pagination for the data grid. Our pagination
	 * is special, see calculatePerPage() for more information.
	 *
	 * @return void
	 */
	abstract public function preparePagination();

	/**
	 * Hydrates the results.
	 *
	 * @return void
	 */
	abstract public function hydrate();

	/**
	 * Calculates sort from the request.
	 *
	 * @param  string  $column
	 * @param  string  $direction
	 * @return array
	 */
	public function calculateSortColumn($column = null)
	{
		if ( ! $column)
		{
			$columns = $this->dataGrid->getColumns();
			$column = reset($columns);
		}

		$key = array_search($column, $this->dataGrid->getColumns());

		// If the sort column doesn't exist in the array, something has
		// gone wrong. Failing silently could confuse people.
		if ($key === false)
		{
			throw new \RuntimeException("Sort column [$column] does not exist in data.");
		}

		// If our column is an alias, we'll use the actual value instead of the
		// alias for sorting.
		if ( ! is_numeric($key))
		{
			$column = $key;
		}

		return $column;
	}

	/**
	 * Calculates the pagination for the data grid. We'll try
	 * divide calculate the results per page by dividing the
	 * results count by the requested dividend. If that
	 * result is outside the threshold and the throttle,
	 * we'll adjust it to sit inside the threshold and
	 * throttle. It's rather intelligent.
	 *
	 * We return an array with two values, the first one
	 * being the number of pages, the second one being
	 * the number of results per page.
	 *
	 * @param  int  $resultsCount
	 * @return array
	 */
	public function calculatePagination($resultsCount, $dividend, $threshold, $throttle)
	{
		if ($dividend < 1)
		{
			throw new \InvalidArgumentException("Invalid dividend of [$dividend], must be [1] or more.");
		}

		if ($threshold < 1)
		{
			throw new \InvalidArgumentException("Invalid threshold of [$threshold], must be [1] or more.");
		}

		if ($throttle < $threshold)
		{
			throw new \InvalidArgumentException("Invalid throttle of [$throttle], must be greater than the threshold, which is [$threshold].");
		}

		// If our results count is less than the threshold,
		// we're always returning one page with all of the items
		// on it. This will effectively remove pagination.
		if ($resultsCount < $threshold)
		{
			return array(1, $resultsCount);
		}

		// Firstly, we'll calculate the "per page" property
		// based off the dividend.
		$perPage = ceil($resultsCount / $dividend);

		// Now, we'll calculate the maximum per page, which is the throttle
		// divided by the dividend.
		$maximumPerPage = floor($throttle / $dividend);

		// Now, if the results per page is greater than the
		// maximum per page, reduce it down accordingly
		if ($perPage > $maximumPerPage)
		{
			$perPage = $maximumPerPage;
		}

		// To work out the number of pages, we'll just
		// divide the results count by the number of
		// results per page. Simple!
		$pagesCount = ceil($resultsCount / $perPage);

		return array((int) $pagesCount, (int) $perPage);
	}

	/**
	 * Calculates the page, common logic used in multiple handlers.
	 *
	 * Returns the current page, the previous page and the next page.
	 *
	 * @param  int  $resultsCount
	 * @param  int  $page
	 * @param  int  $perPage
	 * @return array
	 */
	public function calculatePages($resultsCount, $page, $perPage)
	{
		$previousPage = null;
		$nextPage     = null;

		// Now we will generate the previous and next page links
		if ($page > 1)
		{
			if ((($page - 1) * $perPage) <= $resultsCount)
			{
				$previousPage = $page - 1;
			}
			else
			{
				$previousPage = ceil($resultsCount / $perPage);
			}
		}
		if (($page * $perPage) < $resultsCount)
		{
			$nextPage = $page + 1;
		}

		return array($page, $previousPage, $nextPage);
	}

	/**
	 * Get the data source from the handler.
	 *
	 * @return mixed
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * Set the filtered count property. Used in testing
	 * mainly.
	 *
	 * @param  int  $filteredCount
	 * @return void
	 */
	public function setFilteredCount($filteredCount)
	{
		$this->filteredCount = $filteredCount;
	}

}
