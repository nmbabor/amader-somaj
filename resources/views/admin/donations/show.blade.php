<x-admin-layout title="অনুদানের বিস্তারিত">
    <div class="max-w-xl rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
        <div class="flex items-start justify-between">
            <div>
                <h2 class="text-xl font-bold text-gray-900">{{ $donation->donor_name }}</h2>
                <p class="text-2xl font-bold text-brand-700">৳{{ bn_number(number_format($donation->amount)) }}</p>
            </div>
            <x-admin.status-badge :status="$donation->status" :label="$donation->status_label" />
        </div>
        <dl class="mt-6 grid gap-4 sm:grid-cols-2">
            @foreach([
                'মাধ্যম' => $donation->method_label,
                'ট্রানজেকশন আইডি' => $donation->transaction_id,
                'মোবাইল' => $donation->phone,
                'ইমেইল' => $donation->email,
                'তারিখ' => $donation->donated_at ? bn_number($donation->donated_at->format('d/m/Y')) : null,
            ] as $label => $value)
                <div>
                    <dt class="text-xs uppercase tracking-wider text-gray-400">{{ $label }}</dt>
                    <dd class="mt-0.5 text-gray-800">{{ $value ?: '—' }}</dd>
                </div>
            @endforeach
        </dl>
        @if($donation->note)
            <p class="mt-4 rounded-lg bg-gray-50 p-3 text-sm text-gray-600">{{ $donation->note }}</p>
        @endif
        <div class="mt-6 flex gap-3">
            <a href="{{ route('admin.donations.edit', $donation) }}" class="btn-primary">সম্পাদনা</a>
            <a href="{{ route('admin.donations.index') }}" class="btn-outline">ফিরে যান</a>
        </div>
    </div>
</x-admin-layout>
