<?php

namespace Setting\Facades;

use Illuminate\Support\Facades\Facade;

class Package extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'setting';
    }
}
