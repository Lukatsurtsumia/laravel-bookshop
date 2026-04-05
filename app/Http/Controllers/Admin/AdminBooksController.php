<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Cache;

use App\Services\CategoryCacheService;
 
use App\Services\BookCacheService;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminBooksController extends Controller
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
     
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
          $books = $this->bookService->getPaginated(
        $request->search, 
        $request->filter, 
        $request->category, 
        12
    ); 

        $categories = $this->categoryService->getAll(); 
       return view('profile.admin.admin-books', ['books'=>$books, 'categories'=>$categories]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getAll();
        return view('profile.admin.bookForm.createBooks', ['categories' => $categories, 
                                                            'book' => new Book() ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'year'=>'required|numeric',
        'image' => 'required|image|max:2048',
        'rating' => 'required|numeric|min:0|max:5',
        'quantity'=>'required|numeric|min:1|max:500',

        'categories' => 'required|array',
        'categories.*' => 'exists:categories,id',
    ]);

    // Upload image
    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('books', 'public');
    }
//     if ($request->hasFile('image')) {

//     $file = $request->file('image');

//     $filename = time() . '.' . $file->getClientOriginalExtension();

//     $file->move(public_path('images'), $filename);

//     $imagePath = 'images/' . $filename;

// } else {
//     $imagePath = null;
// }


    // Create book
    $book = Book::create([
        'title' => $validated['title'],
        'author' => $validated['author'],
        'description' => $validated['description'],
        'price' => $validated['price'],
        'year' => $validated['year'],
        'image' => $validated['image'] ?? null,
        'quantity'=>$validated['quantity'],
        'user_id'=>Auth::id(),
    ]);

    
    // Attach categories (many-to-many)
    $book->categories()->attach($validated['categories']);

    $book->reviews()->create([
        'user_id'=> auth()->id(),
        'rating' => $validated['rating'],
        'comment'=>null,
    ]);
    return redirect()
          ->back()
          ->with('success', 'Book created successfully');
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
   public function edit(Book $book)
{
    $book = $this->bookService->getSingle($book->id);

    $categories = $this->categoryService->getAll();

    return view('profile.admin.bookForm.updateBook', [
        'book' => $book,
        'categories' => $categories
    ]);
}
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Book $book)
    {
        $validated = $request->validate([
            'title'=>'required|string|max:255',
            'author'=>'required',
            'price' => 'required|numeric|min:0', 
            'year' => 'required|integer|', 
             'quantity' => 'required|integer|min:0', 

            'rating'=>'required|integer|min:1|max:5',
            'description'=>'required|string',
            'categories'=>'required|array',
            'categories.*'=>'exists:categories,id',
            'image'=>'nullable|image|max:2048'
        ]);
        //image
        if($request->hasFile('image')){
            if($book->image){
                Storage::disk('public')->delete($book->image);
            }
            $validated['image'] = $request->file('image')->store('books', 'public');
        }
       $book->update($validated);
        

       //category
       if(isset($validated['categories'])){
        $book->categories()->sync($validated['categories']);
       }
  return redirect()
        ->route('admin.books.index')
        ->with('success', 'Book updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    { 
        if ($book->image && Storage::disk('public')->exists($book->image)) { 
    Storage::disk('public')->delete($book->image); 
}
        $book->delete();
        cache::forget("book:{$book->id}");

        return redirect()->route('admin.books.index')
               ->with('success', 'Book deleted Successfuly!');
}
}
 