<?php

namespace Schmeits\PulseDatabaseTableSizes\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Schmeits\PulseDatabaseTableSizes\PulseDatabaseTableSizes
 */
class PulseDatabaseTableSizes extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Schmeits\PulseDatabaseTableSizes\PulseDatabaseTableSizes::class;
    }
}
