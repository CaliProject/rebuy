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
     * Get the user's media.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function media()
    {
        return $this->hasMany(Media::class);
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
}
