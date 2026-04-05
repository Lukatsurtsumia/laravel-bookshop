<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

 
class ReviewController extends Controller
{
     
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Book $book)
    { 
        
        $validated= $request->validate([
            'comment' => 'required|string|min:1|max:400',
            'rating'=>'required|integer|min:1|max:5'
        ]);

          $book->reviews()->create([
            ...$validated,
            'user_id'=> auth()->id()
            ]);
          return  back();

    }
 
        /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book,Review $review, User $user)
    {
        $book->loadAvg('reviews', 'rating');
         return view('profile.userProfile.edit-reviews', compact('book', 'review', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book,User $user)
    {
        $validated = $request->validate([
            'rating'=>'required',
            'comment'=>'required|min:10',
        ]);

       $review= auth()->user()
               ->reviews()
               ->where('book_id', $book->id)
               ->first();
 
    if ($review) { 
        $review->update($validated); 
    } 
        return redirect()->route('user.index')->with('success', 'Commnet Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book, Review $review)
{
     

    $review->delete();

    return back()->with('success', 'Review deleted');
}
}
