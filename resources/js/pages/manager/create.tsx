import { ResourceFormPage } from '@/components/resource-crud';

type Props = { options: Record<string, { id: number; label: string }[]> };

export default function ManagerCreate({ options }: Props) {
    return <ResourceFormPage resource="managers" options={options} />;
}
