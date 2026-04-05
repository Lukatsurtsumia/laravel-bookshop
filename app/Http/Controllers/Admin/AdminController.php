<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class AdminController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $books = Cache::remember('admin.dashboard.books', now()->addSeconds(10), function () {
    return Book::with('user:id,name')
        ->withCount('reviews')
        ->withAvg('reviews', 'rating')
        ->latest()
        ->get();
});

$reviews = Cache::remember('admin.dashboard.reviews', now()->addSeconds(10), function () {
    return Review::with(['book:id,title', 'user:id,name,is_admin'])
        ->whereRelation('user', 'is_admin', 0)
        ->latest()
        ->take(5)
        ->get();
});

$stats = [
    'books' => Book::sum('quantity'),
    'users' => User::count(),
    'reviews' => Review::count(),
];

return view('profile.admin.profileinfo', compact('books', 'reviews', 'stats'));
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
    public function destroy(string $id)
    {
        
    }
}
