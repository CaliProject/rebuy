<?php

namespace Rebuy\Http\Controllers;

use Rebuy\Post;
use Illuminate\Http\Request;
use Rebuy\Library\Traits\APIResponse;
use Rebuy\Http\Requests\PostFormRequest;

class ManageController extends Controller {

    use APIResponse;
    
    /**
     * Show section index page.
     *
     * @param $section
     * @return mixed
     */
    public function index($section = null)
    {
        if (is_null($section))
            return view('manage.index');

        $view = "manage.{$section}.index";

        if (! view()->exists($view))
            abort(404);

        return view($view);
    }

    /**
     * Show edit page for posts.
     * 
     * @param Post $post
     * @return mixed
     */
    public function showEditPost(Post $post)
    {
        return view('manage.posts.edit', compact('post'));
    }

    /**
     * Updates a post.
     *
     * @param Post                    $post
     * @param PostFormRequest $request
     * @return array
     */
    public function updatePost(Post $post, PostFormRequest $request)
    {
        $post->update($request->only($post->getFillable()));
        
        return $this->successResponse();
    }

    /**
     * Deletes a post.
     * 
     * @param Post $post
     * @return array
     * @throws \Exception
     */
    public function deletePost(Post $post)
    {
        return $post->delete() ? $this->successResponse('删除成功') : $this->errorResponse('删除失败');
    }
}
