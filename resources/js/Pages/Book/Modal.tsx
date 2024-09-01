import { Book } from "@/types";
import { Dispatch, SetStateAction } from "react";

interface BookModalProps {
    book: Book | null;
    isOpen: boolean;
    onClose: () => void;
}

export default function BookModal({ book, isOpen, onClose }: BookModalProps) {
    if (!isOpen || !book) return null;

    return (
        <div
            className="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
            onClick={onClose}
        >
            <div
                className="bg-white p-4 rounded-lg w-full md:w-1/2"
                onClick={(e) => e.stopPropagation()} // Prevent click from closing modal
            >
                <button
                    className="absolute top-2 right-2 text-gray-500"
                    onClick={onClose}
                >
                    &times;
                </button>
                <div className="flex flex-col md:flex-row">
                    <div className="w-full md:w-1/2">
                        <img
                            src={`/storage/${book.data.image}`}
                            alt={book.data.name}
                            className="w-full h-auto rounded-md"
                        />
                    </div>
                    <div className="w-full md:w-1/2 md:pl-4 mt-4 md:mt-0">
                        <div className="text-xl font-bold font-serif">{book.data.name}</div>
                        <p className="text-sm text-gray-600">{book.data.description}</p>
                        <p className="font-semibold">Publisher: {book.data.publisher}</p>
                        <p className="font-semibold">Age group: {book.data.age_group}</p>
                        <div className="mt-2">
                            <div className="font-semibold">Author:&nbsp;
                                {book.data.authors.length > 0 ? (
                                    book.data.authors.join(', ')
                                ) : (
                                    <span className="text-sm text-gray-600">No authors available</span>
                                )}
                            </div>
                            <div className="font-semibold mt-1">Genre:&nbsp;
                                {book.data.genres.length > 0 ? (
                                    book.data.genres.join(', ')
                                ) : (
                                    <span className="text-sm text-gray-600">No genres available</span>
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
