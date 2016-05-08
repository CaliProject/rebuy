<?php

namespace Rebuy\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->passThroughCarousel();
        $this->passThroughAdminVariables();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Pass thru the carousel variables.
     */
    protected function passThroughCarousel()
    {
        view()->composer("layouts.partials.app-carousel", function ($view) {
            return $view->with([
                'bannerPosts' => \Rebuy\Post::bannerPosts()
            ]);
        });
    }
    /**
     * Pass thru the admin variables.
     */
    protected function passThroughAdminVariables()
    {
        // Posts
        view()->composer("manage.posts.index", function ($view) {
            return $view->with([
                'posts' => \Rebuy\Post::stickyFirst()->latest()->paginate()
            ]);
        });

        // Users
        view()->composer("manage.users.index", function ($view) {
            return $view->with([
                'users' => \Rebuy\User::paginate()
            ]);
        });

        // Comments
        view()->composer("manage.comments.index", function ($view) {
            return $view->with([
                'comments' => \Rebuy\Comment::latest()->paginate()
            ]);
        });
        
        // Media
        view()->composer("manage.media.index", function ($view) {
            return $view->with([
                'media' => \Rebuy\Media::latest()->paginate()
            ]);
        });
        
        // Products
        view()->composer("manage.products.index", function ($view) {
            return $view->with([
                'products' => \Rebuy\Product::latest()->paginate()
            ]);
        });
    }
}
