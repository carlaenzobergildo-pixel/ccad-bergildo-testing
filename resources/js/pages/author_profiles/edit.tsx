import { ResourceFormPage } from '@/components/resource-crud';

type Props = { record: Record<string, unknown> & { id: number }; options: Record<string, { id: number; label: string }[]> };

export default function AuthorProfileEdit({ record, options }: Props) {
    return <ResourceFormPage resource="author_profiles" record={record} options={options} />;
}
