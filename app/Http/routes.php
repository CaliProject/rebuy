<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::auth();

// 主页
Route::get('/', 'HomeController@index');

// 个人主页
// 假如name是Blade, http://example.com/@Blade
Route::get('@{name}', 'ProfileController@show');

// 文章列表
Route::get('posts', 'PostsController@posts');
// 视频列表
Route::get('videos', 'PostsController@videos');
// 商城列表
Route::get('markets', 'MarketsController@index');
// 搜索关键字, 假如搜索'blade', http://example.com/search/blade
Route::get('search/{keyword}', 'HomeController@search');

// 点赞评论的动作
Route::put('comments/like/{comment}', 'PostsController@likeComment');

// 标签的相关内容页面 （产品/文章） product/post
Route::get('tag/{type}/{tag}', 'HomeController@showTag');

// 一个文章的相关路由
Route::group([
    'prefix' => 'posts/{post}.html'
], function () {
    // 查看文章详情
    Route::get('/', 'PostsController@show');
    // 点赞一篇文章
    Route::patch('/', 'PostsController@likePost');
    // 发布一条评论
    Route::post('comment', 'PostsController@comment');
    // 加载下一页评论, 假如加载第二次 http://example.com/posts/1.html/comments/3
    Route::post('comments/{page}', 'PostsController@loadMoreComments');
});

// 一个商品的相关路由
Route::group([
    'prefix' => 'markets/products/{product}.html'
], function () {
    // 查看商品详情
    Route::get('/', 'MarketsController@show');
});

// 上传图片
Route::post('upload', 'HomeController@uploadPicture');
// 上传头像
Route::post('upload/avatar', 'HomeController@uploadAvatar');

// 个人主页相关路由
Route::group([
    'prefix' => 'profile',
    'middleware' => ['auth']
], function () {
    // 展示修改资料页面
    Route::get('/', 'ProfileController@index');
    // 更新个人资料
    Route::patch('/', 'ProfileController@updateProfile');
});

// 后台相关路由
Route::group([
    'prefix' => 'manage',
    'middleware' => ['auth', 'role:admin']
], function () {
    // 栏目
    Route::get('{section?}', 'ManageController@index');

    // 管理文章相关
    Route::group([
        'prefix' => 'posts'
    ], function () {
        // 添加一篇文章
        Route::get('create', 'ManageController@showCreatePost');
        // 确定添加一篇文章
        Route::post('create', 'ManageController@createPost');
        // 编辑一篇文章
        Route::get('{post}', 'ManageController@showEditPost');
        // 更新一篇文章
        Route::patch('{post}', 'ManageController@updatePost');
        // 删除一篇文章
        Route::delete('{post}', 'ManageController@deletePost');
    });

    // 管理用户相关
    Route::group([
        'prefix' => 'users'
    ], function () {
        // 新增一个用户
        Route::get('create', 'ManageController@showCreateUser');
        // 确定添加一个用户
        Route::post('create', 'ManageController@createUser');
        // 编辑一个用户
        Route::get('{user}', 'ManageController@showEditUser');
        // 更新一个用户
        Route::patch('{user}', 'ManageController@updateUser');
        // 删除一个用户
        Route::delete('{user}', 'ManageController@deleteUser');
    });

    // 管理评论相关
    Route::group([
        'prefix' => 'comments'
    ], function () {
        // 删除评论
        Route::delete('{comment}', 'ManageController@deleteComment');
    });

    // 管理图片相关
    Route::group([
        'prefix' => 'media'
    ], function () {
        // 删除图片
        Route::delete('{media}', 'ManageController@deleteMedia');
    });

    // 管理商品相关
    Route::group([
        'prefix' => 'markets'
    ], function () {
        // 新增一个商品
        Route::get('create', 'ManageController@showCreateProduct');
        // 确定新增一个商品
        Route::post('create', 'ManageController@createProduct');
        // 编辑一个商品
        Route::get('{product}', 'ManageController@showEditProduct');
        // 更新一个商品
        Route::patch('{product}', 'ManageController@updateProduct');
        // 删除一个商品
        Route::delete('{product}', 'ManageController@deleteProduct');
    });

    // 管理其他设置
    Route::patch('extras', 'ManageController@updateExtra');
});