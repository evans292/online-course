<x-app-layout>
    <x-slot name="title">
        Lessons
    </x-slot>  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lessons List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="p-2 mb-2 text-xl font-semibold">{{ $class->name }}</h1>
                    <ul class="list-reset flex flex-col">
                        @foreach ($class->courses as $course)
                            <li class="rounded-t relative -mb-px block border p-4 border-grey">{{ $course->name }}</li>
                        @endforeach
                      </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
