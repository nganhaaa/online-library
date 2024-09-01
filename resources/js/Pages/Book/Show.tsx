import { router } from "@inertiajs/react";
import { Book } from "@/types";
import { useEffect, useState } from "react";

export default function Show({ book }: { book: Book }) {
    const [isSubmitting, setIsSubmitting] = useState<boolean>(false);
//   useEffect(() => {
//         // Log the headerProps to see its structure
//         console.log('Header Props:', book);
//         // console.log('Genres:', headerProps.genres);
//     }, [book]);
    const handleAddToCart = async (bookId: number) => {
        setIsSubmitting(true);
        try {
            router.post(route("cart.add", bookId));
        } catch (error) {
            console.error("Error adding to cart:", error);
        } finally {
            setIsSubmitting(false);
        }
    };

    return (
        <div>
            <div className="container mx-auto h-full">
                <div className="mb-4 p-4 border border-gray-300 rounded-lg flex">
                   <div> <img
                        src={`/storage/${book.data.image}`}
                        alt={book.data.name}
                        className="w-full h-auto"
                    />
                    <div className="mt-2 font-bold text-md font-serif">{book.data.name}</div>
                    </div>
                    <div className="flex flex-col">
                    <p>Description: {book.data.description}</p>
                    <p>Publisher: {book.data.publisher}</p>
                    <p>Age group: {book.data.age_group}</p>
                    <div className="mt-2">
    Author:&nbsp;
    {book.data.authors.length > 0 ? (
        book.data.authors.join(', ')
    ) : (
        <span className="text-sm text-gray-600">No authors available</span>
    )}
</div>


<div className="mt-2">
    Genre:&nbsp;
    {book.data.genres.length > 0 ? (
        book.data.genres.join(', ')
    ) : (
        <span className="text-sm text-gray-600">No genres available</span>
    )}
</div>
                    <button
                        onClick={() => handleAddToCart(book.data.id)}
                        className="inline-block py-2 px-4 font-bold text-white bg-[#f05fed] rounded hover:bg-[#dc00c2] transition-colors w-full mt-2"
                    >
                        Add to Cart
                    </button></div>
                    
                </div>
            </div>
        </div>
    );
}
