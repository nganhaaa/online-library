<form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <!-- Other form fields -->
    <div class="form-group">
        <label for="image">Book Image:</label>
        <input type="file" class="form-control" name="image">
    </div>
    @if ($book->image)
        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->book_name }}" width="150">
    @endif
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
