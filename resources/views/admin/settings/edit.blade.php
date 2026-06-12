<x-admin-layout title="সেটিংস">
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        @foreach($schema as $group => $fields)
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                <h2 class="mb-5 border-b border-gray-100 pb-3 text-lg font-bold text-gray-900">{{ $group }}</h2>
                <div class="grid gap-5 sm:grid-cols-2">
                    @foreach($fields as $key => [$label, $type])
                        <div class="{{ in_array($type, ['textarea']) ? 'sm:col-span-2' : '' }}">
                            <label class="form-label" for="{{ $key }}">{{ $label }}</label>
                            @if($type === 'textarea')
                                <textarea id="{{ $key }}" name="{{ $key }}" rows="3" class="form-textarea">{{ old($key, $values[$key] ?? '') }}</textarea>
                            @elseif($type === 'image')
                                @if(! empty($values[$key]))
                                    <img src="{{ asset('storage/'.$values[$key]) }}" alt="" class="mb-2 h-20 rounded-lg object-cover">
                                @endif
                                <input id="{{ $key }}" name="{{ $key }}" type="file" accept="image/*" class="form-input file:mr-3 file:rounded-md file:border-0 file:bg-brand-50 file:px-3 file:py-1.5 file:text-brand-700">
                            @elseif($type === 'number')
                                <input id="{{ $key }}" name="{{ $key }}" type="number" value="{{ old($key, $values[$key] ?? '') }}" class="form-input">
                            @else
                                <input id="{{ $key }}" name="{{ $key }}" type="text" value="{{ old($key, $values[$key] ?? '') }}" class="form-input">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="sticky bottom-4">
            <button type="submit" class="btn-primary shadow-lg">সব সেটিংস সংরক্ষণ করুন</button>
        </div>
    </form>
</x-admin-layout>
