import { ResourceIndexPage } from '@/components/resource-crud';

type Props = { records: (Record<string, unknown> & { id: number })[] };

export default function ManagerIndex({ records }: Props) {
    return <ResourceIndexPage resource="managers" records={records} />;
}
