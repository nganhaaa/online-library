@extends('layouts.app')

@section('content')
<main class="">
    <div class="container mx-auto py-5">
        <!-- Include book.index view -->
        @include('book.index')
    </div>
</main>
@endsection
