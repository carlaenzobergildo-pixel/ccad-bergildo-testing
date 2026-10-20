import { ResourceFormPage } from '@/components/resource-crud';

type Props = { record: Record<string, unknown> & { id: number } };

export default function GenreEdit({ record }: Props) {
    return <ResourceFormPage resource="genres" record={record} />;
}
