<x-admin-layout title="ক্যাটাগরি সম্পাদনা">
    <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="max-w-xl rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
        @method('PUT')
        @include('admin.categories._form')
    </form>
</x-admin-layout>
