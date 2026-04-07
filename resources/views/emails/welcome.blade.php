<div style="text-align:center; font-family: Arial, sans-serif;">

<img src="{{ asset('storage/books/cover.jpg') }}" width="200">

<h2>Welcome {{ $user->name }}!</h2>

<p>Your account was created successfully!</p>

<p>
You received <strong>{{ $user->points ?? 0 }}</strong> bonus points.
</p>

<p>Enjoy our BookShop 📚</p>

</div>
