<?php

namespace Code4\Platform\Facades;

use Illuminate\Support\Facades\Facade;

class PlatformResponse extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'platformResponse';
    }
}
