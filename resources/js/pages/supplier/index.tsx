import { ResourceIndexPage } from '@/components/resource-crud';

type Props = { records: (Record<string, unknown> & { id: number })[] };

export default function SupplierIndex({ records }: Props) {
    return <ResourceIndexPage resource="suppliers" records={records} />;
}
