<?php

namespace Rebuy\Providers;

use Rebuy\Post;
use Rebuy\User;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider {

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
                'posts' => Post::stickyFirst()->paginate()
            ]);
        });

        view()->composer("manage.users.index", function ($view) {
            return $view->with([
                'users' => User::paginate()
            ]);
        });
    }
}
