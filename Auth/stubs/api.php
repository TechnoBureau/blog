
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::resource('categories', TechnoBureau\Blog\Http\Controllers\CategoryController::class,['as'=>'api']);

    Route::get('/{category}/', 
            [TechnoBureau\Blog\Http\Controllers\ArticleController::class,'showByCategory']
        )->name('api.article.category');

    Route::get('/{category}/{subcategory}/', 
            [TechnoBureau\Blog\Http\Controllers\ArticleController::class,'showBySubCategory']
        )->name('api.article.subcategory');
        
    Route::get('/{category}/{subcategory}/{title}.{id}/', 
            [TechnoBureau\Blog\Http\Controllers\ArticleController::class,'view']
        )->name('api.article.view');        
});
