<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
     protected $table = 'order_items';
    protected $fillable = [
        'image',
        'order_id',
         'book_id', 
         'quantity', 
         'price'
         ];

 
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
