<x-admin-layout title="ড্যাশবোর্ড">
    {{-- Stat cards --}}
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @php
            $cards = [
                ['label' => 'মোট কার্যক্রম', 'value' => $stats['posts'], 'color' => 'bg-blue-500', 'route' => 'admin.posts.index'],
                ['label' => 'মোট ছবি', 'value' => $stats['photos'], 'color' => 'bg-purple-500', 'route' => 'admin.photos.index'],
                ['label' => 'মোট ভিডিও', 'value' => $stats['videos'], 'color' => 'bg-rose-500', 'route' => 'admin.videos.index'],
                ['label' => 'মোট সদস্য', 'value' => $stats['members'], 'color' => 'bg-brand-600', 'route' => 'admin.members.index'],
            ];
        @endphp
        @foreach($cards as $card)
            <a href="{{ route($card['route']) }}" class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100 transition hover:shadow-md">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">{{ $card['label'] }}</span>
                    <span class="h-2.5 w-2.5 rounded-full {{ $card['color'] }}"></span>
                </div>
                <p class="mt-2 text-3xl font-bold text-gray-900">{{ bn_number($card['value']) }}</p>
            </a>
        @endforeach
    </div>

    {{-- Highlights --}}
    <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-2xl bg-amber-50 p-5 ring-1 ring-amber-100">
            <p class="text-sm text-amber-700">অপেক্ষমাণ সদস্য</p>
            <p class="mt-1 text-2xl font-bold text-amber-800">{{ bn_number($stats['members_pending']) }}</p>
        </div>
        <div class="rounded-2xl bg-green-50 p-5 ring-1 ring-green-100">
            <p class="text-sm text-green-700">যাচাইকৃত তহবিল</p>
            <p class="mt-1 text-2xl font-bold text-green-800">৳{{ bn_number(number_format($stats['donations_total'])) }}</p>
        </div>
        <div class="rounded-2xl bg-orange-50 p-5 ring-1 ring-orange-100">
            <p class="text-sm text-orange-700">অপেক্ষমাণ অনুদান</p>
            <p class="mt-1 text-2xl font-bold text-orange-800">{{ bn_number($stats['donations_pending']) }}</p>
        </div>
        <div class="rounded-2xl bg-sky-50 p-5 ring-1 ring-sky-100">
            <p class="text-sm text-sky-700">নতুন বার্তা</p>
            <p class="mt-1 text-2xl font-bold text-sky-800">{{ bn_number($stats['contacts_unread']) }}</p>
        </div>
    </div>

    {{-- Recent tables --}}
    <div class="mt-6 grid gap-6 lg:grid-cols-2">
        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100">
            <div class="flex items-center justify-between">
                <h2 class="font-bold text-gray-900">সাম্প্রতিক সদস্য আবেদন</h2>
                <a href="{{ route('admin.members.index') }}" class="text-sm text-brand-700 hover:underline">সব দেখুন</a>
            </div>
            <div class="mt-4 divide-y divide-gray-100">
                @forelse($recentMembers as $m)
                    <div class="flex items-center justify-between py-2.5">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $m->name }}</p>
                            <p class="text-xs text-gray-500">{{ $m->phone }} · {{ $m->tier_label }}</p>
                        </div>
                        <x-admin.status-badge :status="$m->status" :label="$m->status_label" />
                    </div>
                @empty
                    <p class="py-4 text-sm text-gray-400">কোনো সদস্য নেই।</p>
                @endforelse
            </div>
        </div>

        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100">
            <div class="flex items-center justify-between">
                <h2 class="font-bold text-gray-900">সাম্প্রতিক অনুদান</h2>
                <a href="{{ route('admin.donations.index') }}" class="text-sm text-brand-700 hover:underline">সব দেখুন</a>
            </div>
            <div class="mt-4 divide-y divide-gray-100">
                @forelse($recentDonations as $d)
                    <div class="flex items-center justify-between py-2.5">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $d->donor_name }}</p>
                            <p class="text-xs text-gray-500">{{ $d->method_label }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-900">৳{{ bn_number(number_format($d->amount)) }}</p>
                            <x-admin.status-badge :status="$d->status" :label="$d->status_label" />
                        </div>
                    </div>
                @empty
                    <p class="py-4 text-sm text-gray-400">কোনো অনুদান নেই।</p>
                @endforelse
            </div>
        </div>
    </div>
</x-admin-layout>
