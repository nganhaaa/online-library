@foreach ($books as $book)
    <div class="book">
        <h2>{{ $book->book_name }}</h2>
        @if ($book->image)
            <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->book_name }}">
        @endif
        <p>{{ $book->author }}</p>
        <a href="{{ route('books.show', $book->id) }}">View Details</a>
    </div>
@endforeach
