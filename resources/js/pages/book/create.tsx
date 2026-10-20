import { ResourceFormPage } from '@/components/resource-crud';

type Props = { options: Record<string, { id: number; label: string }[]> };

export default function BookCreate({ options }: Props) {
    return <ResourceFormPage resource="books" options={options} />;
}
