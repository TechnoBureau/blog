<?php

namespace TechnoBureau\Blog\Http\Controllers;

use Illuminate\Http\Request;
use TechnoBureau\Blog\Models\Category;
use Illuminate\Support\Str;
use TechnoBureau\UI\Http\Controllers\TechnoBureauController;
use TechnoBureau\UI\Models\Authorizable;

class CategoryController extends TechnoBureauController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    use Authorizable;
    private $view;
    private $conf;

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->conf = new Category();
        $this->view["casts"]=$this->conf::$html_casts;
        $this->view["list"]=$this->conf::$table_list;
        $this->view["disabled"]=$this->conf::$html_disabled;
        $this->view["table"]=$this->conf->getTable();
        $this->view["hidden"]=$this->conf->getHidden();
        $this->view["nav"] = "config-nav";
    }

    public function getData()
    {
        $keyword = request('search');
        //$page = request()->get('page', 1);
        // return \Cache::remember('category.'.$keyword.'.'.$page, 300, function () use ($keyword) {
        //     $data=$this->conf::select('id','name','slug')->where('active','1')->whereNull('top_slug')
        //         ->when($keyword,function ($query) use ($keyword) {
        //             $query->orWhere('name', 'LIKE', '%' . $keyword . '%')
        //             ->orWhere('slug', 'LIKE', '%' . $keyword . '%');
        //         })->with('childs')->orderBy('id','DESC')->paginate(10);
        //     return $data;
        // });
        return $this->conf::select('id','name','slug')->where('active','1')
                ->when($keyword,function ($query) use ($keyword) {
                    $query->orWhere('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('slug', 'LIKE', '%' . $keyword . '%');
                })->with('childs')->orderBy('id','DESC')->paginate(10);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->formatResponse($request);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return $this->formatResponse($request);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => "required|unique:".Str::plural($this->view['table']).",slug"
        ]);
    
        $input = $request->all();

        $conf = $this->conf::create($input);        
        return $this->formatResponse($request,$conf);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request ,$id)
    {
        $conf = $this->conf::find($id);
        return $this->formatResponse($request,$conf);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request ,$id)
    {        
        $conf = $this->conf::find($id);
        return $this->formatResponse($request,$conf);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        $this->validate($request, [
            'name' => 'required',        
        ]);
    
        $input = $request->all();
        $conf = $this->conf::find($id);
       
        $conf->update($input);
        return $this->formatResponse($request,$conf);        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $this->conf::find($id)->delete();
        return $this->formatResponse($request);
               
    }

    public function formatResponse(Request $request,$conf = NULL ,$message=NULL,$_cData = array(),$_fData = array())
    {
        $Func_Type = debug_backtrace()[1]['function'];
        
        if( ( $request->is('api/*') || $request->ajax() ) && isset($conf) )
            return response()->json($conf); 
        else if( ( $request->is('api/*') || $request->ajax() ) && !isset($conf) && $Func_Type != "index" )
            return response()->json(['error' => ucfirst(Str::singular($this->view['table'])). ' Not found'],404);
        else if( ( $request->is('api/*') || $request->ajax() ) && !isset($conf) && $Func_Type == "index" )
            return response()->json($this->getData());
        else
            $ConfList = $this->getData();
        
        $view = $this->view;
        
        $var = array('ConfList','view');
        if(isset($conf))
        {
            
            $result = compact($var,'conf');
        }
        else if($Func_Type == "create")
        {            
            $result = compact($var);
        }
        else
            $result = compact($var);
        $massage = array(
            "store" => "created",
            "update" => "updated",
            "destroy" => "deleted",
        );
        if($Func_Type == "store" || $Func_Type == "update" || $Func_Type == "destroy")
            $message = ucfirst(Str::singular($this->view['table']))." ". ucfirst($massage[$Func_Type]) ." successfully";

        if(isset($message))
        return view('conf-management',$result)
                ->with('success',$message)
                ->with('i', ($request->input('page', 1) - 1) * 10); 
        else
        return view('conf-management',$result)
                ->with('i', ($request->input('page', 1) - 1) * 10);

    }
}
