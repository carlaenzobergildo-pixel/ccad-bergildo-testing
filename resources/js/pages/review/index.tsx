import { ResourceIndexPage } from '@/components/resource-crud';

type Props = { records: (Record<string, unknown> & { id: number })[] };

export default function ReviewIndex({ records }: Props) {
    return <ResourceIndexPage resource="reviews" records={records} />;
}
