<?php

namespace Setting\Facades;

use Illuminate\Support\Facades\Facade;

class Group extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'setting.group';
    }
}
