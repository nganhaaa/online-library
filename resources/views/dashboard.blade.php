@extends('layouts.app')

@section('content')
<main>
    <div class="book-container">
        <!-- Example books, replace with dynamic content as needed -->
        @foreach($books as $book)
        <div class="book">
            <img src="{{ asset('storage/'.$book->image) }}" alt="{{ $book->book_name }}">
            <div class="book-title">{{ $book->book_name }}</div>
            <form action="{{ route('cart.add', ['book' => $book->book_id]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Add to Cart</button>
            </form>
        </div>
        @endforeach
    </div>
</main>
@endsection

<style>
    .book-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px; /* Space between rows and columns */
        padding: 20px;
    }

    .book {
        width: 200px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        text-align: center;
        transition: transform 0.2s;
        position: relative;
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

    .btn {
        display: inline-block;
        padding: 10px 15px;
        font-size: 14px;
        font-weight: bold;
        color: #fff;
        background-color: #f05fed;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        transition: background-color 0.2s;
    }

    .btn:hover {
        background-color: #e71fd0;
    }
</style>
