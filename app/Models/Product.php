<?php

namespace Rebuy;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    /**
     * Get the user object.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
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
}
