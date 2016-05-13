<?php

namespace Rebuy\Http\Controllers;

use Rebuy\Post;
use Rebuy\Product;
use Rebuy\User;
use Rebuy\Media;
use Rebuy\Comment;
use Rebuy\Configuration;
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
     * Show create page for posts.
     *
     * @return mixed
     */
    public function showCreatePost()
    {
        return view('manage.posts.create', ['post' => new Post]);
    }

    /**
     * Creates a post.
     *
     * @param PostFormRequest $request
     * @return array
     */
    public function createPost(PostFormRequest $request)
    {
        $post = $request->user()->posts()->create($request->all());
        $post->saveTags($request->input('tags'));

        return $this->successResponse([
            'redirect' => url('manage/posts')
        ]);
    }

    /**
     * Updates a post.
     *
     * @param Post            $post
     * @param PostFormRequest $request
     * @return array
     */
    public function updatePost(Post $post, PostFormRequest $request)
    {
        $post->update($request->only($post->getFillable()));
        $post->saveTags($request->input('tags'));

        return $this->successResponse('文章更新成功');
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

    /**
     * Show edit page for users.
     *
     * @param User $user
     * @return mixed
     */
    public function showEditUser(User $user)
    {
        return view('manage.users.edit', compact('user'));
    }

    /**
     * Show create page for users.
     *
     * @return mixed
     */
    public function showCreateUser()
    {
        return view('manage.users.create', ['user' => new User]);
    }

    /**
     * Creates a user.
     *
     * @param Request $request
     * @return array
     */
    public function createUser(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|max:255|unique:users',
            'email'    => 'required|email|max:255|unique:users',
            'tel'      => 'required|unique:users',
            'password' => 'required|min:6|confirmed',
            'role'     => 'in:member,admin'
        ]);

        $attributes = $request->only((new User)->getFillable());
        $attributes['password'] = bcrypt($request->input('password'));

        $user = User::create($attributes);

        return $user ? $this->successResponse([
            'message'  => '用户创建成功',
            'redirect' => url('manage/users')
        ]) : $this->errorResponse('用户创建失败');
    }

    /**
     * Updates a user.
     *
     * @param User    $user
     * @param Request $request
     * @return array
     */
    public function updateUser(User $user, Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|max:255|unique:users,name,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'tel'   => 'required|unique:users,tel,' . $user->id,
            'role'  => 'in:member,admin'
        ]);

        $attributes = $request->except(['_token', '_method', 'password', 'password_confirmation']);

        if ($request->input('password') !== '') {
            $this->validate($request, [
                'password' => 'min:6|confirmed'
            ]);

            $user->update([
                'password' => bcrypt($request->input('password'))
            ]);
        }

        $user->update($attributes);

        return $this->successResponse('用户资料更新成功');
    }

    /**
     * Deletes a user.
     *
     * @param User $user
     * @return array
     * @throws \Exception
     */
    public function deleteUser(User $user)
    {
        return $user->delete() ? $this->successResponse('删除成功') : $this->errorResponse('删除失败');
    }

    /**
     * Deletes a comment.
     *
     * @param Comment $comment
     * @return array
     * @throws \Exception
     */
    public function deleteComment(Comment $comment)
    {
        return $comment->delete() ? $this->successResponse('删除成功') : $this->errorResponse('删除失败');
    }

    /**
     * Deletes a media.
     *
     * @param Media $media
     * @return array
     * @throws \Exception
     */
    public function deleteMedia(Media $media)
    {
        return $media->trash() ? $this->successResponse('删除成功') : $this->errorResponse('删除失败');
    }

    /**
     * Updates extra settings.
     * 
     * @param Request $request
     * @return array
     */
    public function updateExtra(Request $request)
    {
        $arr = $request->except(['_token', '_method']);
        array_walk($arr, function ($value, $key) {
            Configuration::__callStatic(camel_case($key), [$value]);
        });

        return $this->successResponse('更新成功');
    }

    /**
     * Show view for creating a product.
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCreateProduct()
    {
        return view('manage.markets.create', ['product' => new Product]);
    }

    /**
     * Creates a product.
     *
     * @param Request $request
     * @return array
     */
    public function createProduct(Request $request)
    {
        $product = $request->user()->products()->create($request->all());
        $product->saveTags($request->input('tags'));
        $product->saveMetas($request->input('meta_key'), $request->input('meta_val'));

        return $this->successResponse([
            'redirect' => url('manage/markets')
        ]);
    }

    /**
     * Show view for editing a product.
     * 
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showEditProduct(Product $product)
    {
        return view('manage.markets.edit', compact('product'));
    }

    /**
     * Updates a product.
     *
     * @param Product $product
     * @param Request $request
     * @return array
     */
    public function updateProduct(Product $product, Request $request)
    {
        $product->update($request->only($product->getFillable()));
        $product->saveTags($request->input('tags'));
        $product->saveMetas($request->input('meta_key'), $request->input('meta_val'));

        return $this->successResponse('商品更新成功');
    }
    
    /**
     * Deletes a product.
     *
     * @param Product $product
     * @return array
     * @throws \Exception
     */
    public function deleteProduct(Product $product)
    {
        return $product->delete() ? $this->successResponse('删除成功') : $this->errorResponse('删除失败');
    }
}