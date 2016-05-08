<?php

namespace Rebuy;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    /**
     * Mass assignable attributes.
     * 
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Get tag by its name.
     * 
     * @param $name
     * @return mixed
     */
    public static function getByName($name)
    {
        return static::where('name', $name)->first();
    }
}
