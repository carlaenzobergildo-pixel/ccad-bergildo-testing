import { ResourceFormPage } from '@/components/resource-crud';

type Props = { record: Record<string, unknown> & { id: number }; options: Record<string, { id: number; label: string }[]> };

export default function BookEdit({ record, options }: Props) {
    return <ResourceFormPage resource="books" record={record} options={options} />;
}
