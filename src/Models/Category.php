<?php

namespace TechnoBureau\Blog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Category extends Model
{
    use HasFactory,Cachable;
    static $html_disabled = [
       
    ];
    static $html_casts = [
        'general'=>
        [
            'name' => 'text',
            'slug' => 'text',
            'top_slug' => 'text',
        ],
        'additional'=>
        [
            
        ],
        'list' => 'col-md-4',
        'view' => 'col-md-8',
        'layout' => 2, // 2- Column Layout
        'search' => true,
        'create' => true,
        'action_edit' => true,
        'action_delete' => true,
        
    ];
    static $table_list = [
        'name'
    ];
    
    public function childs()
    {
    	return $this->hasMany(Category::class, 'top_slug','slug');
    }

    public function parent()
    {
    	return $this->belongsTo(Category::class, 'slug','top_slug');
    }
    public static function RouteCategory()
    {
        $categories = Category::select('id','name','slug')->where('active','1')->whereNull('top_slug')->with('childs')->orderBy('id','ASC')->get();
        $RouteCategories='';
        $RouteSubCategories='';
        foreach($categories as $category)
        {
            if(!$RouteCategories) $RouteCategories.=$category->slug;
            else $RouteCategories.="|".$category->slug;
            if(!$category->childs->isEmpty())
            foreach($category->childs as $subcategory)
            {   $tmp=(explode('/',$subcategory->slug));
                if(!$RouteSubCategories) $RouteSubCategories.=end($tmp);
                else $RouteSubCategories.="|".end($tmp);                
            }
        }
        return compact('RouteCategories','RouteSubCategories');
    }
}
