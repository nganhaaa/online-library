@extends('layouts.app')

@section('content')
<div class="cart-container">
    <h1>Your Cart</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Book Image</th>
                <th>Book Name</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cartItems as $item)
            <tr>
                <td>
                    <img src="{{ asset('storage/'.$item['book']->image) }}" alt="{{ $item['book']->book_name ?? 'Unknown Book' }}" class="cart-image">
                </td>
                <td>{{ $item['book']->book_name ?? 'Unknown Book' }}</td>
                <td>
                    <form action="{{ route('cart.update', [$item['book']->book_id ?? '']) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="input-group quantity-control">
                            <button type="submit" name="action" value="decrement" class="btn btn-outline-secondary">-</button>
                            <input type="text" name="quantity" value="{{ $item['quantity'] }}" class="form-control quantity-input" readonly>
                            <button type="submit" name="action" value="increment" class="btn btn-outline-secondary">+</button>
                        </div>
                    </form>
                </td>
                <td>
                    <form action="{{ route('cart.remove', [$item['book']->book_id ?? '']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <form action="{{ route('cart.borrow') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Create Borrowing Receipt</button>
    </form>
</div>

<style>
    .cart-container {
        margin-top: 20px;
        padding: 20px;
        background-color: #f8f9fa;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .table th, .table td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .cart-image {
        max-width: 100px; 
        height: auto;
    }

    .quantity-control {
        display: flex;
        align-items: center;
    }

    .quantity-input {
        display: inline-block;
        padding: 10px 15px;
        width: 50px;
        text-align: center;
        border: 1px solid #ccc;
        border-radius: 0;
    }

    .input-group .btn {
        display: inline-block;
        border: 1px solid #ccc;
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
@endsection
