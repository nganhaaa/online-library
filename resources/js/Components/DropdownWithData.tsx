import DropdownOnHover from "./DropdownOnHover";
import { ChevronDownIcon } from '@heroicons/react/24/solid';
import { router } from "@inertiajs/react";

interface DataWrapper {
    data: { id: number; name: string }[];
}

// Function to handle the case where there are more than 5 items
const handleDataLength = (data: DataWrapper, title: string) => {
    if (data.data.length > 5) {
        return (
            <DropdownOnHover.Link href={`/${title.toLowerCase()}/index`}>
                More
            </DropdownOnHover.Link>
        );
    }
    return null; 
};

export default function DropdownWithData({ title, data }: { title: string; data: DataWrapper }) {
    const handleLinkClick = (e: React.MouseEvent<HTMLAnchorElement>, id: number) => {
        e.preventDefault(); // Prevent the default link behavior
        
        // Use Inertia to send a GET request with dynamic query parameter

        // router.patch(route('cart.update', { id: bookId }), { quantity });
        const queryParam = `${title.toLowerCase().replace(" ", "_")}_id`;
        const url = `/book?${queryParam}=${id}`;
        console.log('URL:', url); // Log the URL to the console

        try {
            router.get(url); // Use the URL directly
            // router.get(route('book'))
        } catch (error) {
            console.error("Error navigating:", error);
        }
    };

    return (
        <DropdownOnHover>
            <DropdownOnHover.Trigger>
                <button className="hover:text-gray-400 hidden lg:flex">
                    {title}
                    <ChevronDownIcon className="w-5 mx-2 mt-1" />
                </button>
            </DropdownOnHover.Trigger>
            <DropdownOnHover.Content align="left">
                {/* Show the first 5 items */}
                {data.data.slice(0, 5).map((item) => (
                    <DropdownOnHover.Link 
                        key={item.id} 
                        href="#" 
                        onClick={(e) => handleLinkClick(e, item.id)} // Pass the event object
                    >
                        {item.name}
                    </DropdownOnHover.Link>
                ))}

                {/* Conditionally render the "More" link if needed */}
                {handleDataLength(data, title)}
            </DropdownOnHover.Content>
        </DropdownOnHover>
    );
}
