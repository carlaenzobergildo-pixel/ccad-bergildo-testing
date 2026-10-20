import { ResourceFormPage } from '@/components/resource-crud';

type Props = { record: Record<string, unknown> & { id: number }; options: Record<string, { id: number; label: string }[]> };

export default function WarehouseEdit({ record, options }: Props) {
    return <ResourceFormPage resource="warehouses" record={record} options={options} />;
}
