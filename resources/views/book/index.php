@extends('layouts.app')

@section('content')
    <div class="book-container">
        <!-- Example books, replace with dynamic content as needed -->
        @foreach($books as $book)
        <div class="book">
            <img src="{{ asset('images/' . $book->image) }}" alt="{{ $book->book_name }}">
            <div class="book-title">{{ $book->book_name }}</div>
            <!-- Assuming author is a property or method on the Book model -->
            <div class="book-author">{{ $book->author }}</div>
        </div>
        @endforeach
    </div>
@endsection

<style>
    .book-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        padding: 20px;
    }

    .book {
        width: 200px;
        margin: 10px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        text-align: center;
        transition: transform 0.2s;
    }

    .book img {
        width: 100%;
        height: auto;
    }

    .book:hover {
        transform: scale(1.05);
    }

    .book-title {
        font-size: 16px;
        font-weight: bold;
        margin: 10px 0;
    }

    .book-author {
        color: #555;
        margin-bottom: 10px;
    }
</style>
