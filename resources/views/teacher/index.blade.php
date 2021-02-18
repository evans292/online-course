<x-app-layout>
    <x-slot name="title">
        Courses
    </x-slot>  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Class List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                        {{-- @if ($class === null)
                        <h5 class="text-gray-400 p-2">fill your class in profile before accessing courses!</h5>
                        @else --}}
                        <ul class="list-reset flex flex-col">
                            <h1 class="p-2 mb-2 text-xl font-semibold">My class</h1>
                            @if ($classes->count() === 0)
                                <h5 class="text-gray-400 p-2">contact admin to map your class!</h5>
                            @else
                            @foreach ($classes as $class)
                                <li class="rounded-t relative -mb-px block border p-4 border-grey"><a href="{{ route('teacher.courses.show', ['course' => $class->pivot->schoolclass_id]) }}" class="hover:text-green-400">{{ $class->name }}</a></li>
                            @endforeach
                            @endif
                        </ul>
                    {{-- @endif --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
