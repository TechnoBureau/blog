
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('/{category}/', 
            [TechnoBureau\UI\Http\Controllers\ArticleController::class,'showByCategory']
        )->name('showByCategory');

    Route::get('/{category}/{subcategory}/', 
            [TechnoBureau\UI\Http\Controllers\ArticleController::class,'showBySubCategory']
        )->name('showBySubCategory');
        
    Route::get('/{category}/{subcategory}/{title}/article{id}.html', 
            [TechnoBureau\UI\Http\Controllers\ArticleController::class,'show']
        )->name('showByID');
        
});
