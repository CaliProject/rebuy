<?php

namespace Rebuy;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    /**
     * Get the author object.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all the comments collection.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * How many likes it has.
     *
     * @return int
     */
    public function likes()
    {
        return Like::count('type', self::class);
    }
}
