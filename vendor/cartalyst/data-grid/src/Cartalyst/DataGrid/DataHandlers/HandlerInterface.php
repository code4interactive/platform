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

interface HandlerInterface {

	/**
	 * Create a new data source.
	 *
	 * @param  Cartalyst\DataGrid\DataGrid  $dataGrid
	 * @return void
	 */
	public function __construct(DataGrid $dataGrid);

	/**
	 * Sets up the data source context.
	 *
	 * @return Cartalyst\DataGrid\Handler\HandlerInterface
	 */
	public function setupDataHandlerContext();

	/**
	 * Get the total (unfiltered) count
	 * of results.
	 *
	 * @return int
	 */
	public function getTotalCount();

	/**
	 * Get the filtered count of results.
	 *
	 * @return int
	 */
	public function getFilteredCount();

	/**
	 * Get the current page we are on.
	 *
	 * @return int
	 */
	public function getPage();

	/**
	 * Get the number of pages.
	 *
	 * @return int
	 */
	public function getPagesCount();

	/**
	 * Get the previous page.
	 *
	 * @return int|null
	 */
	public function getPreviousPage();

	/**
	 * Get the next page.
	 *
	 * @return int|null
	 */
	public function getNextPage();

	/**
	 * Get the results.
	 *
	 * @return int
	 */
	public function getResults();

}
