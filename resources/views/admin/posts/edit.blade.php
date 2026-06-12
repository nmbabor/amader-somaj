<x-admin-layout title="পোস্ট সম্পাদনা">
    <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data"
          class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
        @method('PUT')
        @include('admin.posts._form')
    </form>
</x-admin-layout>
