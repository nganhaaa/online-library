import { useEffect, useState } from "react";
import { Link, router } from "@inertiajs/react";
import { Genre, Author, Publisher, AgeGroup, HeaderProps } from "@/types";
import DropdownWithData from "./DropdownWithData";
import DropdownOnHover from "./DropdownOnHover";
import ApplicationLogo from "./ApplicationLogo";

export default function Header({
    genres,
    authors,
    publishers,
    agegroups
}: HeaderProps) {
    const [open, setOpen] = useState(false);
    const [isLoading, setIsLoading] = useState(false);

    // Function to handle logout
    const handleLogout = async (e: React.FormEvent) => {
        e.preventDefault(); // Prevent the default form submission
        setIsLoading(true);
        try {
            await router.post(route('logout')); // Assuming your backend uses DELETE for logout
        } catch (err) {
            console.error('Error logging out:', err);
            alert('Failed to log out.');
        } finally {
            setIsLoading(false);
        }
    };

    return (
        <header className="w-full mb-14">
            <nav className="fixed left-0 right-0 top-0 z-40 w-full bg-white shadow">
                <div className="container mx-20 flex items-center justify-between px-10 py-4">
                    {/* Mobile menu button */}
                    <div className="mr-35 block lg:hidden left-0 static">
                        <button
                            onClick={() => setOpen(!open)}
                            className="text-gray-800 hover:text-gray-600 focus:outline-none"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                strokeWidth={1.5}
                                stroke="currentColor"
                                className="h-6 w-6"
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                            </svg>
                        </button>
                    </div>

                    {/* Logo */}
                    <div>
                        <Link href="/dashboard" className="font-serif text-2xl">
                        <ApplicationLogo className=" w-40 h-14 fill-current text-gray-500" />
                        </Link>
                    </div>

                    {/* Guide link (visible on larger screens) */}
                    <div className="hidden lg:flex">
                        <Link href="/dashboard">GUIDE</Link>
                    </div>

                    {/* Dropdowns */}
                    <DropdownWithData title={"Genre"} data={genres} />
                    <DropdownWithData title={"Authors"} data={authors} />
                    <DropdownWithData title={"Publisher"} data={publishers} />
                    <DropdownWithData title={"Age Group"} data={agegroups} />

                    {/* Icons */}
                    <div className="hidden lg:flex space-x-4">
                        <Link href="#">
                            <i className="fas fa-search"></i>
                        </Link>
                        <Link href="/cart">
                            <i className="fas fa-shopping-cart"></i>
                        </Link>

                        <DropdownOnHover>
                            <DropdownOnHover.Trigger>
                                <i className="fas fa-user"></i>
                            </DropdownOnHover.Trigger>

                            <DropdownOnHover.Content>
                                <DropdownOnHover.Link
                                    href="/profile"
                                    className="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                >
                                    Profile
                                </DropdownOnHover.Link>

                                <DropdownOnHover.Link
                                    href="/receipt"
                                    className="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                >
                                    History
                                </DropdownOnHover.Link>

                                <form onSubmit={handleLogout} className="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    <button
                                        type="submit"
                                        className="w-full text-left"
                                        disabled={isLoading}
                                    >
                                        {isLoading ? "Logging Out..." : "Log Out"}
                                    </button>
                                </form>
                            </DropdownOnHover.Content>
                        </DropdownOnHover>
                    </div>
                </div>
            </nav>
        </header>
    );
}
