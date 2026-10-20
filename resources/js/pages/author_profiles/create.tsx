import { ResourceFormPage } from '@/components/resource-crud';

type Props = { options: Record<string, { id: number; label: string }[]> };

export default function AuthorProfileCreate({ options }: Props) {
    return <ResourceFormPage resource="author_profiles" options={options} />;
}
