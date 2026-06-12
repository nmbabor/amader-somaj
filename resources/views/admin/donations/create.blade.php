<x-admin-layout title="নতুন অনুদান এন্ট্রি">
    <form method="POST" action="{{ route('admin.donations.store') }}" class="max-w-2xl rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
        @include('admin.donations._form')
    </form>
</x-admin-layout>
