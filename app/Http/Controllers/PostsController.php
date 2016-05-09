<?php

namespace Rebuy\Http\Controllers;

use Rebuy\Post;
use Rebuy\Comment;
use Illuminate\Http\Request;
use Rebuy\Library\Traits\APIResponse;

class PostsController extends Controller {

    use APIResponse;

    protected $perPage = 30;

    /**
     * PostsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'loadMoreComments']]);
    }

    /**
     * Show the post.
     *
     * @param Post $post
     * @return mixed
     */
    public function show(Post $post)
    {
        $comments = $post->superComments()->paginate($this->perPage);

        return view('posts.show', compact('post', 'comments'));
    }

    /**
     * Post a comment.
     *
     * @param Post    $post
     * @param Request $request
     * @return array
     */
    public function comment(Post $post, Request $request)
    {
        if ($request->input('origin') != 0) {
            $parent = Comment::find($request->input("origin"));
        }
        $body = isset($parent) ? $parent->replyLink() . $request->input('content') : $request->input('content');

        $comment = new Comment([
            "post_id" => $post->id,
            "user_id" => $request->user()->id,
            "origin" => $request->input('origin') ? $request->input('origin') : null,
            "body" => $body
        ]);

        return $post->comments()->save($comment) ? $this->successResponse([
            'message' => '评论成功',
            'html'    => view('posts.partials.comment-list', compact('comment'))->render()
        ]) : $this->errorResponse('评论失败');
    }

    /**
     * Like a comment.
     *
     * @param Comment $comment
     * @param Request $request
     * @return array
     */
    public function likeComment(Comment $comment, Request $request)
    {
        $liked = $request->user()->likedComment($comment);
        if (! $liked)
            $comment->likes()->create(['user_id' => $request->user()->id]);

        return $this->successResponse();
    }

    /**
     * Fetch more comments.
     *
     * @param Post $post
     * @param      $page
     * @return array
     */
    public function loadMoreComments(Post $post, $page)
    {
        $comments = $post->superComments()->skip($page * $this->perPage)->take($this->perPage)->get();

        return $this->successResponse([
            "html" => view('posts.partials.comments', compact('comments'))->render()
        ]);
    }
}
