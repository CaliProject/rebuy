<?php

namespace Rebuy\Http\Controllers;

use Rebuy\View;
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
     * Show the posts.
     * 
     * @return mixed
     */
    public function posts()
    {
        $posts = Post::latest()->postsOnly()->paginate();
        $type = 0;

        return view('posts', compact('posts', 'type'));
    }

    /**
     * Show the videos.
     * 
     * @return mixed
     */
    public function videos()
    {
        $posts = Post::latest()->videosOnly()->paginate();
        $type = 1;

        return view('posts', compact('posts', 'type'));
    }

    /**
     * Show the post.
     *
     * @param Post $post
     * @return mixed
     */
    public function show(Post $post)
    {
        // 自增长一个浏览量
        $post->views()->save(new View);
        // 获取该文章的所有原创评论
        $comments = $post->superComments()->paginate($this->perPage);

        // 判断文章类型
        if ($post->type === 1) {
            // 文章类型为视频
            $video = true;
            
            return view('posts.show', compact('post', 'comments', 'video'));
        }

        // 文章类型为普通文章
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
        // 判断是否为回复
        if ($request->input('origin') != 0) {
            // 是回复, 取出父级评论对象
            $parent = Comment::find($request->input("origin"));
        }
        // 根据原创与否来决定评论内容
        $body = isset($parent) ? $parent->replyLink() . $request->input('content') : $request->input('content');

        // 写入评论数据表
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

    /**
     * Like a post.
     * 
     * @param Post $post
     * @return array
     */
    public function likePost(Post $post, Request $request)
    {
        // 直接调用发出请求的用户的likePost方法
        $request->user()->likePost($post);
        
        return $this->successResponse([
            'likes' => $post->likesCount()
        ]);
    }
}
