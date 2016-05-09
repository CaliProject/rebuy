<?php

namespace Rebuy;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

    protected $fillable = [
        'post_id', 'user_id', 'body', 'origin'
    ];

    /**
     * Whose comment this is.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
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
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * Get the count of likes.
     * 
     * @return int
     */
    public function likesCount()
    {
        return $this->likes()->count();
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

    /**
     * Children comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(static::class, 'origin');
    }

    /**
     * Reply link to be prepended.
     *
     * @return string
     */
    public function replyLink()
    {
        return "<a class=\"at\" href=\"" . $this->author->profileLink() . "\">@" . $this->author->name ."</a>";
    }
}
