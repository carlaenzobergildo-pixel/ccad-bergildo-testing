import { ResourceFormPage } from '@/components/resource-crud';

type Props = { options: Record<string, { id: number; label: string }[]> };

export default function BookGenreCreate({ options }: Props) {
    return <ResourceFormPage resource="book_genres" options={options} />;
}
