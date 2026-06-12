<x-admin-layout title="বার্তা">
    <div class="max-w-2xl rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
        <div class="flex items-start justify-between border-b border-gray-100 pb-4">
            <div>
                <h2 class="text-lg font-bold text-gray-900">{{ $contact->subject ?: 'বিষয় নেই' }}</h2>
                <p class="text-sm text-gray-500">{{ $contact->name }}</p>
            </div>
            <span class="text-xs text-gray-400">{{ bn_number($contact->created_at->format('d/m/Y h:i A')) }}</span>
        </div>

        <div class="mt-4 flex flex-wrap gap-4 text-sm">
            @if($contact->email)
                <a href="mailto:{{ $contact->email }}" class="text-brand-700 hover:underline">{{ $contact->email }}</a>
            @endif
            @if($contact->phone)
                <a href="tel:{{ $contact->phone }}" class="text-brand-700 hover:underline">{{ $contact->phone }}</a>
            @endif
        </div>

        <p class="mt-4 whitespace-pre-line leading-relaxed text-gray-700">{{ $contact->message }}</p>

        <div class="mt-6 flex gap-3">
            @if($contact->email)
                <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" class="btn-primary">উত্তর দিন</a>
            @endif
            <a href="{{ route('admin.contacts.index') }}" class="btn-outline">ফিরে যান</a>
        </div>
    </div>
</x-admin-layout>
