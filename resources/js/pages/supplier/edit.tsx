import { ResourceFormPage } from '@/components/resource-crud';

type Props = { record: Record<string, unknown> & { id: number } };

export default function SupplierEdit({ record }: Props) {
    return <ResourceFormPage resource="suppliers" record={record} />;
}
