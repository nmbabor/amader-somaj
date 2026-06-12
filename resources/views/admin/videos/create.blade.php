<x-admin-layout title="নতুন ভিডিও">
    <form method="POST" action="{{ route('admin.videos.store') }}" enctype="multipart/form-data" class="max-w-xl rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
        @include('admin.videos._form')
    </form>
</x-admin-layout>
