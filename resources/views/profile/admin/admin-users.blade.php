@extends('layouts.admin')

@section('content')

<main class="flex-1 p-4 md:p-8 max-w-7xl mx-auto w-full space-y-8">

    <!-- Title -->
    <h1 class="text-2xl font-serif text-amber-400">
        Users Management
    </h1>

    <!-- SEARCH -->
    <form action="{{ route('admin.users.index') }}" method="GET"
        class="flex flex-col md:flex-row gap-3 items-stretch md:items-center">

        <div class="relative flex-1">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by Name and Email..."
                class="w-full pl-10 pr-4 py-3
                       bg-[#111118] border border-gray-700
                       rounded-xl
                       text-sm text-gray-200
                       placeholder-gray-500
                       focus:outline-none
                       focus:ring-2 focus:ring-amber-500
                       focus:border-amber-500
                       transition">

            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                🔍
            </span>
        </div>

        <button
            type="submit"
            class="bg-amber-500 hover:bg-amber-400
                   text-black font-medium
                   px-6 py-3
                   rounded-xl
                   shadow-md
                   transition whitespace-nowrap">
            Search
        </button>
    </form>

    <!-- USERS TABLE (Desktop) -->
    <div class="hidden md:block bg-[#17171d] border border-gray-800 rounded-xl overflow-x-auto">
        <table class="w-full text-center">

            <thead class="bg-[#1c1c24] text-gray-400 text-sm text-center">
                <tr>
                    <th class="p-4">User</th>
                    <th class="p-4">Email</th>
                    <th class="p-4">Comments</th>
                    <th class="p-4">Role</th>
                    <th class="p-4 text-center">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-800">
                @foreach ($users as $user)
                <tr class="hover:bg-[#1c1c24]">

                    <td class="p-4 text-white">
                        {{ $user->name }}
                    </td>

                    <td class="p-4 text-gray-400">
                        {{ $user->email }}
                    </td> 
                     <td class="p-1 text-blue-400">
                        {{ $user->reviews()->count() }} #
                    </td>


                    <td class="p-4">
                        <span class="bg-amber-500 text-black text-xs px-2 py-1 rounded">
                            {{ $user->is_admin ? 'admin' : 'user' }}
                        </span>
                    </td>

                    <td class="p-4">
                        <div class="flex justify-center items-center gap-4">
                            
                            @if($user->is_admin)
                                <div class="text-green-600">Admin</div>
                            @else
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button 
                                        onclick="return confirm('Are you sure you want to delete this user?')" 
                                        class="text-red-400 text-sm hover:underline">
                                        Delete
                                    </button>
                                </form>
                            @endif

                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <!-- MOBILE CARDS -->
    <div class="md:hidden space-y-4">
        @foreach ($users as $user)

        <div class="bg-[#17171d] border border-gray-800 rounded-xl p-4 shadow-md">

            <!-- Top -->
            <div class="flex justify-between items-center mb-2">
                <span class="text-white font-medium">
                    {{ $user->name }}
                </span>

                <span class="bg-amber-500 text-black text-xs px-2 py-1 rounded">
                    {{ $user->is_admin ? 'admin' : 'user' }}
                </span>
            </div>

            <!-- Email -->
            <p class="text-gray-400 text-sm mb-3">
                {{ $user->email }}
            </p>
             <p class="text-blue-400 text-sm mb-3">
                {{ $user->reviews()->count() }} comments
            </p>

            <!-- Actions -->
            <div class="flex justify-end">
                @if($user->is_admin)
                    <div class="text-green-600">Admin</div>
                @else
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button 
                            onclick="return confirm('Are you sure you want to delete this user?')" 
                            class="text-red-400 text-sm hover:underline">
                            Delete
                        </button>
                    </form>
                @endif
            </div>

        </div>

        @endforeach
    </div>

    <!-- PAGINATION -->
    <div class="mt-10">
        @include('components.pagination', ['paginator' => $users])
    </div>

</main>

@endsection