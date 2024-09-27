// Footer.jsx hoặc Footer.tsx
import React from 'react';
import { Link } from '@inertiajs/react';

export default function Footer() {
    return (
        <footer className="w-full bg-[#2e2e2e] mt-5">
            <div className="container mx-auto px-10 py-4 flex flex-wrap items-start justify-between text-white">
                <div className="">
                    <h3 className="text-lg font-semibold mb-2">LOGO</h3>
                    <p>Address: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <p>
                        Support:<br />
                        Phone: 0987654321<br />
                        Email: abc@gmail.com
                    </p>
                </div>
                <div className="">
                    <h3 className="text-lg font-semibold mb-2">Policies</h3>
                    <ul>
                        <li><Link href="/privacy-policy" className="hover:underline">Privacy Policy</Link></li>
                        <li><Link href="/terms-of-service" className="hover:underline">Terms of Service</Link></li>
                        <li><Link href="/refund-policy" className="hover:underline">Refund Policy</Link></li>
                        <li><Link href="/shipping-policy" className="hover:underline">Shipping Policy</Link></li>
                        <li><Link href="/faqs" className="hover:underline">FAQs</Link></li>
                    </ul>
                </div>
                <div className="">
                    <h3 className="text-lg font-semibold mb-2">Customer Support</h3>
                    <ul>
                        <li><Link href="/contact-us" className="hover:underline">Contact Us</Link></li>
                        <li><Link href="/returns" className="hover:underline">Returns</Link></li>
                        <li><Link href="/order-tracking" className="hover:underline">Order Tracking</Link></li>
                        <li><Link href="/help-center" className="hover:underline">Help Center</Link></li>
                        <li><Link href="/live-chat" className="hover:underline">Live Chat</Link></li>
                    </ul>
                </div>
                <div className="">
                    <h3 className="text-lg font-semibold mb-2">More</h3>
                    <div className="flex space-x-4">
                        <a href="#" aria-label="Facebook" className="hover:text-gray-400">
                            <i className="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" aria-label="Instagram" className="hover:text-gray-400">
                            <i className="fab fa-instagram"></i>
                        </a>
                        <a href="#" aria-label="Twitter" className="hover:text-gray-400">
                            <i className="fab fa-twitter"></i>
                        </a>
                        <a href="#" aria-label="YouTube" className="hover:text-gray-400">
                            <i className="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    );
}
