import { ResourceFormPage } from '@/components/resource-crud';

type Props = { record: Record<string, unknown> & { id: number }; options: Record<string, { id: number; label: string }[]> };

export default function BookGenreEdit({ record, options }: Props) {
    return <ResourceFormPage resource="book_genres" record={record} options={options} />;
}
