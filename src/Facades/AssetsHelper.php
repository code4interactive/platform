<?php

namespace Code4\Platform\Facades;

use Illuminate\Support\Facades\Facade;

class AssetsHelper extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'assetsHelper';
    }
}
