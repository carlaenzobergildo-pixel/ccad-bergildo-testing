import { ResourceIndexPage } from '@/components/resource-crud';

type Props = { records: (Record<string, unknown> & { id: number })[] };

export default function AuthorProfileIndex({ records }: Props) {
    return <ResourceIndexPage resource="author_profiles" records={records} />;
}
