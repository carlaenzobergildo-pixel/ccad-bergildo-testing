import { ResourceFormPage } from '@/components/resource-crud';

type Props = { options: Record<string, { id: number; label: string }[]> };

export default function AuthorCreate({ options }: Props) {
    return <ResourceFormPage resource="authors" options={options} />;
}
