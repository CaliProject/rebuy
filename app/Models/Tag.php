<?php

namespace Rebuy;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    /**
     * Mass assignable attributes.
     * 
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Get tag by its name.
     * 
     * @param $name
     * @return mixed
     */
    public static function getByName($name)
    {
        return static::where('name', str_replace('+', ' ', str_replace('%20', ' ', $name)))->first();
    }

    /**
     * Get the url of the tag.
     * 
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function link($type = 'post')
    {
        return url("tag/{$type}/" . str_replace(' ', '+', $this->name));
    }

    /**
     * Get its posts.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }
    
    /**
     * Get its products.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function products()
    {
        return $this->morphedByMany(Product::class, 'taggable');
    }

    /**
     * Get all the tags associated with products.
     * 
     * @return \Illuminate\Support\Collection
     */
    public static function productsAssociated()
    {
        $records = \DB::table('taggables')->where('taggable_type', Product::class)->get();
        $models = collect();
        
        array_walk($records, function ($value, $key) use ($models) {
            $models->push(static::find($value->tag_id));
        });
        
        return $models;
    }

    /**
     * Get the paginated posts.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginatedPosts()
    {
        return $this->posts()->paginate(30);
    }

    /**
     * Get the paginated products.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginatedProducts()
    {
        return $this->products()->paginate(40);
    }
}
