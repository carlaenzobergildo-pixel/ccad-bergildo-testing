import { ResourceIndexPage } from '@/components/resource-crud';

type Props = { records: (Record<string, unknown> & { id: number })[] };

export default function GenreIndex({ records }: Props) {
    return <ResourceIndexPage resource="genres" records={records} />;
}
