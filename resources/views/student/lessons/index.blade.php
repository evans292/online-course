<x-app-layout>
    <x-slot name="title">
        Lessons
    </x-slot>  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lessons List') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <ul class="list-disc">
                @foreach ($courses as $course)
                    <li class="">{{ $course->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
