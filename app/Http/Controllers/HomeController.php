<?php

namespace Rebuy\Http\Controllers;

use Rebuy\Media;
use Rebuy\Post;
use Rebuy\Http\Requests;
use Illuminate\Http\Request;
use Rebuy\Library\Traits\APIResponse;

class HomeController extends Controller {

    use APIResponse;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'uploadPicture']);
    }

    /**
     * Show the application welcome page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    public function showPost(Post $post)
    {
        return $post;
    }

    /**
     * Upload handler.
     *
     * @param Request $request
     * @return array
     */
    public function uploadPicture(Request $request)
    {
        $file = $request->file('image');
        $path = sha1(time() . str_random() . $file->getFilename()) . '.' . $file->getClientOriginalExtension();
        $file->move('uploads', $path);

        $request->user()->media()->create(compact('path'));

        return $this->successResponse([
            'url' => url('uploads/' . $path)
        ]);
    }
}
