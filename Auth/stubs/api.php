
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('/{category}/', 
            [TechnoBureau\Blog\Http\Controllers\ArticleController::class,'showByCategory']
        )->name('showByCategory');

    Route::get('/{category}/{subcategory}/', 
            [TechnoBureau\Blog\Http\Controllers\ArticleController::class,'showBySubCategory']
        )->name('showBySubCategory');
        
    Route::get('/{category}/{subcategory}/{title}/article{id}.html', 
            [TechnoBureau\Blog\Http\Controllers\ArticleController::class,'show']
        )->name('showByID');
        
});
