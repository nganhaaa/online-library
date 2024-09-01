import { useState } from "react";
import { Link } from "@inertiajs/react";
import Dropdown from "@/Components/Dropdown";
import { Genre, Author, Publisher, AgeGroup, HeaderProps} from "@/types";

export default function Header({
    genres,
    authors,
    publishers,
    agegroups,
}: HeaderProps) {
    const [open, setOpen] = useState(false);

    return (
        <header className="w-full">
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

                    <Dropdown>
                        <Dropdown.Trigger>
                            <button className="hover:text-gray-400">
                                Genres
                            </button>
                        </Dropdown.Trigger>
                        <Dropdown.Content align="left">
                            {genres.slice(0, 5).map((genre) => (
                                <Dropdown.Link
                                    key={genre.id}
                                    href={`/genres/${genre.id}`}
                                >
                                    {genre.name}
                                </Dropdown.Link>
                            ))}
                            <Dropdown.Link
            href="#"
            className="block px-4 py-2 text-gray-700 hover:bg-gray-100"
        >
            More
        </Dropdown.Link>
                        </Dropdown.Content>
                    </Dropdown>

                    <Dropdown>
    <Dropdown.Trigger>
        <button className="hover:text-gray-400">
            Authors
        </button>
    </Dropdown.Trigger>
    <Dropdown.Content align="left">
        {authors.slice(0, 5).map((author) => (
            <Dropdown.Link
                key={author.id}
                href={`/authors/${author.id}`}
                className="block px-4 py-2 text-gray-700 hover:bg-gray-100"
            >
                {author.name}
            </Dropdown.Link>
        ))}
        <Dropdown.Link
            href="#"
            className="block px-4 py-2 text-gray-700 hover:bg-gray-100"
        >
            More
        </Dropdown.Link>
    </Dropdown.Content>
</Dropdown>


                    <Dropdown>
                        <Dropdown.Trigger>
                            <button className="hover:text-gray-400">
                                Publishers
                            </button>
                        </Dropdown.Trigger>
                        <Dropdown.Content align="left">
                            {publishers.map((publisher) => (
                                <Dropdown.Link
                                    key={publisher.id}
                                    href={`/publishers/${publisher.id}`}
                                >
                                    {publisher.name}
                                </Dropdown.Link>
                            ))}
                            <Dropdown.Link
            href="#"
            className="block px-4 py-2 text-gray-700 hover:bg-gray-100"
        >
            More
        </Dropdown.Link>
                        </Dropdown.Content>
                    </Dropdown>

                    <Dropdown>
                        <Dropdown.Trigger>
                            <button className="hover:text-gray-400">
                                Age Groups
                            </button>
                        </Dropdown.Trigger>
                        <Dropdown.Content align="left">
                            {agegroups.map((agegroup) => (
                                <Dropdown.Link
                                    key={agegroup.id}
                                    href={`/agegroups/${agegroup.id}`}
                                >
                                    {agegroup.name}
                                </Dropdown.Link>
                            ))}
                            <Dropdown.Link
            href="#"
            className="block px-4 py-2 text-gray-700 hover:bg-gray-100"
        >
            More
        </Dropdown.Link>
                        </Dropdown.Content>
                    </Dropdown>

                    {/* Icons */}
                    <div className="flex space-x-4">
                        <Link href="#">
                            <i className="fas fa-search"></i>
                        </Link>
                        <Link href="/cart">
                            <i className="fas fa-shopping-cart"></i>
                        </Link>

                        <Dropdown>
                        <Dropdown.Trigger>
    <i className="fas fa-user"></i>
</Dropdown.Trigger>

<Dropdown.Content>
    <Dropdown.Link
        href="#"
        className="block px-4 py-2 text-gray-700 hover:bg-gray-100"
    >
        Profile
    </Dropdown.Link>

    <Dropdown.Link
        href="#"
        className="block px-4 py-2 text-gray-700 hover:bg-gray-100"
    >
        History
    </Dropdown.Link>

    <form action="/logout" method="POST" className="block px-4 py-2 text-gray-700 hover:bg-gray-100">
        <button type="submit" className="w-full text-left">
            Log Out
        </button>
    </form>
</Dropdown.Content>
</Dropdown>

                    </div>
                </div>
            </nav>
        </header>
    );
}
