<?php

namespace TechnoBureau\Blog\Providers;

use App\Providers\RouteServiceProvider as ServiceProvider;
use TechnoBureau\Blog\Models\Category;
use Illuminate\Support\Facades\Route;

class TechnoBureauRouteServiceProvider extends ServiceProvider
{
    /**
     * Special Generic Route assignment.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Route::pattern('id', '[0-9]+');
        Route::pattern('page', '[0-9]+');
        Route::pattern('title', '[0-9a-zA-Z-]+');

        $tmp=Category::RouteCategory();
        $Categories=$tmp['RouteCategories'];
        $SubCategories=$tmp['RouteSubCategories'];

        Route::pattern('category',$Categories);
        Route::pattern('subcategory',$SubCategories);

    }
}
