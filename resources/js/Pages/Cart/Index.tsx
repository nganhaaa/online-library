import React, { useEffect, useState } from 'react';
import { router, Link } from '@inertiajs/react';
import Authenticated from '@/Layouts/AuthenticatedLayout';
import { HeaderProps, PageProps } from '@/types';
import QuantityInput from '@/Components/QuantityInput';

interface Book {
    id: number;
    image: string;
    name: string;
    available: number;
}

interface CartItem {
    book: Book;
    quantity: number;
}

interface CartProps extends PageProps {
    cartItems?: { [key: number]: { book_id: string; quantity: number; book: Book } };
    success?: string;
    error?: string;
    headerProps: HeaderProps;
}

export default function Index({ auth, headerProps, cartItems = {}, success, error }: CartProps) {
    const [localCartItems, setLocalCartItems] = useState<{ [key: number]: CartItem }>(cartItems);
    const [isLoading, setIsLoading] = useState(false);

    useEffect(() => {
        if (error) {
            alert(`Error: ${error}`);
        }

        if (success) {
            alert(`Success: ${success}`);
        }
    }, [error, success]);

    const handleRemove = async (bookId: number) => {
        setIsLoading(true);
        try {
            await router.delete(route('cart.remove', { bookId }));
            setLocalCartItems(prevItems => {
                const updatedItems = { ...prevItems };
                delete updatedItems[bookId];
                return updatedItems;
            });
        } catch (err) {
            console.error('Error removing item:', err);
            alert('Failed to remove the item from the cart.');
        } finally {
            setIsLoading(false);
        }
    };

    const handleQuantityChange = async (bookId: number, quantity: number) => {
        if (quantity <= 0) return; // Prevent setting invalid quantity
        setIsLoading(true);
        try {
            await router.patch(route('cart.update', { id: bookId }), { quantity });
            setLocalCartItems(prevItems => ({
                ...prevItems,
                [bookId]: { ...prevItems[bookId], quantity }
            }));
        } catch (err) {
            console.error('Error updating quantity:', err);
            alert('Failed to update the item quantity.');
        } finally {
            setIsLoading(false);
        }
    };
    

    const handleCreateBorrowingReceipt = async () => {
        setIsLoading(true);
        try {
            router.post(route('cart.borrow'));
        } catch (err) {
            console.error('Error creating borrowing receipt:', err);
            alert('Failed to create borrowing receipt.');
        } finally {
            setIsLoading(false);
        }
    };

    const cartItemsArray = Object.values(localCartItems);

    return (
        <Authenticated
            user={auth.user}
            headerProps={headerProps}
            header={
                <h2 className="font-medium text-gray-800 leading-tight">
                    <Link href="/dashboard">Dashboard</Link>
                    <span className="text-gray-400">/ Your cart</span>
                </h2>
            }
        >
            <div className="mt-5 p-5 border border-gray-300 rounded-md">
                <h1 className="text-xl font-semibold mb-4">Your Cart</h1>

                {success && (
                    <div className="mb-4 p-3 bg-green-100 text-green-800 border border-green-300 rounded-md">
                        {success}
                    </div>
                )}
                {error && (
                    <div className="mb-4 p-3 bg-red-100 text-red-800 border border-red-300 rounded-md">
                        {error}
                    </div>
                )}

                <table className="w-full border-collapse mt-4">
                    <thead>
                        <tr className='text-left'>
                            <th className="px-4 py-2 border-b">Book Image</th>
                            <th className="px-4 py-2 border-b">Book Name</th>
                            <th className="px-4 py-2 border-b">Quantity</th>
                            <th className="px-4 py-2 border-b">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {cartItemsArray.length > 0 ? (
                            cartItemsArray.map(item => (
                                <tr key={item.book.id}>
                                    <td className="px-4 py-2 border-b">
                                        <Link href={route('book.show', { id: item.book.id })}>
                                            <img
                                                src={`/storage/${item.book.image}`}
                                                alt={item.book.name}
                                                className="h-24 w-16 object-cover rounded-md"
                                            />
                                        </Link>
                                    </td>
                                    <td className="px-4 py-2 border-b">{item.book.name}</td>
                                    <td className="px-4 py-2 border-b">
                                        <QuantityInput
                                            data={item.book}
                                            quantity={item.quantity}
                                            setQuantity={quantity => handleQuantityChange(item.book.id, quantity)}
                                        />
                                    </td>
                                    <td className="px-4 py-2 border-b">
                                        <button
                                            onClick={() => handleRemove(item.book.id)}
                                            className="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600"
                                            disabled={isLoading}
                                        >
                                            {isLoading ? 'Removing...' : 'Remove'}
                                        </button>
                                    </td>
                                </tr>
                            ))
                        ) : (
                            <tr>
                                <td colSpan={4} className="px-4 py-2 border-b text-center">
                                    Your cart is empty.
                                </td>
                            </tr>
                        )}
                    </tbody>
                </table>

                <button
                    onClick={handleCreateBorrowingReceipt}
                    className="mt-5 px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600"
                    disabled={isLoading}
                >
                    {isLoading ? 'Creating...' : 'Create Borrowing Receipt'}
                </button>
            </div>
        </Authenticated>
    );
}
