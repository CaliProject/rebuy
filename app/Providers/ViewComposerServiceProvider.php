<?php

namespace Rebuy\Providers;

use Illuminate\Support\ServiceProvider;
use Rebuy\Post;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
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
     * Pass thru the admin variables.
     */
    protected function passThroughAdminVariables()
    {
        // Posts
        view()->composer("manage.posts.index", function ($view) {
            return $view->with([
                'posts' => Post::paginate()
            ]);
        });
    }
}
