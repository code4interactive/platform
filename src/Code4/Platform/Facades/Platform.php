<?php namespace Code4\Platform\Facades;

use Illuminate\Support\Facades\Facade;

class Platform extends Facade
{
    /**
     * Get the registered component.
     *
     * @return object
     */
    protected static function getFacadeAccessor()
    {
        return 'platform';
    }
}