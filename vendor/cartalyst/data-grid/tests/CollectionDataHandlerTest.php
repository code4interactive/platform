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
use ArrayableStub;
use Cartalyst\DataGrid\DataHandlers\CollectionHandler as Handler;
use PHPUnit_Framework_TestCase;
use stdClass;

class CollectionDataHandlerTest extends PHPUnit_Framework_TestCase {

	/**
	 * Setup resources and dependencies.
	 *
	 * @return void
	 */
	public static function setUpBeforeClass()
	{
		require_once __DIR__.'/stubs/ArrayableStub.php';
	}

	/**
	 * Close mockery.
	 *
	 * @return void
	 */
	public function tearDown()
	{
		m::close();
	}

	public function testDataIsTransformed()
	{
		$handler = new Handler($dataGrid = $this->getMockDataGrid());

		$this->assertCount(count($expected = $this->getValidatedData()), $data = $handler->getData());

		foreach ($expected as $index => $item)
		{
			$this->assertEquals($item, $data[$index]);
		}
	}

	public function testTotalCount()
	{
		$handler = new Handler($dataGrid = $this->getMockDataGrid());
		$handler->prepareTotalCount();

		$this->assertSame(count($dataGrid->getData()), $handler->getTotalCount());
	}

	public function testPreparingSelect()
	{
		$handler = new Handler($dataGrid = $this->getMockDataGrid());
		$handler->prepareSelect();

		$expected = array_map(function($item)
		{
			unset($item['last_name']);
			$item['sex'] = $item['gender'];
			unset($item['gender']);
			return $item;
		}, $this->getValidatedData());

		$this->assertEquals($expected, $handler->getData()->all());
	}

	public function testColumnFilters()
	{
		$handler = new Handler($dataGrid = $this->getMockDataGrid());

		$dataGrid->getEnvironment()->getRequestProvider()->shouldReceive('getFilters')->once()->andReturn(array(
			array('first_name' => 'B'),
			array('sex'        => 'male'),
		));

		$handler->prepareFilters();

		$expected = $this->getValidatedData();
		$this->assertCount(2, $data = $handler->getData());
		$this->assertEquals(array($expected[0], $expected[2]), array_values($data->all()));
	}

	public function testGlobalFilters()
	{
		$handler = new Handler($dataGrid = $this->getMockDataGrid());

		$dataGrid->getEnvironment()->getRequestProvider()->shouldReceive('getFilters')->once()->andReturn(array('me'));

		$handler->prepareFilters();

		$expected = $this->getValidatedData();
		$this->assertCount(2, $data = $handler->getData());
		$this->assertEquals(array($expected[1], $expected[4]), array_values($data->all()));
	}

	public function testPrepareSortAscending()
	{
		$handler = new Handler($dataGrid = $this->getMockDataGrid());

		$dataGrid->getEnvironment()->getRequestProvider()->shouldReceive('getSort')->once()->andReturn('first_name');
		$dataGrid->getEnvironment()->getRequestProvider()->shouldReceive('getDirection')->once()->andReturn('asc');

		$handler->prepareSort();

		$expected = $this->getValidatedData();
		$this->assertCount(count($expected), $data = $handler->getData());
		$ordered = array(0, 2, 4, 1, 3, 5);

		foreach (array_values($data->all()) as $index => $item)
		{
			$this->assertEquals($expected[$ordered[$index]], $item);
		}
	}

	public function testPrepareSortDescending()
	{
		$handler = new Handler($dataGrid = $this->getMockDataGrid());

		$dataGrid->getEnvironment()->getRequestProvider()->shouldReceive('getSort')->once()->andReturn('first_name');
		$dataGrid->getEnvironment()->getRequestProvider()->shouldReceive('getDirection')->once()->andReturn('desc');

		$handler->prepareSort();

		$expected = $this->getValidatedData();
		$this->assertCount(count($expected), $data = $handler->getData());
		$ordered = array(5, 3, 1, 4, 2, 0);

		foreach (array_values($data->all()) as $index => $item)
		{
			$this->assertEquals($expected[$ordered[$index]], $item);
		}
	}

	public function testPrepareSortWithAlias()
	{
		$handler = new Handler($dataGrid = $this->getMockDataGrid());

		$dataGrid->getEnvironment()->getRequestProvider()->shouldReceive('getSort')->once()->andReturn('sex');
		$dataGrid->getEnvironment()->getRequestProvider()->shouldReceive('getDirection')->once()->andReturn('desc');

		$handler->prepareSort();

		$expected = $this->getValidatedData();
		$this->assertCount(count($expected), $data = $handler->getData());
		$ordered = array(3, 0, 2, 1, 5, 4);

		foreach (array_values($data->all()) as $index => $item)
		{
			$this->assertEquals($expected[$ordered[$index]], $item);
		}
	}

	public function testPrepareSortNaturally()
	{
		$handler = new Handler($dataGrid = $this->getMockDataGrid());

		$dataGrid->getEnvironment()->getRequestProvider()->shouldReceive('getSort')->once()->andReturn('sortable');
		$dataGrid->getEnvironment()->getRequestProvider()->shouldReceive('getDirection')->once()->andReturn('asc');

		$handler->prepareSort();

		$expected = $this->getValidatedData();
		$this->assertCount(count($expected), $data = $handler->getData());
		$ordered = array(0, 5, 1, 4, 2, 3);

		foreach (array_values($data->all()) as $index => $item)
		{
			$this->assertEquals($expected[$ordered[$index]], $item);
		}
	}

	/**
	 * @expectedException RuntimeException
	 */
	public function testPrepareSortWhereColumnDoesntExist()
	{
		$handler = new Handler($dataGrid = $this->getMockDataGrid());

		$dataGrid->getEnvironment()->getRequestProvider()->shouldReceive('getSort')->once()->andReturn('invalid');

		$handler->prepareSort();
	}

	public function testPreparePagination()
	{
		$handler = m::mock('Cartalyst\DataGrid\DataHandlers\CollectionHandler[calculatePagination]');
		$handler->__construct($dataGrid = $this->getMockDataGrid());

		$request = $dataGrid->getEnvironment()->getRequestProvider();

		// Just need these here even though we're mocking the method
		$request->shouldReceive('getDividend')->once()->andReturn(10);
		$request->shouldReceive('getThreshold')->once()->andReturn(100);
		$request->shouldReceive('getThrottle')->once()->andReturn(100);

		$handler->shouldReceive('calculatePagination')->once()->andReturn(array(3, 2));
		$dataGrid->getEnvironment()->getRequestProvider()->shouldReceive('getPage')->once()->andReturn(2);

		$handler->setFilteredCount(6);
		$handler->preparePagination();

		$expected = $this->getValidatedData();

		$this->assertCount(2, $data = $handler->getData());
		$this->assertEquals($expected[2], $data[0]);
		$this->assertEquals($expected[3], $data[1]);
	}

	protected function getMockDataGrid()
	{
		$dataGrid = m::mock('Cartalyst\DataGrid\DataGrid');
		$dataGrid->shouldReceive('getData')->andReturn($this->getData());
		$dataGrid->shouldReceive('getEnvironment')->andReturn($environment = m::mock('Cartalyst\DataGrid\Environment'));
		$environment->shouldReceive('getRequestProvider')->andReturn(m::mock('Cartalyst\DataGrid\RequestProviders\ProviderInterface'));
		$dataGrid->shouldReceive('getColumns')->andReturn(array(
			'first_name',
			'gender' => 'sex',
			'sortable',
		));
		return $dataGrid;
	}

	protected function getData()
	{
		$object1 = new StdClass;
		$object1->first_name = 'Ben';
		$object1->last_name  = 'Corlett';
		$object1->gender     = 'male';
		$object1->sortable   = 'foo-1';

		return array(
			$object1,
			new ArrayableStub,
			array(
				'first_name' => 'Bruno',
				'last_name'  => 'Gaspar',
				'gender'     => 'male',
				'sortable'   => 'foo-100',
			),
			array(
				'first_name' => 'Jared',
				'last_name'  => 'West',
				'gender'     => 'male',
				'sortable'   => 'foo-101',
			),
			array(
				'first_name' => 'Clarissa',
				'last_name'  => 'Syme',
				'gender'     => 'female',
				'sortable'   => 'foo-20',
			),
			array(
				'first_name' => 'Jessica',
				'last_name'  => 'Hick',
				'gender'     => 'female',
				'sortable'   => 'foo-3',
			),
		);
	}

	public function getValidatedData()
	{
		return array(
			array(
				'first_name' => 'Ben',
				'last_name'  => 'Corlett',
				'gender'     => 'male',
				'sortable'   => 'foo-1',
			),
			array(
				'first_name' => 'Dan',
				'last_name'  => 'Syme',
				'gender'     => 'male',
				'sortable'   => 'foo-13',
			),
			array(
				'first_name' => 'Bruno',
				'last_name'  => 'Gaspar',
				'gender'     => 'male',
				'sortable'   => 'foo-100',
			),
			array(
				'first_name' => 'Jared',
				'last_name'  => 'West',
				'gender'     => 'male',
				'sortable'   => 'foo-101',
			),
			array(
				'first_name' => 'Clarissa',
				'last_name'  => 'Syme',
				'gender'     => 'female',
				'sortable'   => 'foo-20',
			),
			array(
				'first_name' => 'Jessica',
				'last_name'  => 'Hick',
				'gender'     => 'female',
				'sortable'   => 'foo-3',
			),
		);
	}

}
