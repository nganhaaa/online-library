import Dropdown from "@/Components/Dropdown";
import DropdownOnHover from "./DropdownOnHover";

interface DataWrapper {
    data: { id: number; name: string }[];  // Define the type of data items properly
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
    return (
        <DropdownOnHover>
            <DropdownOnHover.Trigger>
                <button className="hover:text-gray-400">{title}</button>
            </DropdownOnHover.Trigger>
            <DropdownOnHover.Content align="left">
                {/* Show the first 5 items */}
                {data.data.slice(0, 5).map((item) => (
                    <DropdownOnHover.Link key={item.id} href={`/${title.toLowerCase()}/${item.id}`}>
                        {item.name}
                    </DropdownOnHover.Link>
                ))}

                {/* Conditionally render the "More" link if needed */}
                {handleDataLength(data, title)}
            </DropdownOnHover.Content>
        </DropdownOnHover>
    );
}
