<?php

namespace Rebuy;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    protected $fillable = [
        'title', 'body', 'video_src', 'type', 'sticky'
    ];

    /**
     * Items per page.
     * 
     * @var int
     */
    protected $perPage = 35;
    
    /**
     * Get the author object.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
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

    /**
     * Shortens the title.
     * 
     * @return mixed
     */
    public function shortTitle()
    {
        return str_limit($this->title, 30);
    }

    /**
     * Get the readable type representation.
     * 
     * @return string
     */
    public function readableType()
    {
        return $this->type == 0 ? '文章' : '视频';
    }

    /**
     * Get by the sticky first order.
     * 
     * @param $query
     * @return mixed
     */
    public function scopeStickyFirst($query)
    {
        return $query->orderBy('sticky', 'desc');
    }
}
