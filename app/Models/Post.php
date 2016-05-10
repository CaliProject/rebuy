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
     * Get the comments count.
     *
     * @return mixed
     */
    public function commentsCount()
    {
        return $this->comments()->count();
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
     * Tag polymorphism relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * Get the views of the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function views()
    {
        return $this->morphMany(View::class, 'viewable');
    }

    /**
     * Get the views count.
     * 
     * @return mixed
     */
    public function viewsCount()
    {
        return $this->views()->count();
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

    /**
     * Get the previous post.
     * 
     * @return mixed
     */
    public function previous()
    {
        return static::where([
            ['created_at', '<', $this->created_at],
            ['id', '!=', $this->id]
        ])->first();
    }

    /**
     * Get the next post.
     * 
     * @return mixed
     */
    public function next()
    {
        return static::where([
            ['created_at', '>', $this->created_at],
            ['id', '!=', $this->id]
        ])->first();
    }

    /**
     * Get all the super comments.
     * 
     * @return mixed
     */
    public function superComments()
    {
        return $this->comments()->whereNull('origin')->orWhere('origin', 0);
    }

    /**
     * Get only the posts.
     * 
     * @param $query
     * @return mixed
     */
    public function scopePostsOnly($query)
    {
        return $query->where('type', 0);
    }

    /**
     * Get only the videos.
     * 
     * @param $query
     * @return mixed
     */
    public function scopeVideosOnly($query)
    {
        return $query->where('type', 1);
    }

    /**
     * Get the formatted views.
     * 
     * @return mixed
     */
    public function formattedViews()
    {
        return number_format($this->viewsCount());
    }

    /**
     * Search for a specific keyword.
     * 
     * @param $keyword
     * @return mixed
     */
    public static function search($keyword)
    {
        return static::where('title', 'like', "%{$keyword}%")
            ->orWhere('body', 'like', "%{$keyword}%")
            ->latest()
            ->paginate();
    }
}
