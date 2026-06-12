<x-admin-layout title="অনুদান">
    <div class="mb-5 grid gap-4 sm:grid-cols-3">
        <div class="rounded-2xl bg-green-50 p-5 ring-1 ring-green-100">
            <p class="text-sm text-green-700">যাচাইকৃত মোট</p>
            <p class="mt-1 text-2xl font-bold text-green-800">৳{{ bn_number(number_format($totals['verified'])) }}</p>
        </div>
        <div class="rounded-2xl bg-amber-50 p-5 ring-1 ring-amber-100">
            <p class="text-sm text-amber-700">অপেক্ষমাণ</p>
            <p class="mt-1 text-2xl font-bold text-amber-800">{{ bn_number($totals['pending']) }} টি</p>
        </div>
        <div class="flex items-center justify-end">
            <a href="{{ route('admin.donations.create') }}" class="btn-primary">+ ম্যানুয়াল এন্ট্রি</a>
        </div>
    </div>

    <form method="GET" class="mb-4 flex gap-1 rounded-lg bg-white p-1 ring-1 ring-gray-200 w-max">
        <a href="{{ route('admin.donations.index') }}" class="rounded-md px-3 py-1.5 text-sm {{ ! request('status') ? 'bg-brand-700 text-white' : 'text-gray-600' }}">সব</a>
        @foreach(\App\Models\Donation::STATUSES as $value => $label)
            <a href="{{ route('admin.donations.index', ['status' => $value]) }}" class="rounded-md px-3 py-1.5 text-sm {{ request('status') === $value ? 'bg-brand-700 text-white' : 'text-gray-600' }}">{{ $label }}</a>
        @endforeach
    </form>

    <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-left text-xs uppercase tracking-wider text-gray-500">
                    <tr>
                        <th class="px-4 py-3">দাতা</th>
                        <th class="px-4 py-3">পরিমাণ</th>
                        <th class="px-4 py-3">মাধ্যম</th>
                        <th class="px-4 py-3">ট্রানজেকশন</th>
                        <th class="px-4 py-3">অবস্থা</th>
                        <th class="px-4 py-3 text-right">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($donations as $d)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <p class="font-medium text-gray-900">{{ $d->donor_name }}</p>
                                <p class="text-xs text-gray-400">{{ $d->phone }}</p>
                            </td>
                            <td class="px-4 py-3 font-semibold text-gray-900">৳{{ bn_number(number_format($d->amount)) }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $d->method_label }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $d->transaction_id ?? '—' }}</td>
                            <td class="px-4 py-3"><x-admin.status-badge :status="$d->status" :label="$d->status_label" /></td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.donations.edit', $d) }}" class="rounded-lg p-1.5 text-brand-600 hover:bg-brand-50" title="সম্পাদনা">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                                    </a>
                                    <x-admin.delete-button :action="route('admin.donations.destroy', $d)" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-4 py-10 text-center text-gray-400">কোনো অনুদান নেই।</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-5">{{ $donations->links() }}</div>
</x-admin-layout>
