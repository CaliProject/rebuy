<?php

namespace Rebuy;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $fillable = [
        'name', 'description', 'metas', 'inventory', 'price', 'cover_id'
    ];

    /**
     * Get the user object.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Search for a specific keyword.
     *
     * @param $keyword
     * @return mixed
     */
    public static function search($keyword)
    {
        return static::where('name', 'like', "%{$keyword}%")
            ->orWhere('description', 'like', "%{$keyword}%")
            ->latest()
            ->paginate();
    }

    /**
     * Get the short name.
     *
     * @return string
     */
    public function shortName()
    {
        return str_limit($this->name, 20);
    }

    /**
     * Get the product link.
     *
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function link()
    {
        return url("markets/products/{$this->id}.html");
    }

    /**
     * Get the inventory string.
     *
     * @return string
     */
    public function inventoryForView()
    {
        return number_format($this->inventory);
    }

    /**
     * Get the price string.
     *
     * @return string
     */
    public function priceForView()
    {
        return number_format($this->price);
    }

    /**
     * Get the tags.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
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
     * Save metas into database.
     *
     * @param array $keys
     * @param array $values
     */
    public function saveMetas(array $keys, array $values)
    {
        $metas = [];
        foreach ($keys as $i => $key) {
            $metas[$i] = [
                'key'   => $key,
                'value' => $values[$i]
            ];
        }

        $this->update(['metas' => json_encode($metas)]);
    }

    /**
     * Get the meta object.
     *
     * @return mixed
     */
    public function getMetaArray()
    {
        return is_null($this->metas) || $this->metas === '' ? [] : json_decode($this->metas);
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
     * Get the cover image.
     * 
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function coverImage()
    {
        if (! $this->cover) {
            return url("assets/logo.png");
        }

        return url("uploads/{$this->cover->path}");
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
     * Get the formatted views.
     *
     * @return mixed
     */
    public function formattedViews()
    {
        return number_format($this->viewsCount());
    }
}
