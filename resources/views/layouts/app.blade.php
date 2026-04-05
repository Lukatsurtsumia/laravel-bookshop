<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Book Shop</title>

<script src="https://cdn.tailwindcss.com"></script>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/3Dbook.css') }}">
<script src="{{ asset('js/3Dbook.js') }}" defer></script>
<script src="{{ asset('js/cart.js') }}" defer></script>
@livewireStyles
</head>

<body class="m-0 p-0">

@yield('content')

@livewireScripts
</body>
</html>
