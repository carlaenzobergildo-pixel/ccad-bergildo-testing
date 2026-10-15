import React from 'react';
import { useState} from 'react';
import type { FormEvent } from 'react';
import AppLayout from '@/layouts/app-layout';
import { Link, router } from '@inertiajs/react';
import { Author, Book, Genre, PaginatedData, Publisher } from '@/types/models';
import { Button } from '@/components/ui/button';
// table component
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table";
// select component
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";

interface props {
    books: PaginatedData<Book>;
    filters: {
        search?: string;
    };
    authors: Author[];
    publishers: Publisher[];
    genres: Genre[];
}

export default function BookIndex({
    books,
    filters,
    authors,
    publishers,
    genres,
}: props) {

    return (
        <AppLayout>
        <div className="w-full space-y-6 p-6">
            <div className="flex items-center justify-between">

           <div>
                <h1 className="text-2xl font-bold tracking-tight">
                    Books

                <p className="text-sm text-muted-foreground">
                    Manage your books.
                </p>

                </h1>
            </div>

        <Button size="lg">
            Add Book
        </Button>

        </div>
            </div>
           
            <div className="overflow-hidden
                            rounded-2xl
                            border
                            bg card
                            text card from-foreground
                            shadow-sm">
                
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead>Title</TableHead>
                            <TableHead>Author</TableHead>
                            <TableHead>Publisher</TableHead>
                            <TableHead>Price</TableHead>
                            <TableHead>Actions</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        {books.data && books.data.length > 0 ? (
                            books.data.map((book) => (
                                <TableRow key={book.id}>
                                    <TableCell>{book.title}</TableCell>
                                    <TableCell>{book.author?.name ?? 'N/A'}</TableCell>
                                    <TableCell>{book.publisher?.publisher_name ?? 'N/A'}</TableCell>
                                    <TableCell>₱ {Number(book.price ?? 0).toFixed(2)}</TableCell>
                                    <TableCell>
                                        <Button size="sm">
                                            Edit
                                        </Button>
                                    </TableCell>
                                </TableRow>
                            ))
                        ) : (
                            <TableRow>
                                <TableCell colSpan={5} className="h-24 text-center text-muted-foreground">
                                    No results.
                                </TableCell>
                            </TableRow>
                        )
                        }
                    </TableBody>
                </Table>

            </div>
        </AppLayout>
    );

};