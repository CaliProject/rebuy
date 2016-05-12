<?php

namespace Rebuy;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

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
    public function inventory()
    {
        return number_format($this->inventory);
    }

    /**
     * Get the price string.
     *
     * @return string
     */
    public function price()
    {
        return number_format($this->price);
    }
}
