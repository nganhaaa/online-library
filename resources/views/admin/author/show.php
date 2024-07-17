<div class="book-details">
    <h1>{{ $book->book_name }}</h1>
    <p>{{ $book->author }}</p>
    <p>{{ $book->description }}</p>
    @if ($book->image)
        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->book_name }}">
    @endif
</div>
