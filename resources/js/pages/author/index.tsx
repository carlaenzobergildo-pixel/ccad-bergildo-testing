// diri ang UI
import React from 'react';
import { Link, router } from '@inertiajs/react';
import { AuthorProfile } from '@/types/models';

export default function index(){
    return (
        <div>
            <h1>Author</h1>
            <Link href={route('authors.create')}>Create Author</Link>
        </div>
    );
}