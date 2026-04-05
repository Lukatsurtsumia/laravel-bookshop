<div style="text-align:center; font-family: Arial, sans-serif;"> 
@if(app()->environment('local'))
    <img src="{{ $message->embed(public_path('storage/books/cover.jpg')) }}" width="150">
@else
    <img src="{{ asset('storage/books/cover.jpg') }}" width="200">
@endif
<h2>Welcome {{ $user->name }}!</h2>

<p>Your account was created successfully!</p>

<p>
You received <strong>{{ $user->points }}</strong> bonus points.
</p>

<p>Enjoy our BookShop 📚</p>
 </div>