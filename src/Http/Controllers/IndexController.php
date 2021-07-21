<?php

namespace TechnoBureau\Http\Controllers;

use Illuminate\Http\Request;
use TechnoBureau\Models\Article;

class IndexController extends TechnoBureauController
{
    private $view;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->view["nav"] = "blog-nav";
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $view = $this->view;
        // $articles = \Cache::remember('top_articles', 300, function () {
        //     $data=Article::select('id','title','body','slug')
        //     ->where('active',1)
        //     ->orderBy('id','DESC')->get(3);
        //     return $data;
        // });
        $articles = Article::select('id','title','body','slug')
                    ->where('active',1)
                    ->orderBy('id','DESC')->get(3);

        if( ( $request->is('api') || $request->ajax() ) )
        return response()->json($articles);
        return view('welcome',compact('view','articles'));
    }
}
