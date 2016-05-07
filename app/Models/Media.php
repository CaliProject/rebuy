<?php

namespace Rebuy;

use File;
use Illuminate\Database\Eloquent\Model;

class Media extends Model {

    /**
     * Mass assignable attributes.
     * 
     * @var array
     */
    protected $fillable = ['path'];

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
     * Throw it into the trash can.
     * 
     * @return bool|null
     * @throws \Exception
     */
    public function trash()
    {
        File::delete('uploads/' . $this->path);
        
        return $this->delete();
    }
}
