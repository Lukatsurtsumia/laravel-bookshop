<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index(Request $request) 
{ 
    $users = User::query() 
        ->when($request->search, fn($q) => $q->search($request->search)) 
        ->orderByDesc('is_admin') 
        ->paginate(5) 
        ->withQueryString(); 

    return view('profile.admin.admin-users', compact('users')); 
}
    
public function history( Request $request)
{  $search = $request->input('search');
    
    
    $orders = Order::with(['user','items.book']) 
         ->when($search, function ($q) use ($search) { 
            $q->whereHas('user', function ($userQuery) use ($search) { 
                $userQuery->where('name', 'LIKE', "%{$search}%"); 
            }); 
        }) 
        ->latest()
        ->paginate(5)
        ->withQueryString();

    return view('profile.admin.users-history', compact('orders'));
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
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
        if ($user->is_admin) { 
        return back()->with('error', 'Cannot delete admin'); 
    } 
        $user->delete();
        
        return redirect()->back()->with('success', 'User deleted successfully!');
    }
}
