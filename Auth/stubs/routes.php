
Route::get('/', [TechnoBureau\Blog\Http\Controllers\IndexController::class,'index'])->name('index');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('categories', TechnoBureau\Blog\Http\Controllers\CategoryController::class);
});

Route::get('/{category}/', 
            [TechnoBureau\Blog\Http\Controllers\ArticleController::class,'showByCategory']
        )->name('showByCategory');

Route::get('/{category}/{subcategory}/', 
            [TechnoBureau\Blog\Http\Controllers\ArticleController::class,'showBySubCategory']
        )->name('showBySubCategory');
        
Route::get('/{category}/{subcategory}/{title}/article{id}.html', 
            [TechnoBureau\Blog\Http\Controllers\ArticleController::class,'show']
        )->name('showByID');
