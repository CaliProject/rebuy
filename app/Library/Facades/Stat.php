<?php

namespace Rebuy\Library\Facades;

use Illuminate\Support\Facades\Facade;

class Stat extends Facade {

    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return \Rebuy\Stat::class;
    }
}