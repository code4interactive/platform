<?php namespace Cartalyst\DataGrid\Tests;
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

use Mockery as m;
use Cartalyst\DataGrid\Environment;
use PHPUnit_Framework_TestCase;

class EnvironmentTest extends PHPUnit_Framework_TestCase {

	/**
	 * Close mockery.
	 *
	 * @return void
	 */
	public function tearDown()
	{
		m::close();
	}

	public function testFoo(){}

	// public function testRequestProviderIsAbleToBeOverridden()
	// {
	// 	$environment = new Environment($requestProvider = m::mock('Cartalyst\DataGrid\RequestProviders\ProviderInterface'));

	// 	$this->assertEquals($requestProvider, $environment->getRequestProvider());
	// 	$environment->setRequestProvider($requestProvider2 = m::mock('Cartalyst\DataGrid\RequestProviders\ProviderInterface'));
	// 	$this->assertEquals($requestProvider2, $environment->getRequestProvider());
	// 	$this->assertNotEquals($requestProvider, $environment->getRequestProvider());
	// }

	// public function testMakeSetsUpDataGridContext()
	// {
	// 	$environment = m::mock('Cartalyst\DataGrid\Environment[createDataGrid]');
	// 	$environment->shouldReceive('createDataGrid')->once()->with('query', array('foo'))->andReturn($dataGrid = m::mock('Cartalyst\DataGrid\DataGrid'));

	// 	$dataGrid->shouldReceive('setupDataGridContext')->once()->andReturn($dataGrid);

	// 	$this->assertEquals($dataGrid, $environment->make('query', array('foo')));
	// }

}
