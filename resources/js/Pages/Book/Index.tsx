import { Link, router } from '@inertiajs/react';
import { Book } from '@/types';
import { PropsWithChildren, useState } from 'react';
import Pagination from '@/Components/Pagination';

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
  }

interface PaginatedBooks {
    data: Book[];
    meta: {
        links: PaginationLink[];
    };
};

export default function Index({ books }: PropsWithChildren<{ books: PaginatedBooks }>) {
    const [isSubmitting, setIsSubmitting] = useState<boolean>(false);

    const handleAddToCart = async (bookId: number) => {
        setIsSubmitting(true);
        try {
            await router.post(route("cart.add", bookId));
        } catch (error) {
            console.error('Error adding to cart:', error);
        } finally {
            setIsSubmitting(false);
        }
    };

    return (
        <div>
            <div className="container mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-10 p-5">
                {books.data.map((book) => (
                    <div
                        key={book.id}
                        className="mb-4 flex flex-col justify-between w-full p-4 border border-gray-300 rounded-lg text-center transition-transform transform hover:scale-105 h-full"
                    >
                        <Link href={`/books/${book.id}`} className="block">
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
                            disabled={isSubmitting}
                        >
                            {isSubmitting ? 'Adding...' : 'Add to Cart'}
                        </button>
                    </div>
                ))}
            </div>
            {/* Pass pagination links if available */}
            <Pagination links={books.meta.links} />
        </div>
    );
}
