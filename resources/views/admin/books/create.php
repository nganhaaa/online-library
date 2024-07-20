@extends('admin.dashboard')

@section('content')
<div class="container">
    <h1>Create Book</h1>
    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="book_id">Book ID</label>
            <input type="text" name="book_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="book_name">Book Name</label>
            <input type="text" name="book_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="age_group_id">Age Group ID</label>
            <input type="text" name="age_group_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="publisher_id">Publisher ID</label>
            <input type="text" name="publisher_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="publication_year">Publication Year</label>
            <input type="number" name="publication_year" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="available">Available</label>
            <input type="number" name="available" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
