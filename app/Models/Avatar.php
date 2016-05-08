<?php

namespace Rebuy;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model {

    protected $fillable = [
        'path', 'version'
    ];

    /**
     * Get the default avatar url.
     * 
     * @return string
     */
    public static function defaultUrl()
    {
        return url("assets/images/default-avatar.png");
    }
}
