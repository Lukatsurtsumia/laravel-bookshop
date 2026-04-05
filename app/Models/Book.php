<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'author',
        'description',
        'image',
        'year',
        'price',
        'quantity',
        'user_id',
      

    ];
    public function user(){
        return $this->belongsTo(User::class);
    } 

    public function reviews(){
        return $this->hasMany(Review::class)->latest();
    }
  
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
   
 public function items(){
    return $this->hasMany(Items::class);
}
 public function scopeSearch($query, $term){
        return $query->where(function($q) use ($term){
        $q->where('title', 'LIKE', "%{$term}%")
          ->orWhere('author', 'LIKE', "%{$term}%");
        });
    }
 
      public function scopePopular( Builder $query , $from =null, $to=null){
          return $query->withCount(['reviews' => fn(Builder $q)
           => $q->dateRange($from, $to)
          ])->orderByDesc('reviews_count');
       }

       public function scopeMostRated(Builder $query , $from =null, $to=null){
        return $query->withAvg(['reviews'=>fn(Builder $q) => 
        $q->dateRange($from, $to)]
        ,'rating')->orderByDesc('reviews_avg_rating');
       }
     
       public function scopeFilter($query, $filter){
        if (!$filter) { 
        return $query;  
    } 
          return  match($filter){
                 'popular'=>$query->popular(),
                'mostRated'=>$query->mostRated(),
                'expensive'=>$query->expensive(),
                default=>$query
            };
       }

       public function scopeCategory($query,$categoryId = null ){  
        if (!$categoryId) return $query; 
                return $query->whereHas('categories', function ($q) use ($categoryId) { 
                $q->where('categories.id', $categoryId); 
    }); 
       }

       public function scopeExpensive(Builder $query ){
        return $query->orderByDesc('price');
       }
}
