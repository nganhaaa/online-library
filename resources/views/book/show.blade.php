@extends('layouts.app')

@section('title', $book->book_name)

@section('content')
    <div class="container">
        <!-- Centering the title -->
        <h2 class="book-title">{{ $book->book_name }}</h2>
        
        <!-- Add to Cart Button -->
        <div class="add-to-cart">
            <form action="{{ route('cart.add', ['book' => $book->book_id]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Add to Cart</button>
            </form>
        </div>
        
        <div class="book-details">
            <!-- Image on the left -->
            <div class="book-image">
                <strong>Image:</strong>
                @if($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->book_name }}" style="max-width: 300px; height: auto;" />
                @else
                    <p>No image available</p>
                @endif
            </div>
            
            <!-- Details on the right -->
            <div class="book-info">
                <div>
                    <strong>Book ID:</strong> {{ $book->book_id }}
                </div>
                <div>
                    <strong>Publication Year:</strong> {{ $book->publication_year }}
                </div>
                <div>
                    <strong>Available:</strong> {{ $book->available ? 'Yes' : 'No' }}
                </div>
                <div>
                    <strong>Quantity:</strong> {{ $book->quantity }}
                </div>
                <div>
                    <strong>Price:</strong> ${{ number_format($book->price, 2) }}
                </div>
                {{-- Uncomment these sections if needed --}}
                {{-- 
                <div>
                    <strong>Age Group:</strong> {{ $book->ageGroup->age_group_name ?? 'N/A' }}
                </div>
                <div>
                    <strong>Publisher:</strong> {{ $book->publisher->publisher_name ?? 'N/A' }}
                </div>
                <div>
                    <strong>Authors:</strong>
                    <ul>
                        @foreach ($book->authors as $author)
                            <li>{{ $author->first_name }} {{ $author->last_name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <strong>Genres:</strong>
                    <ul>
                        @foreach ($book->genres as $genre)
                            <li>{{ $genre->genre_name }}</li>
                        @endforeach
                    </ul>
                </div>
                --}}
            </div>
        </div>
    </div>
@endsection

<style>
    .container {
        padding: 20px;
    }

    .book-title {
        text-align: center; Center the title
        margin-bottom: 20px;
    }

    .add-to-cart {
        text-align: center; /* Center the button */
        margin-bottom: 20px; /* Space between button and other details */
    }

    .book-details {
        display: flex;
        align-items: flex-start; /* Align items to the start of the container */
        gap: 20px; /* Space between image and details */
    }

    .book-image {
        flex: 1; /* Allow image to take up available space */
    }

    .book-info {
        flex: 2; /* Allow info to take up more space than the image */
    }

    .book-details img {
        margin-bottom: 15px;
        display: block; /* Ensure image behaves like a block element */
    }

    .book-details div {
        margin-bottom: 10px;
    }

    .book-details strong {
        display: inline-block;
        width: 150px; /* Adjust width as needed */
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
