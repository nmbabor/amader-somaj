<x-admin-layout title="ছবি সম্পাদনা">
    <form method="POST" action="{{ route('admin.photos.update', $photo) }}" enctype="multipart/form-data" class="max-w-xl rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
        @method('PUT')
        @include('admin.photos._form')
    </form>
</x-admin-layout>
