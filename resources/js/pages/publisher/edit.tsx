import { ResourceFormPage } from '@/components/resource-crud';

type Props = { record: Record<string, unknown> & { id: number } };

export default function PublisherEdit({ record }: Props) {
    return <ResourceFormPage resource="publishers" record={record} />;
}
