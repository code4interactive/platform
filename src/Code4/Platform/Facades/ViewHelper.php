<?php namespace Code4\Platform\Facades;

use Illuminate\Support\Facades\Facade;

class ViewHelper extends Facade
{
    /**
     * Get the registered component.
     *
     * @return object
     */
    protected static function getFacadeAccessor()
    {
        return 'viewhelper';
    }
}