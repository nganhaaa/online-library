@extends('layouts.app')

@section('content')
<main class="flex w-full">
    <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-10 p-5">
        @foreach($books as $book)
        <a href="{{ route('book.show', ['id' => $book->book_id]) }}" class="mb-4">
            <div class="flex flex-col justify-between w-full p-4 border border-gray-300 rounded-lg text-center transition-transform transform hover:scale-105 h-full bg-[#f9b6f8] ">
                <div>
                    <img src="{{ asset('storage/'.$book->image) }}" alt="{{ $book->book_name }}" class="w-full h-auto">
                    <div class="mt-2 font-bold text-md font-serif">{{ $book->book_name }}</div>
                </div>
                <form action="{{ route('cart.add', ['book' => $book->book_id]) }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit" class="inline-block py-2 px-4 font-bold text-white bg-[#f05fed] rounded hover:bg-[#dc00c2] transition-colors w-full">
                        Add to Cart
                    </button>
                </form>
            </div>
        </a>
        @endforeach
    </div>
</main>
@endsection
