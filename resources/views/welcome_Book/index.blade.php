@extends('layouts.app')

@section('title','Book Shop')

@section('content')

@include('welcome_Book.head')

@include('welcome_Book.3Dbook')

 
<livewire:book-shop />

@include('welcome_Book.footer')

@endsection