<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Book;
use App\Models\Order;
use App\Models\Review;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    
      $user = auth()->user()->loadCount('reviews');
      $reviews = $user->reviews()
                 ->with('book')
              ->take(4)
                ->latest()
                 ->get();
            
 
    return view('profile.userProfile.user-profile', [
        'user' => $user,
        'reviews' => $reviews,
         'totalReviews'=>$user->reviews_count
    ]);
}
   

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
    $search = $request->input('search');
    $paginate = 5; 
        
    $user = auth()->user();
    $reviews = $user->reviews()
        ->with('book')
        ->when($search, function ($query) use ($search) {
            $query->whereHas('book', function ($q) use ($search) {
                $q->search($search);
            });
        })
        ->latest()
        
        ->paginate($paginate);

        return view('profile.userProfile.user-reviews', [
        'user' => $user,
        'reviews' => $reviews,
        ]);
    }

    

public function history(User $user)
{ $user = auth()->user();
    $orders = auth()->user()
        ->orders()
        ->with('items.book')
        ->latest()
        ->get();

    return view('profile.userProfile.user-history', compact('orders', 'user'));
}
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review, Book $book)
    {
     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
