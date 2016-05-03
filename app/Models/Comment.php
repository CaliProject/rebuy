<?php

namespace Rebuy;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

    /**
     * Whose comment this is.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Which post it belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
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

    /**
     * Get the parent comment.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|null
     */
    public function parent()
    {
        if ($this->hasParent())
            return $this->belongsTo(self::class, 'origin');
        
        return null;
    }

    /**
     * If this comment has a parent.
     * 
     * @return bool
     */
    public function hasParent()
    {
        return $this->origin !== null && $this->origin !== 0;
    }
}
