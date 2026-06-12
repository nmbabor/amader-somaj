@props(['status', 'label' => null])

@php
    $map = [
        'pending' => 'bg-amber-100 text-amber-700',
        'approved' => 'bg-green-100 text-green-700',
        'verified' => 'bg-green-100 text-green-700',
        'rejected' => 'bg-red-100 text-red-700',
    ];
    $class = $map[$status] ?? 'bg-gray-100 text-gray-600';
@endphp

<span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium {{ $class }}">
    {{ $label ?? $status }}
</span>
