<x-app-layout>
    <x-slot name="title">
        {{ __('People') }} in {{ $class->name }}
    </x-slot>  
    <x-slot name="nav">
        @include('layouts.navigation-teacher')
    </x-slot> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('People') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <h1 class="text-4xl text-green-600 font-semibold">Teachers</h1>
                        <hr class="border-green-200 my-3">
                        @foreach ($class->teachers as $teacher)
                        <div class="flex items-center my-3">
                            @if ($teacher->user->profilepic === null)
                                <img src="{{ asset('image/download.png') }}" class="rounded-full w-10 h-10 mr-2"> 
                                @else
                                <img src="{{ asset('storage/' . $teacher->user->profilepic) }}" class="rounded-full w-10 h-10 mr-2">
                            @endif
                            <p class="ml-2">{{ $teacher->name }}</p>
                        </div>
                        <hr>
                        @endforeach
                    </div>

                    <div class="my-10">
                        <div class="flex items-center justify-between">
                            <h1 class="text-4xl text-green-600 font-semibold">Classmates</h1>
                            <p class="text-green-600 font-semibold">{{ $class->students->count() }} students</p>
                        </div>
                        <hr class="border-green-200 my-3">
                        @foreach ($class->students as $student)
                        <div class="flex items-center my-3">
                            @if ($student->user->profilepic === null)
                                <img src="{{ asset('image/download.png') }}" class="rounded-full w-10 h-10 mr-2"> 
                                @else
                                <img src="{{ asset('storage/' . $student->user->profilepic) }}" class="rounded-full w-10 h-10 mr-2">
                            @endif
                            <p class="ml-2">{{ $student->name }}</p>
                        </div>
                        <hr>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
