<?php

use Illuminate\Support\Contracts\ArrayableInterface;

class ArrayableStub implements ArrayableInterface {

	public function toArray()
	{
		return array(
			'first_name' => 'Dan',
			'last_name'  => 'Syme',
			'gender'     => 'male',
			'sortable'   => 'foo-13',
		);
	}

}
