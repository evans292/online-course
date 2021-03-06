<x-app-layout>
    <x-slot name="title">
        Courses
    </x-slot>  
    <x-slot name="nav">
        @include('layouts.navigation')
    </x-slot> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if ($class === null)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                <div class="p-6 border-b border-gray-200">
                    <h5 class="text-gray-400 p-2">fill your class in profile before accessing courses!</h5>
                </div>
            </div>
        </div>
        @else
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                <div class="p-6 bg-hero-pattern border-b border-gray-200 h-80">
                   <h1 class="text-white text-2xl">{{ $class->name }}</h1>
                   <p class="text-white text-lg">{!! $class->information !!}</p>
                </div>
            </div>
        </div>

        <div class="flex">
            <div class="w-full sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    {{-- <div class="p-6 bg-white border-b border-gray-200"> --}}
                            <ul class="list-reset flex flex-col">
                                {{-- <h1 class="p-2 mb-2 text-xl font-semibold">Class courses</h1> --}}
                                @foreach ($class->courses as $course)
                                <li class="rounded-t relative -mb-px block border p-4 border-grey"><a href="{{ route('student.courses.subject', [ 'course' => $course->id]) }}" class="hover:text-green-400">{{ $course->name }}</a></li>
                                @endforeach
                            </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</x-app-layout>
