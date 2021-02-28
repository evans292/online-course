<x-app-layout>
    <x-slot name="title">
        Courses
    </x-slot>  
    <x-slot name="nav">
        @include('layouts.navigation')
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
                        <h1 class="p-2 mb-2 text-xl font-semibold">My class</h1>
                        <ul class="list-reset flex flex-row flex-wrap">
                            @if ($classes->count() === 0)
                                <h5 class="text-gray-400 p-2">contact admin to map your class!</h5>
                            @else
                            @foreach ($classes as $class)
                                {{-- <li class="rounded-t relative -mb-px block border p-4 border-grey"><a href="{{ route('teacher.courses.show', ['course' => $class->pivot->schoolclass_id]) }}" class="hover:text-green-400">{{ $class->name }}</a></li>
                                 --}}
                            <!-- Column -->
                            <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">

                                <!-- Article -->
                                <article class="overflow-hidden rounded-lg shadow-lg">

                                    <a href="{{ route('teacher.courses.show', ['course' => $class->pivot->schoolclass_id]) }}">
                                        <img alt="Placeholder" class="block h-auto w-full" src="https://picsum.photos/600/400/?random">
                                    </a>

                                    <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                                        <h1 class="text-lg">
                                            <a class="no-underline hover:underline text-black" href="{{ route('teacher.courses.show', ['course' => $class->pivot->schoolclass_id]) }}">
                                                {{ $class->name }}
                                            </a>
                                        </h1>
                                        <p class="text-grey-darker text-sm">
                                            
                                        </p>
                                    </header>

                                    <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                                        <div class="flex items-center text-black">
                                            @if ($class->teacher_id !== null)
                                                @if ($class->teacher->user->profilepic === null)
                                                <img src="{{ asset('image/download.png') }}" class="block rounded-full w-8 h-8"> 
                                                @else
                                                <img src="{{ asset('storage/' . $class->teacher->user->profilepic) }}" class="block rounded-full w-8 h-8">
                                                @endif
                                            {{-- <img alt="Placeholder" class="block rounded-full" src="https://picsum.photos/32/32/?random"> --}}
                                            <p class="ml-2 text-sm">
                                                {{ $class->teacher->name }}
                                            </p>
                                            @else
                                                <img src="{{ asset('image/download.png') }}" class="block rounded-full w-8 h-8"> 
                                                <p class="ml-2 text-sm">
                                                    No class chief!
                                                </p>
                                            @endif
                                        </div>
                                        <div class="text-grey-darker hover:text-red-dark" href="#">
                                            <span class="hidden">Like</span>
                                            <i class="fa fa-clipboard"></i>
                                        </div>
                                    </footer>

                                </article>
                                <!-- END Article -->

                            </div>
                            <!-- END Column -->
                            @endforeach
                            @endif
                        </ul>
                    {{-- @endif --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
