<?php

namespace TechnoBureau\Blog\Http\Controllers;

use Illuminate\Http\Request;
use TechnoBureau\Blog\Models\Article;
use TechnoBureau\UI\Http\Controllers\TechnoBureauController;
use Config;
use Doctrine\RST\Parser;

class ArticleController extends TechnoBureauController
{
    private $view;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->view["nav"] = "blog-nav";
    }
    public function showByCategory(Request $request,$category){
        
        $view = $this->view;
        $categoryID = $this->getAllSubCategoryID($category);
        $articles = Article::select('id','title','body','slug','created_at','user_id','category_id')
                ->whereIn('category_id',$categoryID)
            ->orderBy('id','DESC')->paginate(10);
        
        if( ( $request->is('api/*') || $request->ajax() ) )
            return response()->json($articles); 
        return view('articles',compact('view','articles'));                
    }
    public function showBySubCategory(Request $request,$category,$subcategory){
        
        $view = $this->view;
        $subcategoryID = $this->getCategoryID($subcategory);
        $articles = Article::select('id','title','body','slug','created_at','user_id','category_id')
            ->where('category_id',$subcategoryID)
            ->orderBy('id','DESC')->paginate(10);
        
        if( ( $request->is('api/*') || $request->ajax() ) )
            return response()->json($articles); 
        return view('articles',compact('view','articles'));                
    }
    public function view(Request $request,$category,$subcategory,$title,$id){
        
        $view = $this->view;
        $categoryID = $this->getAllSubCategoryID($category);
        $article = Article::select('id','title','body','slug','created_at','user_id','category_id')
                    ->whereIn('category_id',$categoryID)
                    ->where('id',$id)
                    ->find($id);

        if( ( $request->is('api/*') || $request->ajax() ) )
            return response()->json($article); 
        return view('article.index',compact('view','article'));                
    }
    private function getCategoryID($category_slug = NULL){
        foreach(Config::get('categories') as $category){
            if($category['slug'] == $category_slug)
                return $category['id'];
            foreach($category['childs'] as $subcategory){
                $tmpArry = explode('/', $subcategory['slug']);
                if(end($tmpArry) == $category_slug)
                    return $subcategory['id'];
            }
        }
        return NULL;
    }
    private function getAllSubCategoryID($category_slug = NULL){
        $subID = array();
        foreach(Config::get('categories') as $category){
            if($category['slug'] == $category_slug)
            {
                $subID[] = $category['id'];
                foreach($category['childs'] as $subcategory)
                    $subID[] = $subcategory['id'];
            }            
        }
        return $subID;
    }
}
