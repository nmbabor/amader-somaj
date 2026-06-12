<x-admin-layout title="নতুন টিম মেম্বার">
    <form method="POST" action="{{ route('admin.team-members.store') }}" enctype="multipart/form-data" class="max-w-2xl rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
        @include('admin.team._form')
    </form>
</x-admin-layout>
