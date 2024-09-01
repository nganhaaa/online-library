export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export interface Book {
    id: number;
    name: string;
    description: string;
    publication_year: number;
    available: boolean;
    quantity: number;
    price: number;
    image: string;
    age_group: string; // Assuming it's a string like the age group name
    publisher: string; // Assuming it's a string like the publisher name
    authors: string[]; // Array of author names
    genres: string[]; // Array of genre names
    
}

export interface Genre {
    id: number;
    name: string;
}

export interface Author {
    id: number;
    name: string;
    nationality: string;
}

export interface Publisher {
    id: number;
    name: string;
    address: string;
    phone: string;
}

export interface AgeGroup {
    id: number;
    name: string;
    min_age: number;
    max_age: number;
}

export interface HeaderProps {
    genres: Genre[];
    authors: Author[];
    publishers: Publisher[];
    agegroups: AgeGroup[];
}



export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
};
