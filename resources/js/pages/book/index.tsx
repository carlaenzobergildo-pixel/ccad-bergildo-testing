import { ResourceIndexPage } from '@/components/resource-crud';

type Props = {
    records:
        | (Record<string, unknown> & { id: number })[]
        | {
              data: (Record<string, unknown> & { id: number })[];
              links: { url: string | null; label: string; active: boolean }[];
              total: number;
          };
    filters: { search?: string };
};

export default function BookIndex({ records, filters }: Props) {
    return <ResourceIndexPage resource="books" records={records} search={filters.search ?? ''} />;
}
