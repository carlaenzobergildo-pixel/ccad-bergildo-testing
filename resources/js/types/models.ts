export interface PaginatedData<T> {
    data: T[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
    links: { url: string | null; label: string; active: boolean }[];
}

export interface Publisher {
    id: number;
    publisher_name: string;
}

export interface Author {
    id: number;
    name: string;
}

export interface AuthorProfile {
    id: number;
    author_id: number;
    bio: string;
}

export interface Genre {
    id: number;
    genre_name: string;
}

export interface Book {
    id: number;
    author_id: number;
    publisher_id: number;
    title: string;
    slug: string;
    isbn: string;
    price: number;
    description: string;
    image: string | null;
    author?: Author;
    publisher?: Publisher;
    genre?: Genre;
    created_at: string;
}