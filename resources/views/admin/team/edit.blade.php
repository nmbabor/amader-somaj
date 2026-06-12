<x-admin-layout title="টিম মেম্বার সম্পাদনা">
    <form method="POST" action="{{ route('admin.team-members.update', $member) }}" enctype="multipart/form-data" class="max-w-2xl rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
        @method('PUT')
        @include('admin.team._form')
    </form>
</x-admin-layout>
