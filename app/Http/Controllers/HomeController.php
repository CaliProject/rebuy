<?php

namespace Rebuy\Http\Controllers;

use Rebuy\Http\Requests;
use Illuminate\Http\Request;
use Rebuy\Post;

class HomeController extends Controller {

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

    public function uploadPicture(Request $request)
    {
        
    }
}
