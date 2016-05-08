<?php

namespace Rebuy;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    protected $fillable = [
        'title', 'body', 'video_src', 'type', 'sticky', 'cover_id'
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
     * Tag polymorphism relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
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

    /**
     * Save tags relationships.
     *
     * @param array $tags
     * @return $this
     */
    public function saveTags(array $tags)
    {
        if (count($this->tags)) {
            $this->tags()->detach($this->tags()->lists('id')->toArray());
        }

        $this->attachTags($tags);

        return $this;
    }

    /**
     * Attach tags onto the post.
     *
     * @param array $tags
     */
    protected function attachTags(array $tags)
    {
        foreach (array_values($tags) as $tag) {
            if ($t = Tag::getByName($tag)) {
                $this->tags()->attach($t->id);
            } else {
                $this->tags()->create(['name' => $tag]);
            }
        }
    }

    /**
     * Get the link of the post.
     * 
     * @return mixed
     */
    public function link()
    {
        return url("posts/{$this->id}.html");
    }

    /**
     * Get the cover of the post.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    protected function cover()
    {
        return $this->belongsTo(Media::class, 'cover_id');
    }

    /**
     * Get the cover image url.
     * 
     * @return string
     */
    public function coverImage()
    {
        if (! $this->cover) {
            return Media::defaultCover();
        }
        
        return url("uploads/{$this->cover->path}");
    }

    /**
     * Get the banner posts.
     * 
     * @return mixed
     */
    public static function bannerPosts()
    {
        return static::latest()->where('sticky', 1)->take(5)->get();
    }
}
