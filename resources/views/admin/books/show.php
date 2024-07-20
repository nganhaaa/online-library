@extends('admin.dashboard')

@section('content')
<div class="container">
    <h1>Book Details</h1>
    <div class="card">
        <div class="card-header">
            <h2>{{ $book->book_name }}</h2>
        </div>
        <div class="card-body">
            <img src="{{ asset('storage/book_images/' . $book->image) }}" alt="{{ $book->book_name }}" class="img-fluid mb-3">
            <p><strong>ID:</strong> {{ $book->book_id }}</p>
            <p><strong>Age Group:</strong> {{ $book->age_group_id }}</p>
            <p><strong>Publisher:</strong> {{ $book->publisher_id }}</p>
            <p><strong>Publication Year:</strong> {{ $book->publication_year }}</p>
            <p><strong>Available:</strong> {{ $book->available }}</p>
            <p><strong>Quantity:</strong> {{ $book->quantity }}</p>
            <p><strong>Price:</strong> {{ $book->price }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection
