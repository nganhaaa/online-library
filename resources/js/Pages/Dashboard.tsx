import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link} from '@inertiajs/react';
import { PageProps, HeaderProps, PaginatedBooks, SlideProps } from '@/types';
import { useEffect } from 'react';
import BookList from './Book/BookList';
import Slide from '@/Components/Slide';


interface DashboardProps extends PageProps {
    headerProps: HeaderProps;
    books: PaginatedBooks;
  
}

export default function Dashboard({ auth, headerProps, books }: DashboardProps) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            // header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
            headerProps={headerProps}
        >
            <Head title="Welcome" />
            {/* <Slide items={slides}></Slide> */}
            <BookList books={books} hasSidebar={false}/>
            <Link href={'/book'}>
    <button className="block mx-auto mt-4 py-2 px-4 text-white bg-blue-500 rounded hover:bg-blue-600 transition-colors">
        See more...
    </button>
</Link>     
        </AuthenticatedLayout>
    );
}
