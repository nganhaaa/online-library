@extends('admin.dashboard')

@section('content')
<div class="container">
    <h1>Edit Book</h1>
    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="book_id">Book ID</label>
            <input type="text" name="book_id" class="form-control" value="{{ $book->book_id }}" required>
        </div>
        <div class="form-group">
            <label for="book_name">Book Name</label>
            <input type="text" name="book_name" class="form-control" value="{{ $book->book_name }}" required>
        </div>
        <div class="form-group">
            <label for="age_group_id">Age Group ID</label>
            <input type="text" name="age_group_id" class="form-control" value="{{ $book->age_group_id }}" required>
        </div>
        <div class="form-group">
            <label for="publisher_id">Publisher ID
