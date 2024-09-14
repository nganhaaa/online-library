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
                <header className="bg-[#F6F6F6]">
                    <div className="mx-10 pt-4 py-3 mb-5 px-7 sm:px-6 lg:px-8">
                    <h2 className="font-medium text-gray-800 leading-tight ">
                    {header}
                </h2>
                        
                    </div>
                </header>
            )}

            <main>{children}</main>
            <Footer/>
        </div>
    );
}
