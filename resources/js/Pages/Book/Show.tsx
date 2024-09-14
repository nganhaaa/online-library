import { Link, router } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Book, HeaderProps, PageProps } from "@/types";
import { useState } from "react";
import QuantityInput from "@/Components/QuantityInput";

interface BookShowProps {
    data: Book;
}

interface ShowProps extends PageProps {
    book: BookShowProps;
    headerProps: HeaderProps;
}

export default function Show({ book, auth, headerProps }: ShowProps) {
    const [isSubmitting, setIsSubmitting] = useState<boolean>(false);
    const [submittingBookId, setSubmittingBookId] = useState<number | null>(null);
    const [error, setError] = useState<string | null>(null);
    const [quantity, setQuantity] = useState<number>(1); // State to track quantity

    const handleAddToCart = async (bookId: number, quantity: number) => {
        setIsSubmitting(true);
        setSubmittingBookId(bookId);
        setError(null); // Clear any previous error
        try {
            router.post(route("cart.add", { bookId, quantity }));
        } catch (error) {
            console.error("Error adding to cart:", error);
            setError("Failed to add book to cart. Please try again.");
        } finally {
            setIsSubmitting(false);
            setSubmittingBookId(null);
        }
    };

    const handleOutOfStock = (available: number) => {
        if (available > 0) {
            return (
                <button
                    onClick={() => handleAddToCart(book.data.id, quantity)} // Use the quantity state
                    className="px-4 py-2 h-10 font-bold text-white bg-[#f05fed] rounded hover:bg-[#dc00c2] transition-colors w-full"
                    disabled={submittingBookId === book.data.id}
                >
                    {submittingBookId === book.data.id
                        ? "Adding..."
                        : "Add to Cart"}
                </button>
            );
        } else {
            return (
                <button
                    className="px-4 py-2 h-10 font-bold text-white bg-[#938d93] rounded w-full"
                    disabled={true}
                >
                    Out of stock
                </button>
            );
        }
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-medium text-gray-800 leading-tight ">
                    <Link href={"/dashboard"}>Dashboard</Link>
                    <span className="text-gray-400">/</span> <Link href={"/book"}>Book</Link>
                    <span className="text-gray-400">/ </span>
                    <span className="text-gray-400">{book.data.name}</span>
                </h2>
            }
            headerProps={headerProps}
        >
            <div className="container mx-auto p-4">
                <div className="mb-4 p-4 border border-gray-300 rounded-lg flex">
                    <div className="mr-4 flex-shrink-0">
                        <img
                            src={`/storage/${book.data.image}`}
                            alt={book.data.name}
                            className="h-64 w-48 object-cover rounded-md"
                        />
                    </div>
                    <div className="flex flex-col flex-grow ml-4">
                        <div className="mt-2 font-bold text-3xl">
                            {book.data.name}
                        </div>
                        <p className="mt-2 font-bold">Description:</p>
                        <p className="mt-0.5">{book.data.description}</p>
                        <p className="mt-1 font-bold">
                            Publisher:{" "}
                            <span className="font-normal">
                                {book.data.publisher}
                            </span>
                        </p>
                        <p className="mt-1 font-bold">
                            Age group:{" "}
                            <span className="font-normal">
                                {book.data.age_group}
                            </span>
                        </p>

                        <div className="mt-2 font-bold">
                            Author:&nbsp;
                            <span className="font-normal">
                                {book.data.authors.length > 0
                                    ? book.data.authors.join(", ")
                                    : "No authors available"}
                            </span>
                        </div>

                        <div className="mt-2 font-bold">
                            Genre:&nbsp;
                            <span className="font-normal">
                                {book.data.genres.length > 0
                                    ? book.data.genres.join(", ")
                                    : "No genres available"}
                            </span>
                        </div>

                        <div className="flex space-x-4 mt-4">
                            {/* QuantityInput will update the quantity state */}
                            <QuantityInput data={book.data} quantity={quantity} setQuantity={setQuantity} />
                            {handleOutOfStock(book.data.available)}
                        </div>

                        {error && (
                            <div className="mt-2 text-red-500">{error}</div>
                        )}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
