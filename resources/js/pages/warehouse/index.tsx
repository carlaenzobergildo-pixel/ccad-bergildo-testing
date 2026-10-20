import { ResourceIndexPage } from '@/components/resource-crud';

type Props = { records: (Record<string, unknown> & { id: number })[] };

export default function WarehouseIndex({ records }: Props) {
    return <ResourceIndexPage resource="warehouses" records={records} />;
}
