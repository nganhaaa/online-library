import React from "react";
import TextInput from "@/Components/TextInput";
import { Book } from "@/types";

interface BookShowProps {
    data: Book;
    quantity: number; // Quantity comes from the parent component
    setQuantity: (quantity: number) => void; // Function to update quantity in the parent component
}

export default function QuantityInput({ data, quantity = 1, setQuantity }: BookShowProps) {

    const handleDecrement = () => {
        setQuantity(Math.max(1, quantity - 1));
    };

    const handleIncrement = () => {
        if (quantity >= data.available) {
            alert("Quantity exceeds available stock.");
        } else {
            setQuantity(quantity + 1);
        }
    };

    const handleQuantityInput = (event: React.ChangeEvent<HTMLInputElement>) => {
        const value = event.target.value;
        // Allow empty string, but only set valid numbers
        if (value === "") {
            setQuantity(1); // Default to 1 if input is cleared
        } else if (/^\d+$/.test(value)) { // Only allow digits
            const parsedValue = parseInt(value, 10);
            if (parsedValue > data.available) {
                setQuantity(data.available);
                alert("Quantity exceeds available stock.");
            } else if (parsedValue <= 0) {
                setQuantity(1);
            } else {
                setQuantity(parsedValue);
            }
        }
    };

    return (
        <div>
            <div className="flex items-center space-x-2">
                <div className="flex items-center border border-gray-300 rounded-md">
                    <button
                        onClick={handleDecrement}
                        className="px-4 py-2 h-10"
                        disabled={quantity === 1}
                    >
                        -
                    </button>
                    <TextInput
                        type="text"
                        name="quantity"
                        value={quantity.toString()} // Convert number to string for the input value
                        onChange={handleQuantityInput}
                        className="w-16 h-10 text-center border-none"
                    />
                    <button
                        onClick={handleIncrement}
                        className="px-4 py-2 h-10"
                    >
                        +
                    </button>
                </div>
            </div>
        </div>
    );
}
