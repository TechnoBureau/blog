
Route::get('/', [TechnoBureau\Blog\Http\Controllers\IndexController::class,'index'])->name('index');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('categories', TechnoBureau\Blog\Http\Controllers\CategoryController::class);
});

Route::get('/{category}/', 
            [TechnoBureau\Blog\Http\Controllers\ArticleController::class,'showByCategory']
        )->name('article.category');

Route::get('/{category}/{subcategory}/', 
            [TechnoBureau\Blog\Http\Controllers\ArticleController::class,'showBySubCategory']
        )->name('article.subcategory');
        
Route::get('/{category}/{subcategory}/{title}.{id}/', 
            [TechnoBureau\Blog\Http\Controllers\ArticleController::class,'view']
        )->name('article.view');

