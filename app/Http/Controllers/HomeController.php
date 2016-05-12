<?php

namespace Rebuy\Http\Controllers;

use Rebuy\Media;
use Rebuy\Post;
use Rebuy\Http\Requests;
use Illuminate\Http\Request;
use Rebuy\Library\Traits\APIResponse;
use Rebuy\Product;
use Rebuy\Tag;

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

    /**
     * Upload handler.
     *
     * @param Request $request
     * @return array
     */
    public function uploadPicture(Request $request)
    {
        $path = Media::upload($request);

        $request->user()->media()->create(compact('path'));

        return $this->successResponse([
            'url' => url('uploads/' . $path)
        ]);
    }

    /**
     * Avatar upload handler.
     * 
     * @param Request $request
     * @return array
     */
    public function uploadAvatar(Request $request)
    {
        $path = Media::upload($request, 'avatars', false);

        $request->user()->uploadsAvatar($path);
        
        return $this->successResponse('头像已更新', 'profile');
    }

    /**
     * Search for a keyword.
     * 
     * @param $keyword
     * @return mixed
     */
    public function search($keyword)
    {
        $posts = Post::search($keyword);
        $products = Product::search($keyword);
        
        return view('search', compact('keyword', 'posts', 'products'));
    }

    /**
     * Show view for a tag.
     * 
     * @param $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showTag($tag)
    {
        $tag = Tag::getByName($tag);
        
        return view('tags.show', compact('tag'));
    }
}
