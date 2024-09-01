import { useEffect, useState } from "react";
import { Link } from "@inertiajs/react";
import Dropdown from "@/Components/Dropdown";
import { Genre, Author, Publisher, AgeGroup, HeaderProps } from "@/types";
import DropdownWithData from "./DropdownWithData";
import DropdownOnHover from "./DropdownOnHover";

export default function Header({
    genres,
    authors,
    publishers,
    agegroups
}: HeaderProps) {
    const [open, setOpen] = useState(false);
    // useEffect(() => {
    //     // Log the headerProps to see its structure
    //     console.log('Header Props:', genres);
    //     // console.log('Genres:', headerProps.genres);
    // }, [genres]);
    return (
        <header className="w-full mb-14">
            <nav className="fixed left-0 right-0 top-0 z-40 w-full bg-white shadow">
                <div className="container mx-20 flex items-center justify-between px-10 py-4">
                    {/* Mobile menu button */}
                    <div className="mr-35 block lg:hidden">
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
                            LOGO
                        </Link>
                    </div>

                    {/* Guide link (visible on larger screens) */}
                    <div className="hidden lg:flex">
                        <Link href="/dashboard">GUIDE</Link>
                    </div>

                    
                    <DropdownWithData title={"Genre"} data={genres}/>
                    <DropdownWithData title={"Authors"} data={authors}/>
                    <DropdownWithData title={"Publisher"} data={publishers}/>
                    <DropdownWithData title={"Age Group"} data={agegroups}/>
                    

                    {/* Icons */}
                    <div className="flex space-x-4">
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
                                    href="#"
                                    className="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                >
                                    Profile
                                </DropdownOnHover.Link>

                                <DropdownOnHover.Link
                                    href="#"
                                    className="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                >
                                    History
                                </DropdownOnHover.Link>

                                <form
                                    action="/logout"
                                    method="POST"
                                    className="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                >
                                    <button
                                        type="submit"
                                        className="w-full text-left"
                                    >
                                        Log Out
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
