<?php

namespace Code4\Platform\Facades;

use Illuminate\Support\Facades\Facade;

class Auth extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Code4\Platform\Contracts\Auth';
    }
}
