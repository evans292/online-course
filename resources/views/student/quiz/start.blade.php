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

    <form action="{{ route('results.store') }}" method="POST">
        @csrf
        <input type="hidden" name="quiz_id" value="{{$quiz->id}}">
        @foreach ($quiz->questions as $question)
        <div class="py-6">
            <div class="w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex items-center">
                            <h1 class="text-2xl mr-3 p-2">{{ $loop->iteration }} . </h1>
                            <p class="text-xl font-semibold">{{ $question->question }}</p>
                        </div>
                        <hr class="my-5 border-green-400">
                        <ul class="list-reset flex flex-col">
                            <input type="hidden" name="question_id[]" value="{{$question->id}}">
                            @foreach ($question->options as $option)
                                <li class="rounded-t relative -mb-px block border p-4 border-grey flex items-center">
                                    <input type="radio"
                                    name="option[{{$question->id}}][{{$option->id}}]"
                                    value="{{$option->correct}}"
                                    class="ml-2"
                                    />
                                    <span class="ml-3">
                                    {{ $option->option }} 
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="flex items-center justify-end mt-4 px-8 my-5">            
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Submit
            </button>
        </div>
    </form>


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
