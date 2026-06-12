<x-admin-layout title="বার্তা">
    <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-left text-xs uppercase tracking-wider text-gray-500">
                    <tr>
                        <th class="px-4 py-3">প্রেরক</th>
                        <th class="px-4 py-3">বিষয়</th>
                        <th class="px-4 py-3">তারিখ</th>
                        <th class="px-4 py-3 text-right">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($contacts as $contact)
                        <tr class="hover:bg-gray-50 {{ $contact->is_read ? '' : 'bg-sky-50/40' }}">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    @unless($contact->is_read)<span class="h-2 w-2 rounded-full bg-sky-500"></span>@endunless
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $contact->name }}</p>
                                        <p class="text-xs text-gray-400">{{ $contact->phone ?? $contact->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-gray-600">{{ \Illuminate\Support\Str::limit($contact->subject ?: $contact->message, 40) }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ bn_number($contact->created_at->format('d/m/Y')) }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.contacts.show', $contact) }}" class="rounded-lg p-1.5 text-brand-600 hover:bg-brand-50" title="পড়ুন">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    </a>
                                    <x-admin.delete-button :action="route('admin.contacts.destroy', $contact)" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-4 py-10 text-center text-gray-400">কোনো বার্তা নেই।</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-5">{{ $contacts->links() }}</div>
</x-admin-layout>
