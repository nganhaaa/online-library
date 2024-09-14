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
    available: number;
    quantity: number;
    price: number;
    image: string;
    age_group: string; 
    publisher: string; 
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


export interface SlideItem {
    image: string;
    alt: string;
}

export interface SlideProps {
    items: SlideItem[];
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
};

export interface HeaderProps extends PageProps{
    genres: {
        data: Genre[],}
    authors: {
        data:Author[],}
    publishers: {
        data:Publisher[],}
    agegroups: {
        data:AgeGroup[],}
}

export interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
  }

export interface PaginatedBooks {
    data: Book[];
    meta: {
        links: PaginationLink[]
    };
}
