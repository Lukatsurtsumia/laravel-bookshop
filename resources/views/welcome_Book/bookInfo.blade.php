@extends('layouts.app')

@section('content')

<livewire:book-info :bookId="$book->id" />
@endsection