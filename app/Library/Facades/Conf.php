<?php

namespace Rebuy\Library\Facades;

use Illuminate\Support\Facades\Facade;

class Conf extends Facade {

    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return \Rebuy\Configuration::class;
    }
}