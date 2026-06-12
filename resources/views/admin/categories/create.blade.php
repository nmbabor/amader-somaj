<x-admin-layout title="নতুন ক্যাটাগরি">
    <form method="POST" action="{{ route('admin.categories.store') }}" class="max-w-xl rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
        @include('admin.categories._form')
    </form>
</x-admin-layout>
