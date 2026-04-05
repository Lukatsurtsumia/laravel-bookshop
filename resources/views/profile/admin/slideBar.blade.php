<div x-data="{ open:false }" class="md:hidden">

<!-- MENU BUTTON -->
<button
@click="open = true"
class="text-gray-300 text-2xl">
☰
</button>

<!-- OVERLAY -->
<div
x-show="open"
@click="open = false"
class="fixed inset-0 bg-black/50 z-40">
</div>

<!-- SIDEBAR -->
<div
x-show="open"
x-transition
class="fixed top-0 left-0 h-full w-64 bg-[#111116] border-r border-gray-800 z-50 p-6">

<!-- CLOSE BUTTON -->
<button
@click="open = false"
class="text-gray-400 text-xl mb-6">
✕
</button>

<nav class="space-y-4">
@if (auth()->user()->isAdmin())
<a href="{{ route('admin.info') }}" class="block hover:text-amber-400">
Dashboard
</a>

<a href="{{ route('admin.books.index') }}" class="block hover:text-amber-400">
Books
</a>

<a href="{{ route('admin.users.index') }}" class="block hover:text-amber-400">
Users
</a>

<a href="{{ route('admin.reviews.index') }}" class="block hover:text-amber-400">
Reviews
</a>
@else

<a href="{{ route('user.index') }}" class="block hover:text-amber-400">
My DaShboard
</a>

<a href="{{ route('user.show', auth()->user()->id ) }}" class="block hover:text-amber-400">
My Reviews
</a>
<a href="{{ route('user.history') }}" class="block hover:text-amber-400">
History
</a>
@endif


</nav>

</div>

</div>
