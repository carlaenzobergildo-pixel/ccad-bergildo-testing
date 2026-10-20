import { ResourceFormPage } from '@/components/resource-crud';

type Props = { record: Record<string, unknown> & { id: number } };

export default function ProductEdit({ record }: Props) {
    return <ResourceFormPage resource="products" record={record} />;
}
