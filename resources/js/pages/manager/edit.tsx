import { ResourceFormPage } from '@/components/resource-crud';

type Props = { record: Record<string, unknown> & { id: number }; options: Record<string, { id: number; label: string }[]> };

export default function ManagerEdit({ record, options }: Props) {
    return <ResourceFormPage resource="managers" record={record} options={options} />;
}
