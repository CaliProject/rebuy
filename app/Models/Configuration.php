<?php

namespace Rebuy;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model {

    protected $fillable = ['key', 'value'];
}
