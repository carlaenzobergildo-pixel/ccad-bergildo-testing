import { ResourceIndexPage } from '@/components/resource-crud';

type Props = { records: (Record<string, unknown> & { id: number })[] };

export default function ProductIndex({ records }: Props) {
    return <ResourceIndexPage resource="products" records={records} />;
}
