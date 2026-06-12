<x-admin-layout title="অনুদান সম্পাদনা">
    <form method="POST" action="{{ route('admin.donations.update', $donation) }}" class="max-w-2xl rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
        @method('PUT')
        @include('admin.donations._form')
    </form>
</x-admin-layout>
