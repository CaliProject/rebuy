<?php

namespace Rebuy;

use Rebuy\Library\Traits\TimeSortable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use TimeSortable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tel', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Users per page.
     * 
     * @var int
     */
    protected $perPage = 30;

    /**
     * Determine if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Get the user's posts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get the user's likes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Get the user's comments.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the user's media.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function media()
    {
        return $this->hasMany(Media::class);
    }

    /**
     * Get the user's products.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the user's avatar.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function avatar()
    {
        return $this->hasOne(Avatar::class);
    }

    /**
     * Get the user's avatar url.
     * 
     * @return string
     */
    public function avatarUrl()
    {
        if (! $this->avatar) {
            return Avatar::defaultUrl();
        }
        
        return url("uploads/avatars/{$this->id}/{$this->avatar->path}?v={$this->avatar->version}");
    }

    /**
     * Get the avatar version.
     * 
     * @return int
     */
    public function avatarVersion()
    {
        return $this->avatar ? $this->avatar->version : 0;
    }

    /**
     * User uploads an avatar.
     * 
     * @param $path
     * @return \Illuminate\Database\Eloquent\Model|int
     */
    public function uploadsAvatar($path)
    {
        $attr = ['path' => $path, 'version' => $this->avatarVersion() + 1];
        
        return $this->avatar ? $this->avatar()->update($attr) : $this->avatar()->create($attr); 
    }

    /**
     * Get the user's profile link.
     * 
     * @return mixed
     */
    public function profileLink()
    {
        return url("@{$this->name}");
    }

    /**
     * User's liked comments.
     * 
     * @return mixed
     */
    public function likedComments()
    {
        return $this->likes()->where('likeable_type', Comment::class)->get(['likeable_id']);
    }

    /**
     * If the user has liked the given comment.
     * 
     * @param Comment $comment
     * @return bool
     */
    public function likedComment(Comment $comment)
    {
        return in_array($comment->id, array_flatten($this->likedComments()->toArray()));
    }

    /**
     * User's liked posts.
     *
     * @return mixed
     */
    public function likedPosts()
    {
        return $this->likes()->where('likeable_type', Post::class)->get(['likeable_id']);
    }

    /**
     * If the user has liked the given post.
     * 
     * @param Post $post
     * @return bool
     */
    public function likedPost(Post $post)
    {
        return in_array($post->id, array_flatten($this->likedPosts()->toArray()));
    }

    /**
     * Like a post.
     *
     * @param Post $post
     */
    public function likePost(Post $post)
    {
        $post->likes()->create(['user_id' => $this->id]);
    }

    /**
     * Get the user by his/hers name.
     * 
     * @param $name
     * @return mixed
     */
    public static function getUserByName($name)
    {
        return static::where('name', str_replace('%20', ' ', $name))->first();
    }
}