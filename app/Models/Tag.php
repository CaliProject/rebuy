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

    /**
     * Get the url of the tag.
     * 
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function link()
    {
        return url("tag/" . str_replace(' ', '+', $this->name));
    }
}
