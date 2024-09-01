import React from 'react';
import { Link } from '@inertiajs/react';

export default function Footer() {
    return (
        <footer className="w-full bg-[#2e2e2e]">
            <div className="container mx-20 mb-auto flex flex-wrap items-start justify-between px-10 py-4 text-white">
                <div className="">
                    <h3>LOGO</h3>
                    <p>Address: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <p>Support: <br /> Phone: 0987654321 <br /> Email: abc@gmail.com</p>
                </div>
                <div className="">
                    <h3>Policies</h3>
                    <ul>
                        <li><Link href="/privacy-policy">Privacy Policy</Link></li>
                        <li><Link href="/terms-of-service">Terms of Service</Link></li>
                        <li><Link href="/refund-policy">Refund Policy</Link></li>
                        <li><Link href="/shipping-policy">Shipping Policy</Link></li>
                        <li><Link href="/faqs">FAQs</Link></li>
                    </ul>
                </div>
                <div className="">
                    <h3>Customer Support</h3>
                    <ul>
                        <li><Link href="/contact-us">Contact Us</Link></li>
                        <li><Link href="/returns">Returns</Link></li>
                        <li><Link href="/order-tracking">Order Tracking</Link></li>
                        <li><Link href="/help-center">Help Center</Link></li>
                        <li><Link href="/live-chat">Live Chat</Link></li>
                    </ul>
                </div>
                <div className="">
                    <h3>More</h3>
                    <div className="space-x-2">
                        <a href="#"><i className="fab fa-facebook-f"></i></a>
                        <a href="#"><i className="fab fa-instagram"></i></a>
                        <a href="#"><i className="fab fa-twitter"></i></a>
                        <a href="#"><i className="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </footer>
    );
}
