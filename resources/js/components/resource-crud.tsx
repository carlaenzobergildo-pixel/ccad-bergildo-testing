import { Head, Link, router, useForm } from '@inertiajs/react';
import type { FormDataConvertible } from '@inertiajs/core';
import { useState, type FormEvent } from 'react';
import AppLayout from '@/layouts/app-layout';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';

type ResourceKey =
    | 'books'
    | 'authors'
    | 'publishers'
    | 'genres'
    | 'author_profiles'
    | 'book_genres'
    | 'managers'
    | 'products'
    | 'reviews'
    | 'warehouses'
    | 'suppliers';

type Option = { id?: number; value?: string | number; label: string };

type Field = {
    name: string;
    label: string;
    type?: 'text' | 'number' | 'textarea' | 'select' | 'multiselect';
    options?: Option[];
    optionKey?: string;
    required?: boolean;
    step?: string;
};

type ResourceConfig = {
    title: string;
    singular: string;
    columns: { key: string; label: string }[];
    fields: Field[];
};

const configs: Record<ResourceKey, ResourceConfig> = {
    books: {
        title: 'Books',
        singular: 'Book',
        columns: [
            { key: 'title', label: 'Title' },
            { key: 'author.name', label: 'Author' },
            { key: 'publisher.publisher_name', label: 'Publisher' },
            { key: 'genres', label: 'Genres' },
            { key: 'isbn', label: 'ISBN' },
            { key: 'price', label: 'Price' },
        ],
        fields: [
            { name: 'title', label: 'Title', required: true },
            { name: 'author_id', label: 'Author', type: 'select', optionKey: 'authors', required: true },
            { name: 'publisher_id', label: 'Publisher', type: 'select', optionKey: 'publishers', required: true },
            { name: 'genre_ids', label: 'Genres', type: 'multiselect', optionKey: 'genres' },
            { name: 'slug', label: 'Slug', required: true },
            { name: 'isbn', label: 'ISBN', required: true },
            { name: 'price', label: 'Price', type: 'number', step: '0.01', required: true },
            { name: 'description', label: 'Description', type: 'textarea', required: true },
            { name: 'image', label: 'Image URL or path' },
        ],
    },
    authors: {
        title: 'Authors',
        singular: 'Author',
        columns: [{ key: 'name', label: 'Name' }, { key: 'publisher.publisher_name', label: 'Publisher' }],
        fields: [
            { name: 'name', label: 'Name', required: true },
            { name: 'publisher_id', label: 'Publisher', type: 'select', optionKey: 'publishers', required: true },
        ],
    },
    publishers: {
        title: 'Publishers',
        singular: 'Publisher',
        columns: [{ key: 'publisher_name', label: 'Publisher name' }],
        fields: [{ name: 'publisher_name', label: 'Publisher name', required: true }],
    },
    genres: {
        title: 'Genres',
        singular: 'Genre',
        columns: [{ key: 'genre_name', label: 'Genre name' }],
        fields: [{ name: 'genre_name', label: 'Genre name', required: true }],
    },
    author_profiles: {
        title: 'Author profiles',
        singular: 'Author profile',
        columns: [{ key: 'author.name', label: 'Author' }, { key: 'bio', label: 'Biography' }],
        fields: [
            { name: 'author_id', label: 'Author', type: 'select', optionKey: 'authors', required: true },
            { name: 'bio', label: 'Biography', type: 'textarea' },
        ],
    },
    book_genres: {
        title: 'Book genres',
        singular: 'Book genre',
        columns: [{ key: 'book.title', label: 'Book' }, { key: 'genre.genre_name', label: 'Genre' }],
        fields: [
            { name: 'book_id', label: 'Book', type: 'select', optionKey: 'books', required: true },
            { name: 'genre_id', label: 'Genre', type: 'select', optionKey: 'genres', required: true },
        ],
    },
    managers: {
        title: 'Managers',
        singular: 'Manager',
        columns: [{ key: 'mngr_name', label: 'Name' }, { key: 'warehouse.location', label: 'Warehouse' }],
        fields: [
            { name: 'mngr_name', label: 'Name', required: true },
            { name: 'warehouse_id', label: 'Warehouse', type: 'select', optionKey: 'warehouses', required: true },
        ],
    },
    products: {
        title: 'Products',
        singular: 'Product',
        columns: [{ key: 'prod_name', label: 'Name' }, { key: 'price', label: 'Price' }],
        fields: [
            { name: 'prod_name', label: 'Name', required: true },
            { name: 'price', label: 'Price', type: 'number', step: '0.01', required: true },
        ],
    },
    reviews: {
        title: 'Reviews',
        singular: 'Review',
        columns: [
            { key: 'reviewable.title', label: 'Item' },
            { key: 'user.name', label: 'Reviewer' },
            { key: 'stars', label: 'Stars' },
            { key: 'comment', label: 'Comment' },
        ],
        fields: [
            { name: 'reviewable_type', label: 'Item type', type: 'select', options: [{ value: 'App\\Models\\Book', label: 'Book' }, { value: 'App\\Models\\Product', label: 'Product' }], required: true },
            { name: 'reviewable_id', label: 'Item ID', type: 'number', required: true },
            { name: 'stars', label: 'Stars (1-5)', type: 'number', required: true },
            { name: 'comment', label: 'Comment', type: 'textarea' },
        ],
    },
    warehouses: {
        title: 'Warehouses',
        singular: 'Warehouse',
        columns: [{ key: 'location', label: 'Location' }, { key: 'supplier.supplier_name', label: 'Supplier' }],
        fields: [
            { name: 'location', label: 'Location', required: true },
            { name: 'supplier_id', label: 'Supplier', type: 'select', optionKey: 'suppliers', required: true },
        ],
    },
    suppliers: {
        title: 'Suppliers',
        singular: 'Supplier',
        columns: [{ key: 'supplier_name', label: 'Supplier name' }],
        fields: [{ name: 'supplier_name', label: 'Supplier name', required: true }],
    },
};

type ResourceRecord = Record<string, unknown> & { id: number };
type ResourcePage = {
    data: ResourceRecord[];
    links: { url: string | null; label: string; active: boolean }[];
    total: number;
};

function valueAt(record: ResourceRecord, key: string): string {
    if (key === 'genres' && Array.isArray(record.genres)) {
        const names = record.genres
            .map((genre) => (typeof genre === 'object' && genre !== null ? (genre as Record<string, unknown>).genre_name : null))
            .filter((name): name is string => typeof name === 'string');
        return names.length ? names.join(', ') : '—';
    }

    const value = key.split('.').reduce<unknown>((current, part) => {
        if (typeof current !== 'object' || current === null) return undefined;
        return (current as Record<string, unknown>)[part];
    }, record);
    if (key === 'reviewable.title' && !value && record.reviewable && typeof record.reviewable === 'object') {
        return String((record.reviewable as Record<string, unknown>).prod_name ?? 'Item unavailable');
    }
    return value === null || value === undefined || value === '' ? '—' : String(value);
}

export function ResourceIndexPage({
    resource,
    records,
    search = '',
}: {
    resource: ResourceKey;
    records: ResourceRecord[] | ResourcePage;
    search?: string;
}) {
    const config = configs[resource];
    const [searchValue, setSearchValue] = useState(search);
    const rows = Array.isArray(records) ? records : records.data;
    const pageLinks = Array.isArray(records) ? undefined : records.links;

    const searchBooks = (event: FormEvent<HTMLFormElement>) => {
        event.preventDefault();
        router.get(route(`${resource}.index`), { search: searchValue }, { preserveState: true, replace: true });
    };

    return (
        <AppLayout>
            <Head title={config.title} />
            <main className="space-y-6 p-6">
                <header className="flex items-center justify-between gap-4">
                    <div>
                        <h1 className="text-2xl font-semibold">{config.title}</h1>
                        <p className="text-sm text-muted-foreground">Manage {config.title.toLowerCase()}.</p>
                    </div>
                    <Button asChild><Link href={route(`${resource}.create`)}>Add {config.singular}</Link></Button>
                </header>

                {resource === 'books' && (
                    <form onSubmit={searchBooks} className="flex max-w-lg gap-2">
                        <input
                            type="search"
                            value={searchValue}
                            onChange={(event) => setSearchValue(event.target.value)}
                            placeholder="Search books by title"
                            aria-label="Search books by title"
                            className="h-10 min-w-0 flex-1 rounded-md border bg-background px-3 text-sm"
                        />
                        <Button type="submit" variant="outline">Search</Button>
                    </form>
                )}

                <div className="overflow-x-auto rounded-xl border">
                    <table className="w-full text-left text-sm">
                        <thead className="border-b bg-muted/50">
                            <tr>
                                {config.columns.map((column) => <th key={column.key} className="px-4 py-3 font-medium">{column.label}</th>)}
                                <th className="px-4 py-3 font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {rows.length ? rows.map((record) => (
                                <tr key={record.id} className="border-b last:border-0">
                                    {config.columns.map((column) => <td key={column.key} className="px-4 py-3">{valueAt(record, column.key)}</td>)}
                                    <td className="flex gap-2 px-4 py-3">
                                        <Button variant="outline" size="sm" asChild>
                                            <Link href={route(`${resource}.edit`, record.id)}>Edit</Link>
                                        </Button>
                                        <Button
                                            variant="destructive"
                                            size="sm"
                                            onClick={() => {
                                                if (window.confirm(`Delete this ${config.singular.toLowerCase()}?`)) {
                                                    router.delete(route(`${resource}.destroy`, record.id));
                                                }
                                            }}
                                        >
                                            Delete
                                        </Button>
                                    </td>
                                </tr>
                            )) : (
                                <tr><td colSpan={config.columns.length + 1} className="px-4 py-10 text-center text-muted-foreground">No {config.title.toLowerCase()} found.</td></tr>
                            )}
                        </tbody>
                    </table>
                </div>
                {pageLinks && pageLinks.length > 3 && (
                    <nav aria-label="Book pages" className="flex flex-wrap gap-2">
                        {pageLinks.map((link, index) => {
                            const label = link.label.replace('&laquo;', '‹').replace('&raquo;', '›');
                            return link.url ? (
                                <Link
                                    key={`${link.label}-${index}`}
                                    href={link.url}
                                    preserveState
                                    className={`rounded-md border px-3 py-1.5 text-sm ${link.active ? 'bg-primary text-primary-foreground' : 'bg-background'}`}
                                    aria-current={link.active ? 'page' : undefined}
                                >
                                    {label}
                                </Link>
                            ) : (
                                <span key={`${link.label}-${index}`} className="rounded-md border px-3 py-1.5 text-sm text-muted-foreground">
                                    {label}
                                </span>
                            );
                        })}
                    </nav>
                )}
            </main>
        </AppLayout>
    );
}

export function ResourceFormPage({
    resource,
    record,
    options = {},
}: {
    resource: ResourceKey;
    record?: ResourceRecord;
    options?: Record<string, Option[]>;
}) {
    const config = configs[resource];
    const initialData = Object.fromEntries(
        config.fields.map((field) => [
            field.name,
            field.type === 'multiselect'
                ? ((record?.genres as { id: number }[] | undefined)?.map((genre) => genre.id) ?? [])
                : ((record?.[field.name] as FormDataConvertible | undefined) ?? ''),
        ]),
    );
    const { data, setData, post, put, processing, errors } = useForm<Record<string, FormDataConvertible>>(initialData);

    const submit = (event: FormEvent<HTMLFormElement>) => {
        event.preventDefault();
        if (record) {
            put(route(`${resource}.update`, record.id));
        } else {
            post(route(`${resource}.store`));
        }
    };

    const selectedValues = (fieldName: string): string[] => {
        const value = data[fieldName];
        return Array.isArray(value) ? value.map(String) : [];
    };

    return (
        <AppLayout>
            <Head title={`${record ? 'Edit' : 'Create'} ${config.singular}`} />
            <main className="mx-auto w-full max-w-2xl space-y-6 p-6">
                <header>
                    <h1 className="text-2xl font-semibold">{record ? 'Edit' : 'Create'} {config.singular}</h1>
                </header>
                <form onSubmit={submit} className="space-y-5 rounded-xl border p-6">
                    {config.fields.map((field) => (
                        <div key={field.name} className="space-y-2">
                            <Label htmlFor={field.name}>{field.label}</Label>
                            {field.type === 'textarea' ? (
                                <textarea
                                    id={field.name}
                                    required={field.required}
                                    value={String(data[field.name] ?? '')}
                                    onChange={(event) => setData(field.name, event.target.value)}
                                    className="min-h-28 w-full rounded-md border bg-background px-3 py-2 text-sm"
                                />
                            ) : field.type === 'multiselect' ? (
                                <select
                                    id={field.name}
                                    multiple
                                    value={selectedValues(field.name)}
                                    onChange={(event) => setData(
                                        field.name,
                                        Array.from(event.currentTarget.selectedOptions, (option) => Number(option.value)),
                                    )}
                                    className="min-h-32 w-full rounded-md border bg-background px-3 py-2 text-sm"
                                >
                                    {(options[field.optionKey ?? ''] ?? []).map((option) => (
                                        <option key={option.id} value={option.id}>
                                            {option.label}
                                        </option>
                                    ))}
                                </select>
                            ) : field.type === 'select' ? (
                                <select
                                    id={field.name}
                                    required={field.required}
                                    value={String(data[field.name] ?? '')}
                                    onChange={(event) => setData(field.name, event.target.value)}
                                    className="h-10 w-full rounded-md border bg-background px-3 text-sm"
                                >
                                    <option value="">Select {field.label.toLowerCase()}</option>
                                    {(field.options ?? options[field.optionKey ?? ''] ?? []).map((option) => (
                                        <option key={option.value ?? option.id} value={option.value ?? option.id}>
                                            {option.label}
                                        </option>
                                    ))}
                                </select>
                            ) : (
                                <input
                                    id={field.name}
                                    type={field.type ?? 'text'}
                                    step={field.step}
                                    required={field.required}
                                    value={String(data[field.name] ?? '')}
                                    onChange={(event) => setData(field.name, event.target.value)}
                                    className="h-10 w-full rounded-md border bg-background px-3 text-sm"
                                />
                            )}
                            <InputError message={errors[field.name]} />
                        </div>
                    ))}
                    <div className="flex gap-3">
                        <Button type="submit" disabled={processing}>{processing ? 'Saving…' : 'Save'}</Button>
                        <Button type="button" variant="outline" asChild>
                            <Link href={route(`${resource}.index`)}>Cancel</Link>
                        </Button>
                    </div>
                </form>
            </main>
        </AppLayout>
    );
}
