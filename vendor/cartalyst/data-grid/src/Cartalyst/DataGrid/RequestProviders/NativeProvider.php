<?php namespace Cartalyst\DataGrid\RequestProviders;
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

class NativeProvider implements ProviderInterface {

	/**
	 * Get an array of filters. Filters which
	 * have a string for the key are treated as
	 * filters for an attribute whereas others
	 * are treated as global filters.
	 *
	 * @return array
	 */
	public function getFilters()
	{
		if ( ! isset($_GET['filters'])) return array();

		return $_GET['filters'];
	}

	/**
	 * Get the column by which we sort our
	 * datagrid.
	 *
	 * @return string
	 */
	public function getSort()
	{
		if ( ! isset($_GET['sort'])) return;

		return $_GET['sort'];
	}

	/**
	 * Get the direction which we apply
	 * sort.
	 *
	 * @return string
	 */
	public function getDirection()
	{
		if ( ! isset($_GET['direction'])) return 'asc';

		$direction = $_GET['direction'];

		return in_array($direction, array('asc', 'desc')) ? $direction : 'asc';
	}

	/**
	 * Get the page which we are on.
	 *
	 * @return int
	 */
	public function getPage()
	{
		if ( ! isset($_GET['page'])) return 1;

		$page = (int) $_GET['page'];

		return ($page > 0) ? $page : 1;
	}

	/**
	 * Get the dividend (ideal number of pages, once the results
	 * count is greater than the threshold and each page has
	 * less results than the throttle).
	 *
	 * @return int
	 */
	public function getDividend()
	{
		if ( ! isset($_GET['dividend'])) return 10;

		$dividend = (int) $_GET['dividend'];

		return ($dividend > 0) ? $dividend : 10;
	}

	/**
	 * Get the threshold (number of results before pagination begins).
	 *
	 * @return int
	 */
	public function getThreshold()
	{
		if ( ! isset($_GET['threshold'])) return 100;

		$threshold = (int) $_GET['threshold'];

		return ($threshold > 0) ? $threshold : 100;
	}

	/**
	 * Get the throttle, which is the maximum results set. If the
	 * results total is greater than this (before we apply the
	 * dividend, we'll reduce the results set).
	 *
	 * @return int
	 */
	public function getThrottle()
	{
		if ( ! isset($_GET['throttle'])) return 100;

		$throttle = (int) $_GET['throttle'];

		return ($throttle > 0) ? $throttle : 100;
	}

}
