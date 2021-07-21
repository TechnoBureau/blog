<?php

namespace TechnoBureau\Blog\Http\Controllers;

use Illuminate\Http\Request;
use TechnoBureau\Blog\Models\Article;
use TechnoBureau\UI\Http\Controllers\TechnoBureauController;

class ArticleController extends TechnoBureauController
{
    public function show()
    {        
        return view('home');
    }
    public function showByCategory(Request $request,$category){
        //print $category; exit;
        $keyword = request('search');
        $articles = Article::select('id','title','body','slug','created_at','user_id','category_id')
            ->when($keyword,function ($query) use ($keyword) {
                $query->orWhere('name', 'LIKE', '%' . $keyword . '%')
                ->orWhere('slug', 'LIKE', '%' . $keyword . '%');
            })->orderBy('id','DESC')->paginate(10);
        
        if( ( $request->is('api/*') || $request->ajax() ) )
            return response()->json($articles); 
        return view('articles',compact('articles'));                
    }
}
