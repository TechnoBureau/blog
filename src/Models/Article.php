<?php

namespace TechnoBureau\Blog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TechnoBureau\Blog\Casts\Url;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Article extends Model
{
    use HasFactory,Cachable;
    protected $casts = [
        'body' => Url::class,
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];
    public function user()
    {
        return $this->belongsTo('\App\Models\User','user_id','id');
    }
    public function category()
    {
        return $this->belongsTo('TechnoBureau\Blog\Models\Category','category_id','id');
    }
}
