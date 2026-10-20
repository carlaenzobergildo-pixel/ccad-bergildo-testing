import { ResourceIndexPage } from '@/components/resource-crud';

type Props = { records: (Record<string, unknown> & { id: number })[] };

export default function BookGenreIndex({ records }: Props) {
    return <ResourceIndexPage resource="book_genres" records={records} />;
}
