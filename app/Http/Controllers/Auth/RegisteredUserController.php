<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use Illuminate\Validation\Rules\Password;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'min:2','max:255',  'regex:/^[A-Za-z\s]+$/'],
            'email' => ['required',   'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Password::min(8)->letters()    
                                                             ->numbers()
                                                           ->symbols()],
            'password_confirmation'=>['required', 'same:password']
            ],
    
          [
        'name.required' => 'Name is required!', 
        'name.regex' => 'Name may only contain letters.', 
        'email.unique' => 'This email is already registered!', 
        'password.min' => 'Password must be at least 8 characters.
                          At least one Symbol and Numbers.', 
        'password.letters' => 'Password must contain at least one letter.', 
        'password.numbers' => 'Password must contain at least one number.', 
        'password.symbols' => 'Password must contain at least one symbol.', 

        'password_confirmation.required' => 'Please Confirm password',

        'password_confirmation.same' => 'Password Dont Match!'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Mail::to($user->email)->send(new WelcomeMail($user));
        event(new Registered($user));

        Auth::login($user);

        return redirect(route('books.index', absolute: false));
    }
}
