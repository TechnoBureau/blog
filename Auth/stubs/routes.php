
Route::get('/', [TechnoBureau\UI\Http\Controllers\IndexController::class,'index'])->name('index');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('categories', TechnoBureau\UI\Http\Controllers\CategoryController::class);
});

Route::get('/{category}/', 
            [TechnoBureau\UI\Http\Controllers\ArticleController::class,'showByCategory']
        )->name('showByCategory');

Route::get('/{category}/{subcategory}/', 
            [TechnoBureau\UI\Http\Controllers\ArticleController::class,'showBySubCategory']
        )->name('showBySubCategory');
        
Route::get('/{category}/{subcategory}/{title}/article{id}.html', 
            [TechnoBureau\UI\Http\Controllers\ArticleController::class,'show']
        )->name('showByID');
