import { ResourceIndexPage } from '@/components/resource-crud';

type Props = { records: (Record<string, unknown> & { id: number })[] };

export default function PublisherIndex({ records }: Props) {
    return <ResourceIndexPage resource="publishers" records={records} />;
}
