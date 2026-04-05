<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use App\Models\Book;
use App\Models\Category;


class BookCacheService
{
        public function getPaginated($search, $filter, $category, $perPage = 12)
    {
         $page = request()->input('page', 1);
         
        $key = 'books:' . md5(json_encode([
            'search' => $search,
            'filter' => $filter,
            'category' => $category,
            'page' => $page,
            'perPage' => $perPage
        ]));

        return Cache::remember($key, now()->addMinutes(1), function () use ($search, $filter, $category, $perPage) {
            return Book::with('categories')
                ->search($search)
                ->filter($filter)
                ->category($category)
                ->when(!$filter, fn($q) => $q->latest())
                ->withAvg('reviews', 'rating')
                ->paginate($perPage);
                
        });
    }
     
    public function getSingle($id)
    {
        return Cache::remember("book:$id", 60, function () use ($id) {
            return Book::with(['categories', 'reviews.user'])
                ->withAvg('reviews', 'rating')
                ->findOrFail($id);
        });
    }

    public function getSimilarBook($book, $limit = 4){
    
    return Book::whereHas('categories', function ($query) use ($book) {
            $query->whereIn('categories.id', $book->categories->pluck('id'));
        })
        ->where('id', '!=', $book->id)
        ->withAvg('reviews', 'rating')
        ->take($limit)
        ->get();
    }
}
class CategoryCacheService
{
    public function getAll()
    {
        return Cache::remember(
            'categories:all',
            now()->addHours(1),
            fn() => Category::where('name', '!=', 'choose Category')->get()
        );
    }
}