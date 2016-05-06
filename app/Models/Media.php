<?php

namespace Rebuy;

use Illuminate\Database\Eloquent\Model;

class Media extends Model {

    /**
     * Mass assignable attributes.
     * 
     * @var array
     */
    protected $fillable = ['path'];

    /**
     * Get the user object.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
