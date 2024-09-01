import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head} from '@inertiajs/react';
import { PageProps, HeaderProps, PaginatedBooks } from '@/types';
import { useEffect } from 'react';
import Index from './Book/Index';


interface DashboardProps extends PageProps {
    headerProps: HeaderProps;
    books: PaginatedBooks;
}

export default function Dashboard({ auth, headerProps, books }: DashboardProps) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
            headerProps={headerProps}
        >
            {/* <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">You're logged in!</div>
                    </div>
                </div>
            </div> */}
            <Index books={books}/>
        </AuthenticatedLayout>
    );
}
