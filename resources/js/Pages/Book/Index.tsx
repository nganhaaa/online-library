import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { PageProps, HeaderProps, PaginatedBooks } from '@/types';
import CheckboxList from '@/Components/CheckboxList';
import BookList from './BookList';
import Pagination from '@/Components/Pagination';

interface DashboardProps extends PageProps {
    headerProps: HeaderProps;
    books: PaginatedBooks;
}

export default function Index({ auth, headerProps, books }: DashboardProps) {

    
    const hasSidebar = headerProps.genres.data.length > 0; // Check if we have any genres to show in the checkbox

    return (
        <AuthenticatedLayout
            user={auth.user}
            headerProps={headerProps}
        >
            <Head title="Welcome" />
            <div className='container flex w-full mx-auto px-4 py-6'>
                {/* Conditionally render the sidebar if there are genres */}
                {hasSidebar && (
                    <div className='w-1/4 pr-4'>
                        <CheckboxList checkboxItems={headerProps.genres.data} />
                    </div>
                )}

                {/* Adjust the BookList layout depending on if the sidebar is present */}
                <div className={hasSidebar ? 'w-3/4' : 'w-full'}>
                    <BookList books={books} hasSidebar={hasSidebar} />
                </div>
            </div>
            <Pagination links={books.meta.links} />
        </AuthenticatedLayout>
    );
}
