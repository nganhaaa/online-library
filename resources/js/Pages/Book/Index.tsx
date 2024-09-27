import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, router } from '@inertiajs/react';
import { PageProps, HeaderProps, PaginatedBooks } from '@/types';
import CheckboxList from '@/Components/CheckboxList';
import BookList from './BookList';
import Pagination from '@/Components/Pagination';
import { useEffect, useState } from 'react';

interface DashboardProps extends PageProps {
    headerProps: HeaderProps;
    books: PaginatedBooks;
}

export default function Index({ auth, headerProps, books }: DashboardProps) {
    const [selectedGenres, setSelectedGenres] = useState<number[]>([]);
    const [selectedAuthors, setSelectedAuthors] = useState<number[]>([]);
    const [selectedPublishers, setSelectedPublishers] = useState<number[]>([]);

    // Get URL parameters for initial state
    const params = new URLSearchParams(window.location.search);
    const publisherId = params.get('publisher_id');

    useEffect(() => {
        // If there's a publisher_id, set it as selected
        if (publisherId) {
            setSelectedPublishers([Number(publisherId)]);
        }

        // Other parameters can be processed here if needed
    }, [publisherId]);

    const handleCheckboxChange = (type: string, values: number[]) => {
        const queryParam = `${type.toLowerCase().replace(" ", "_")}_id`;
        const url = `/book?${queryParam}=${values.join(',')}`; // Join multiple IDs with commas

        console.log('URL:', url); // Log the URL to the console

        try {
            router.get(url); // Use the URL directly to fetch new data
        } catch (error) {
            console.error("Error navigating:", error);
        }
    };

    const hasSidebar = headerProps.publishers.data.length > 0;

    return (
        <AuthenticatedLayout
            user={auth.user}
            headerProps={headerProps}
        >
            <Head title="Welcome" />
            <div className='container flex w-full mx-auto px-4 py-6'>
                {hasSidebar && (
                    <div className='w-1/4 pr-4'>
                        <span className='text-center font-bold'>Publisher</span>
                        <CheckboxList
                            checkboxItems={headerProps.publishers.data}
                            onCheck={publisherId ? Number(publisherId) : undefined} // Set default checkbox
                            onChange={(values) => handleCheckboxChange('publisher', values)}
                        />
                    </div>
                )}

                <div className={hasSidebar ? 'w-3/4' : 'w-full'}>
                    <BookList books={books} hasSidebar={hasSidebar} />
                </div>
            </div>
            <Pagination links={books.meta.links} />
        </AuthenticatedLayout>
    );
}
