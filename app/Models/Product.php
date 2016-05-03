<?php

namespace Rebuy;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

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
