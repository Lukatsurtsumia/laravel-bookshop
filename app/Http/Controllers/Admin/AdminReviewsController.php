<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Support\Facades\Storage;


class AdminReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request) 
{ 
    $reviews = Review::with([ 
        'book:id,title,author', 
        'user:id,name', 
    ]) 
    ->when($request->search, fn($q) => $q->search($request->search)) 
    ->latest() 
    ->paginate(15) 
    ->withQueryString(); 


   return view('profile.admin.admin-reviews', ['reviews'=>$reviews]);
    }
     

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy( Review $review)
    {
      
        $review->delete();
         
        return redirect()->back()->with('success', 'Delete Complited');
    }
}
