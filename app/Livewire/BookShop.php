<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\BookCacheService;
use App\Services\CategoryCacheService;
use Livewire\WithPagination;

class BookShop extends Component
{   use WithPagination; 

     
    
    public $search = '';
    public $filter = '';
    public $category = '';

    public function setFilter(string $filter): void
    {
        $this->filter = $filter;
        $this->resetPage(); 
    }

    public function setSearch(string $search): void
    {
        $this->search = $search;
        $this->resetPage(); 
    }

    public function setCategory($categoryId): void
    {
        $this->category = $categoryId;
        $this->resetPage(); 
    }

    // tell cart to add item
    public function addToCart($id)
    {
        $this->dispatch('add-to-cart', id: $id);
    }

    public function render(BookCacheService $booksService, CategoryCacheService $categoryService)
    {
        $books = $booksService->getPaginated(
            $this->search,
            $this->filter,
            $this->category,
            12
        );

        $categories = $categoryService->getAll();

        return view('livewire.bookShop', compact('books', 'categories'));
    }
}