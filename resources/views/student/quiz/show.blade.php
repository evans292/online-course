<x-app-layout>
    <x-slot name="title">
        Quiz No. {{ $quiz->id }}
    </x-slot>  
    <x-slot name="nav">
        @include('layouts.navigation-student')
    </x-slot> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Quiz No. {{ $quiz->id }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-between">
        {{-- if due is yesterday --}}
        @if (Carbon\Carbon::now()->subDay()->format('Y-m-d') === $quiz->due->format('Y-m-d'))
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <i class="fas fa-clipboard-list text-white text-2xl mr-3 bg-gray-400 p-2 rounded-lg"></i>
                            <a class="text-xl text-gray-700 font-semibold">{{ $quiz->title }} (closed)</a>
                        </div>
                    </div>

                    @if ($quiz->teacher['name'] !== null)
                    <p class="ml-12 text-gray-400 text-sm mt-1">{{ $quiz->teacher['name'] }} <span class="text-xs">•</span> {{ $quiz->created_at->format('M d') }}</p>
                @else
                    <p class="ml-12 text-gray-400 text-sm mt-1">{{ $quiz->admin['name'] }} <span class="text-xs">•</span> {{ $quiz->created_at->format('M d') }}</p>
                @endif
                    {{-- tulisan point di bawah nama guru --}}
                    @if ($done === null)
                        <p class="ml-12 text-sm mt-2 font-semibold">{{ $quiz->point }} points</p>
                    @else
                        <p class="ml-12 text-sm mt-2 font-semibold">{{ $done->grade }} / <span class="font-normal text-gray-400">{{ $quiz->point }}</span></p>
                    @endif

                    <hr class="my-5 border-gray-400">

                    <p class="text-gray-400 class="text-justify"">{{ $quiz->instructions }}</p>

                    <hr class="my-5 border">

                </div>
            </div>
        </div> 
        <div class="w-2/4 sm:px-6 lg:px-8 mb-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                <div class="p-6 bg-white">
                    <div class="items-center">
                        <h1 class="text-2xl">Your Quiz</h1>
                    {{-- status --}}
                    @if ($done === null)
                    <a href="#" class="inline-flex items-center px-4 py-2 bg-red-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mt-3 w-full normal-case">
                        <i class="fas fa-times text-white mr-2"></i>
                        Closed
                    </a>
                    @else
                    <a href="{{ route('results.show', ['result' => Request::segment(7), 'student' => Auth::user()->students[0]->id]) }}" class="inline-flex items-center px-4 py-2 bg-indigo-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mt-3 w-full normal-case">
                        <i class="fas fa-eye text-white mr-2"></i>
                        View Result
                    </a>
                    @endif
                    </div>
                </div>
            </div>
        </div>
        
        {{-- else due is yesterday --}}
        @else
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <i class="fas fa-clipboard-list text-white text-2xl mr-3 bg-green-400 p-2 rounded-lg"></i>
                            <a class="text-xl text-green-700 font-semibold">{{ $quiz->title }}</a>
                        </div>
                    </div>
                @if ($quiz->teacher['name'] !== null)
                    <p class="ml-12 text-gray-400 text-sm mt-1">{{ $quiz->teacher['name'] }} <span class="text-xs">•</span> {{ $quiz->created_at->format('M d') }}</p>
                @else
                    <p class="ml-12 text-gray-400 text-sm mt-1">{{ $quiz->admin['name'] }} <span class="text-xs">•</span> {{ $quiz->created_at->format('M d') }}</p>
                @endif
                    {{-- tulisan point di bawah nama guru --}}
                    @if ($done === null)
                        <p class="ml-12 text-sm mt-2 font-semibold">{{ $quiz->point }} points</p>
                    @else
                        <p class="ml-12 text-sm mt-2 font-semibold">{{ $done->grade }} / <span class="font-normal text-gray-400">{{ $quiz->point }}</span></p>
                    @endif

                    <hr class="my-5 border-green-400">

                    <p class="text-justify">{{ $quiz->instructions }}</p>

                    <hr class="my-5 border">
                </div>
            </div>
        </div>

        <div class="w-2/4 sm:px-6 lg:px-8 mb-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                <div class="p-6 bg-white">
                    <div class="items-center">
                        <h1 class="text-2xl">Your Quiz</h1>
                    {{-- status --}}
                    @if ($done === null)
                    <a href="{{ route('student.courses.subject.quiz.details.start', ['course' => Request::segment(3), 'subject' => Request::segment(5), 'quiz' => Request::segment(7)]) }}" class="inline-flex items-center px-4 py-2 bg-green-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mt-3 w-full normal-case">
                        <i class="fas fa-stopwatch text-white mr-2"></i>
                        Start Quiz
                    </a>
                    @else
                    <a href="{{ route('results.show', ['result' => Request::segment(7), 'student' => Auth::user()->students[0]->id]) }}" class="inline-flex items-center px-4 py-2 bg-indigo-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mt-3 w-full normal-case">
                        <i class="fas fa-eye text-white mr-2"></i>
                        View Result
                    </a>
                    @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <x-slot name="script">
        @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() { 
                success('Accumulation turned in!')
            }, true); 
        </script>
        @elseif (session('destroy'))
        <script>
            document.addEventListener('DOMContentLoaded', function() { 
                success('Accumulation turned back!')
            }, true); 
        </script>
        @endif
    </x-slot>
</x-app-layout>
