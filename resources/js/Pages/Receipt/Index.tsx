import { Link, router } from '@inertiajs/react';
import { PaginatedBooks } from '@/types';
import { PropsWithChildren, useState } from 'react';

interface BookListProps extends PropsWithChildren<{}> {
    books: PaginatedBooks;
    hasSidebar: boolean; // Add a prop to indicate if the sidebar is present
}

export default function Index({ books, hasSidebar }: BookListProps) {
    const [submittingBookId, setSubmittingBookId] = useState<number | null>(null);

    const handleDelete = async (bookId: number) => {
        setSubmittingBookId(bookId);
        try {
            router.post(route("cart.add", { bookId, quantity: 1 }));
        } catch (error) {
            console.error('Error adding to cart:', error);
            alert('An error occurred while adding the book to the cart. Please try again later.');
        } finally {
            setSubmittingBookId(null);
        }
    };

    return (
        <div>
            {/* Adjust the number of columns based on the presence of the sidebar */}
            <div className={`container mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-${hasSidebar ? '3' : '4'} xl:grid-cols-${hasSidebar ? '4' : '5'} gap-10 p-5`}>
                {books.data.map((book) => (
                    <div
                        key={book.id}
                        className="mb-4 flex flex-col justify-between w-full p-4 border border-gray-300 rounded-lg text-center transition-transform transform hover:scale-105 h-full"
                    >
                        <Link href={route('book.show', book.id)} className="block">
                            <img
                                src={`/storage/${book.image}`}
                                alt={book.name}
                                className="w-full h-auto"
                            />
                            <div className="mt-2 font-bold text-md font-serif">{book.name}</div>
                        </Link>
                        <button
                            onClick={() => handleAddToCart(book.id)}
                            className="inline-block py-2 px-4 font-bold text-white bg-[#f05fed] rounded hover:bg-[#dc00c2] transition-colors w-full mt-2"
                            disabled={submittingBookId === book.id}
                        >
                            {submittingBookId === book.id ? 'Adding...' : 'Add to Cart'}
                        </button>
                    </div>
                ))}
            </div>
        </div>
    );
}
