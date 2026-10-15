import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';

interface Review {
    id: number;
    stars: number;
    comment: string | null;
    user: {
        name: string;
    } | null;
    reviewable: {
        title?: string;
        prod_name?: string;
    } | null;
}

interface Props {
    reviews: Review[];
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Reviews',
        href: '/reviews',
    },
];

export default function ReviewIndex({ reviews }: Props) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Reviews" />
            <div className="flex flex-col gap-4 p-4">
                <h1 className="text-2xl font-semibold">Reviews</h1>
                {reviews.length === 0 ? (
                    <p>No reviews yet.</p>
                ) : (
                    <ul className="flex flex-col gap-4">
                        {reviews.map((review) => (
                            <li key={review.id} className="rounded-xl border p-4">
                                <div className="flex flex-wrap items-center justify-between gap-2">
                                    <h2 className="font-medium">
                                        {review.reviewable?.title ??
                                            review.reviewable?.prod_name ??
                                            'Item unavailable'}
                                    </h2>
                                    <span>
                                        {review.stars} / 5 stars
                                    </span>
                                </div>
                                <p className="mt-1 text-sm text-muted-foreground">
                                    Reviewed by {review.user?.name ?? 'Unknown user'}
                                </p>
                                {review.comment && <p className="mt-3">{review.comment}</p>}
                            </li>
                        ))}
                    </ul>
                )}
            </div>
        </AppLayout>
    );
}
