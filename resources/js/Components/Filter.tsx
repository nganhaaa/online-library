import { Link, router } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Book, HeaderProps, PageProps } from "@/types";
import { useState, useRef } from "react";
import TextInput from "@/Components/TextInput";

interface BookShowProps {
    data: Book;
}

interface FilterProps {
    book: BookShowProps;
    queryParam: string;
    index?: number
}

export default function Filter({ book, queryParam, index }: FilterProps) {
    const [isSubmitting, setIsSubmitting] = useState<boolean>(false);
    const [quantity, setQuantity] = useState<string | number>(1); // Allow both number and empty string
    const [submittingBookId, setSubmittingBookId] = useState<number | null>(
        null
    );
    const [error, setError] = useState<string | null>(null);
    const quantityRef = useRef<HTMLInputElement>(null);

    const handleAddToCart = async (bookId: number) => {
        setIsSubmitting(true);
        setSubmittingBookId(bookId);
        setError(null); // Clear any previous error
        try {
            const parsedQuantity = parseInt(quantity as string);
            if (!isNaN(parsedQuantity)) {
                router.post(
                    route("cart.add", { bookId, quantity: parsedQuantity })
                );
            }
        } catch (error) {
            console.error("Error adding to cart:", error);
            setError("Failed to add book to cart. Please try again.");
        } finally {
            setIsSubmitting(false);
            setSubmittingBookId(null);
        }
    };

    const handleDecrement = () => {
        const quantityNum = Math.max(
            1,
            (parseInt(quantity as string) || 1) - 1
        );
        setQuantity(quantityNum);
        setError(null);
    };

    const handleIncrement = () => {
        const quantityNum = parseInt(quantity as string) || 1;
        if (quantityNum >= book.data.available) {
            setError("Quantity exceeds available stock.");
            return;
        }
        setQuantity(quantityNum + 1);
        setError(null); // Clear any previous error
    };

    const handleQuantityInput = (
        event: React.ChangeEvent<HTMLInputElement>
    ) => {
        const value = event.target.value;
        // Allow empty string and check for a valid number input
        if (value === "" || /^\d*$/.test(value)) {
            if (value !== "" && parseInt(value) > book.data.available) {
                setQuantity(book.data.available);
                setError("Quantity exceeds available stock.");
                return;
            }
            if (value !== "" && parseInt(value) === 0) {
                setQuantity(1);
            } else {
                setQuantity(value); // Allow empty string or valid number
            }
        }
        setError(null); // Clear any previous error
    };

    const handleOutOfStock = (available: number) => {
        if (available > 0) {
            return (
                <button
                    onClick={() => handleAddToCart(book.data.id)}
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
       
            <div className="container mx-auto p-4">
                <div className="mb-4 p-4 border border-gray-300 rounded-lg flex">
                    <div className="flex flex-col flex-grow ml-4">
                        <div className="mt-2 font-bold text-3xl">
                            {queryParam}
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
                                {book.data.authors.length > 0 ? (
                                    book.data.authors.join(", ")
                                ) : (
                                    <span className="text-sm text-gray-600">
                                        No authors available
                                    </span>
                                )}
                            </span>
                        </div>

                        <div className="mt-2 font-bold">
                            Genre:&nbsp;
                            <span className="font-normal">
                                {" "}
                                {book.data.genres.length > 0 ? (
                                    book.data.genres.join(", ")
                                ) : (
                                    <span className="text-sm text-gray-600">
                                        No genres available
                                    </span>
                                )}
                            </span>
                        </div>

                        <div className="flex items-center mt-4 space-x-2">
                            <div className="flex items-center border border-gray-300 rounded-md">
                                <button
                                    onClick={handleDecrement}
                                    className="px-4 py-2 h-10"
                                    disabled={
                                        parseInt(quantity as string) === 1
                                    }
                                >
                                    -
                                </button>
                                <TextInput
                                    type="text"
                                    name="quantity"
                                    value={quantity}
                                    onChange={handleQuantityInput} // Handles typing in the input
                                    className="w-16 h-10 text-center border-none"
                                    ref={quantityRef}
                                />
                                <button
                                    onClick={handleIncrement}
                                    className="px-4 py-2 h-10"
                                >
                                    +
                                </button>
                            </div>
                            {handleOutOfStock(book.data.available)}
                        </div>

                        {error && (
                            <div className="mt-2 text-red-500">{error}</div>
                        )}
                    </div>
                </div>
            </div>
    );
}
