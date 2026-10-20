import { ResourceFormPage } from '@/components/resource-crud';

type Props = { record: Record<string, unknown> & { id: number } };

export default function ReviewEdit({ record }: Props) {
    return <ResourceFormPage resource="reviews" record={record} />;
}
