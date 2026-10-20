import { ResourceFormPage } from '@/components/resource-crud';

type Props = { options: Record<string, { id: number; label: string }[]> };

export default function WarehouseCreate({ options }: Props) {
    return <ResourceFormPage resource="warehouses" options={options} />;
}
