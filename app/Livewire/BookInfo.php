<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Book;
use App\Models\Review;
use App\Services\BookCacheService;
use App\Services\CategoryCacheService;

class BookInfo extends Component
{
    public $bookId;
    public $comment;
    public $rating;
    public $book;

    public function mount($bookId)
    {
        $this->bookId = $bookId;
        
    }

    public function storeReview()
    {
        $this->validate([
            'comment' => 'required|min:3',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'book_id' => $this->book->id,
            'user_id' => auth()->id(),
            'comment' => $this->comment,
            'rating' => $this->rating
        ]);
       $this->book->load('reviews.user'); 
        $this->reset(['comment','rating']);
 
    }

    // send event to cart
    public function addToCart($id)
    {
        $this->dispatch('add-to-cart', $id);
    }

    public function render(BookCacheService $booksService, CategoryCacheService $categoryService)
    {
        $this->book = $booksService->getSingle($this->bookId);
        $similarBooks = $booksService->getSimilarBook($this->book);
        $books = $booksService->getPaginated(null, null, null, 4);
        $categories = $categoryService->getAll();

        return view('livewire.bookInfo', [
        'book' => $this->book,
        'books' => $books,
        'similarBooks' => $similarBooks,
        'categories' => $categories
    ]);
    }
}