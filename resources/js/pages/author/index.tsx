import { ResourceIndexPage } from '@/components/resource-crud';

type Props = { records: (Record<string, unknown> & { id: number })[] };

export default function AuthorIndex({ records }: Props) {
    return <ResourceIndexPage resource="authors" records={records} />;
}