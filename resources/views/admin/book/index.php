@extends('admin.dashboard')

@section('content')
<div class="container">
    <h1>Books</h1>
    <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Add New Book</a>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>ID</th>
                <th>Name</th>
                <th>Age Group</th>
                <th>Publisher</th>
                <th>Year</th>
                <th>Available</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td><img src="{{ asset('storage/book_images/' . $book->image) }}" alt="{{ $book->book_name }}" width="50"></td>
                    <td>{{ $book->book_id }}</td>
                    <td>{{ $book->book_name }}</td>
                    <td>{{ $book->age_group_id }}</td>
                    <td>{{ $book->publisher_id }}</td>
                    <td>{{ $book->publication_year }}</td>
                    <td>{{ $book->available }}</td>
                    <td>{{ $book->quantity }}</td>
                    <td>{{ $book->price }}</td>
                    <td>
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-info">Show</a>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
