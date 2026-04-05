<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Book;
use App\Models\Items;
use App\Models\Order;

class Cart extends Component
{
    public $cart = [];
    public $isOpen = false;

    protected $listeners = [
        'add-to-cart' => 'add'
    ];

    public function mount()
    {
        $this->cart = session()->get('cart', []);
    }

    public function toggle()
    {
        $this->isOpen = ! $this->isOpen;
    }

    public function open()
    {
        $this->isOpen = true;
    }

    public function close()
    {
        $this->isOpen = false;
    }

    public function add($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])){
            $cart[$id]['quantity']++;
        } else {

            $book = Book::find($id);

            $cart[$id] = [
                'title' => $book->title,
                'price' => $book->price,
                'image' => $book->image,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);
        $this->cart = $cart;
    }

    public function increase($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])){
            $cart[$id]['quantity']++;
        }
        session()->put('cart', $cart);
        $this->cart = $cart;
    }

    public function decrease($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id]) && $cart[$id]['quantity'] > 1){
            $cart[$id]['quantity']--;
        }
        session()->put('cart', $cart);
        $this->cart = $cart;
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        $this->cart = $cart;
    }

    public function getTotalProperty()
    {
        return collect($this->cart)
            ->sum(fn ($item) => $item['price'] * $item['quantity']);
    }
    //----/Checkout --------//
    public function checkout()
{
    $user = auth()->user();

    if (!$user) {
        session()->flash('error', 'Please login to checkout!');
        return;
    }

    if (empty($this->cart)) {
        session()->flash('error', 'Your cart is empty.');
        return;
    }

    if ($user->points < $this->total) {
        session()->flash('error', 'Not enough Points!');
        return;
    }

    // 🔎 Check stock BEFORE creating order or removing points
    foreach ($this->cart as $bookId => $item) {

        $book = Book::findOrFail($bookId);

        if ($item['quantity'] > $book->quantity) {
            session()->flash('error',$book->title . ' left just ' . $book->quantity . '! Please try again.');
            return;
        }
    }
 
    $user->decrement('points', $this->total);
    $order = Order::create([
        'user_id' => $user->id,
        'total' => $this->total,
    ]);

    foreach ($this->cart as $bookId => $item) {
        $book = Book::findOrFail($bookId);
        $book->decrement('quantity', $item['quantity']);
        Items::create([
            'image' => $item['image'],
            'order_id' => $order->id,
            'book_id' => $bookId,
            'quantity' => $item['quantity'],
            'price' => $item['price']
        ]);
    }

    session()->forget('cart');
    $this->cart = [];

    session()->flash('success', 'Checkout successful!');
}
    
    public function render()
    {
        return view('livewire.cart');
    }
}