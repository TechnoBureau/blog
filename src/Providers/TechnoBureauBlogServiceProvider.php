<?php

namespace TechnoBureau\Blog\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use TechnoBureau\Models\Category;

class TechnoBureauBlogServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $categories = Category::select('id','name','slug')->where('active','1')->whereNull('top_slug')->with('childs')->orderBy('id','ASC')->get();
        View::share('categories', $categories);
    }
}
