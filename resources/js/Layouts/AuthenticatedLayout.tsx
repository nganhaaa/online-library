import { useState, PropsWithChildren, ReactNode } from 'react';
import ApplicationLogo from '@/Components/ApplicationLogo';
import Dropdown from '@/Components/Dropdown';
import NavLink from '@/Components/NavLink';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink';
import { Link } from '@inertiajs/react';
import { User, HeaderProps } from '@/types';
import Header from '@/Components/Header';
import Footer from '@/Components/Footer';

export default function Authenticated({ user, header, children, headerProps }: PropsWithChildren<{ user: User, header?: ReactNode, headerProps: HeaderProps }>) {
    return (
        <div>
            <Header
                {...headerProps} // Spread headerProps to the Header component
            />

            {header && (
                <header className="bg-white shadow">
                    <div className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {header}
                    </div>
                </header>
            )}

            <main>{children}</main>
            <Footer />
        </div>
    );
}
