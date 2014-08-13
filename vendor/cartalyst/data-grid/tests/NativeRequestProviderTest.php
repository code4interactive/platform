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
use Cartalyst\DataGrid\RequestProviders\NativeProvider as Provider;
use PHPUnit_Framework_TestCase;

class NativeRequestProviderTest extends PHPUnit_Framework_TestCase {

	/**
	 * Close mockery.
	 *
	 * @return void
	 */
	public function tearDown()
	{
		m::close();
	}

	public function testGettingFilters()
	{
		$provider = new Provider;
		$this->assertEquals(array(), $provider->getFilters());
		$_GET['filters'] = $filters = array('foo', array('bar' => 'baz'));
		$this->assertEquals($filters, $provider->getFilters());
	}

	public function testGettingSort()
	{
		$provider = new Provider;
		$this->assertNull($provider->getSort());
		$_GET['sort'] = $sort = 'foo';
		$this->assertEquals($sort, $provider->getSort());
	}

	public function testGettingDirection()
	{
		$provider = new Provider;
		$this->assertEquals('asc', $provider->getDirection());
		$_GET['direction'] = $direction = 'desc';
		$this->assertEquals($direction, $provider->getDirection());
		$_GET['direction'] = 'foo';
		$this->assertEquals('asc', $provider->getDirection());
	}

	public function testGettingPage()
	{
		$provider = new Provider;
		$this->assertSame(1, $provider->getPage());
		$_GET['page'] = '4';
		$this->assertSame(4, $provider->getPage());
		$_GET['page'] = '0';
		$this->assertSame(1, $provider->getPage());
		$_GET['page'] = '-1';
		$this->assertSame(1, $provider->getPage());
	}

	public function testGettingDividend()
	{
		$provider = new Provider;
		$this->assertSame(10, $provider->getDividend());
		$_GET['dividend'] = '4';
		$this->assertSame(4, $provider->getDividend());
		$_GET['dividend'] = '0';
		$this->assertSame(10, $provider->getDividend());
		$_GET['dividend'] = '-1';
		$this->assertSame(10, $provider->getDividend());
	}

	public function testGettingThreshold()
	{
		$provider = new Provider;
		$this->assertSame(100, $provider->getThreshold());
		$_GET['threshold'] = '4';
		$this->assertSame(4, $provider->getThreshold());
		$_GET['threshold'] = '0';
		$this->assertSame(100, $provider->getThreshold());
		$_GET['threshold'] = '-1';
		$this->assertSame(100, $provider->getThreshold());
	}

	public function testGettingThrottle()
	{
		$provider = new Provider;
		$this->assertSame(100, $provider->getThrottle());
		$_GET['throttle'] = '4';
		$this->assertSame(4, $provider->getThrottle());
		$_GET['throttle'] = '0';
		$this->assertSame(100, $provider->getThrottle());
		$_GET['throttle'] = '-1';
		$this->assertSame(100, $provider->getThrottle());
	}

}
