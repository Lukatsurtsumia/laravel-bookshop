<?php
 
namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Review;
use App\Services\CategoryCacheService;
 
use App\Services\BookCacheService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    protected $bookService; 
    protected $categoryService; 

    public function __construct( 
        BookCacheService $bookService, 
        CategoryCacheService $categoryService 
    ) 
    { 
        $this->bookService = $bookService; 
        $this->categoryService = $categoryService; 
    }
     
    public function index( Request $request)
    {
        $books = $this->bookService->getPaginated(
        $request->search, 
        $request->filter, 
        $request->category, 
        
    )->withQueryString();
    
        $categories = $this->categoryService->getAll(); 
        return view('welcome_Book.index', ['books'=>$books, 'categories'=>$categories]);
         }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.profile-info');
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
    public function show(Book $book )
    {
        
        $book = $this->bookService->getSingle($book->id);
      
        $similarBooks = $this->bookService->getSimilarBook($book);
        return view('welcome_Book.bookInfo', ['book' => $book, 'similarBooks' => $similarBooks]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('profile.admin.bookForm.UpdateBook', compact('book'));
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
  
}
