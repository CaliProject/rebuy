<?php

namespace Rebuy;

use File;
use Illuminate\Http\Request;
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
     * Uploads a file.
     *
     * @param Request $request
     * @param string  $prefix
     * @param bool    $encrypt
     * @return string
     */
    public static function upload(Request $request, $prefix = '', $encrypt = true)
    {
        $file = $request->file('image');
        $path = $encrypt ? 
            sha1(time() . str_random() . $file->getFilename()) . '.' . $file->getClientOriginalExtension() :
            str_singular($prefix) . '.' . $file->getClientOriginalExtension();
        $file->move('uploads/' . ($prefix === '' ? $prefix : ($prefix . '/' . $request->user()->id)), $path);

        return $path;
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

    /**
     * Get the default cover if not provided.
     *
     * @return mixed
     */
    public static function defaultCover()
    {
        return url('assets/images/default.jpg');
    }
}
