<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

        protected $fillable =[
            'book_id',
            'user_id',
            'rating',
            'comment'
        ];
    public function book(){
        return $this->belongsTo(Book::class);
    }
public function user(){
   return  $this->belongsTo(User::class);
}
    public function scopeDateRange($query , $from =null, $to=null){
         if($from && $to){
            $query->whereBetween('created_at', [$from, $to]);
        }
        if($from && !$to){
            $query->whereDate('created_at', '>=', $from);
        }
        if($to && !$from){
            $query->whereDate('created_at', '<=', $to);
        }
       
    }

  
    public function scopeSearch($query, $term){

    if(!$term) return  $query;

    return $query
    ->whereHas('book', function($q) use ($term){
        $q->search($term);
    })
    ->orWhereHas('user' , function($q) use ($term){
        $q->where('name', 'LIKE', "%{$term}%");
    });
    }

}
