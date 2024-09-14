// src/components/Slide.tsx
import { SlideProps } from '@/types';
import React, { useState } from 'react';



export default function Slide({ items }: SlideProps) {
    const [currentIndex, setCurrentIndex] = useState<number>(0);

    const goToNextSlide = () => {
        setCurrentIndex((prevIndex) => (prevIndex + 1) % items.length);
    };

    const goToPrevSlide = () => {
        setCurrentIndex((prevIndex) => (prevIndex - 1 + items.length) % items.length);
    };

    return (
        <div className="relative overflow-hidden">
            <div
                className="flex transition-transform duration-500 ease-in-out"
                style={{ transform: `translateX(-${currentIndex * 100}%)` }}
            >
                {items.map((item, index) => (
                    <div key={index} className="flex-shrink-0 w-full">
                        <img
                            src={item.image}
                            alt={item.alt}
                            className="w-full h-64 object-cover"
                        />
                    </div>
                ))}
            </div>
            <button
                onClick={goToPrevSlide}
                className="absolute top-1/2 left-4 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full"
            >
                &#10094;
            </button>
            <button
                onClick={goToNextSlide}
                className="absolute top-1/2 right-4 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full"
            >
                &#10095;
            </button>
        </div>
    );
};


