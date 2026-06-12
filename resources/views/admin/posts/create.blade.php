<x-admin-layout title="নতুন পোস্ট">
    <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data"
          class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
        @include('admin.posts._form')
    </form>
</x-admin-layout>
