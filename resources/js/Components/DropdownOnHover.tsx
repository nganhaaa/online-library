import { useState, createContext, useContext, PropsWithChildren, Dispatch, SetStateAction } from 'react';
import { Link, InertiaLinkProps } from '@inertiajs/react';
import { Transition } from '@headlessui/react';

// Context to manage the open state and mouse events
const DropDownContext = createContext<{
    open: boolean;
    setOpen: Dispatch<SetStateAction<boolean>>;
    handleMouseEnter: () => void;
    handleMouseLeave: () => void;
}>({
    open: false,
    setOpen: () => {},
    handleMouseEnter: () => {},
    handleMouseLeave: () => {},
});

const DropdownOnHover = ({ children }: PropsWithChildren) => {
    const [open, setOpen] = useState(false);

    // Open the dropdown on mouse enter
    const handleMouseEnter = () => {
        setOpen(true);
    };

    // Close the dropdown on mouse leave
    const handleMouseLeave = () => {
        setOpen(false);
    };

    return (
        <DropDownContext.Provider value={{ open, setOpen, handleMouseEnter, handleMouseLeave }}>
            <div className="relative">{children}</div>
        </DropDownContext.Provider>
    );
};

// Trigger component for dropdown, opens on hover
const Trigger = ({ children }: PropsWithChildren) => {
    const { handleMouseEnter, handleMouseLeave } = useContext(DropDownContext);

    return (
        <>
            <div onMouseEnter={handleMouseEnter} onMouseLeave={handleMouseLeave}>
                {children}
            </div>
        </>
    );
};

// Content component for dropdown content
const Content = ({
    align = 'left',
    width = '48',
    contentClasses = 'py-1 bg-white',
    children,
}: PropsWithChildren<{ align?: 'left' | 'right'; width?: '48'; contentClasses?: string }>) => {
    const { open, handleMouseEnter, handleMouseLeave } = useContext(DropDownContext);

    // Determine alignment classes
    let alignmentClasses = 'origin-top';
    if (align === 'left') {
        alignmentClasses = 'ltr:origin-top-left rtl:origin-top-right start-0';
    } else if (align === 'right') {
        alignmentClasses = 'ltr:origin-top-right rtl:origin-top-left end-0';
    }

    // Determine width classes
    const widthClasses = width === '48' ? 'w-48' : '';

    return (
        <>
            <Transition
                show={open}
                enter="transition ease-out duration-200"
                enterFrom="opacity-0 scale-95"
                enterTo="opacity-100 scale-100"
                leave="transition ease-in duration-75"
                leaveFrom="opacity-100 scale-100"
                leaveTo="opacity-0 scale-95"
            >
                <div
                    className={`absolute z-50 mt-2 rounded-md shadow-lg ${alignmentClasses} ${widthClasses}`}
                    onMouseEnter={handleMouseEnter} // Keep the dropdown open when hovering over content
                    onMouseLeave={handleMouseLeave} // Close the dropdown when leaving the content
                >
                    <div className={`rounded-md ring-1 ring-black ring-opacity-5 ${contentClasses}`}>{children}</div>
                </div>
            </Transition>
        </>
    );
};

// Link component within dropdown
const DropdownLink = ({ className = '', children, ...props }: InertiaLinkProps) => {
    return (
        <Link
            {...props}
            className={
                'block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out ' +
                className
            }
        >
            {children}
        </Link>
    );
};

// Exporting subcomponents for ease of use
DropdownOnHover.Trigger = Trigger;
DropdownOnHover.Content = Content;
DropdownOnHover.Link = DropdownLink;

export default DropdownOnHover;
