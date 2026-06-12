<x-admin-layout title="সদস্যের বিস্তারিত">
    <div class="max-w-2xl rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
        <div class="flex items-start justify-between">
            <div>
                <h2 class="text-xl font-bold text-gray-900">{{ $member->name }}</h2>
                <p class="text-sm text-gray-500">{{ $member->tier_label }}</p>
            </div>
            <x-admin.status-badge :status="$member->status" :label="$member->status_label" />
        </div>

        <dl class="mt-6 grid gap-4 sm:grid-cols-2">
            @foreach([
                'পিতা/স্বামীর নাম' => $member->father_name,
                'মোবাইল' => $member->phone,
                'ইমেইল' => $member->email,
                'পেশা' => $member->occupation,
                'সদস্য নম্বর' => $member->membership_no,
                'যোগদানের তারিখ' => $member->joined_at ? bn_number($member->joined_at->format('d/m/Y')) : null,
            ] as $label => $value)
                <div>
                    <dt class="text-xs uppercase tracking-wider text-gray-400">{{ $label }}</dt>
                    <dd class="mt-0.5 text-gray-800">{{ $value ?: '—' }}</dd>
                </div>
            @endforeach
            <div class="sm:col-span-2">
                <dt class="text-xs uppercase tracking-wider text-gray-400">ঠিকানা</dt>
                <dd class="mt-0.5 text-gray-800">{{ $member->address ?: '—' }}</dd>
            </div>
            @if($member->message)
                <div class="sm:col-span-2">
                    <dt class="text-xs uppercase tracking-wider text-gray-400">বার্তা</dt>
                    <dd class="mt-0.5 text-gray-800">{{ $member->message }}</dd>
                </div>
            @endif
        </dl>

        <div class="mt-6 flex gap-3">
            <a href="{{ route('admin.members.edit', $member) }}" class="btn-primary">সম্পাদনা / অনুমোদন</a>
            <a href="{{ route('admin.members.index') }}" class="btn-outline">ফিরে যান</a>
        </div>
    </div>
</x-admin-layout>
