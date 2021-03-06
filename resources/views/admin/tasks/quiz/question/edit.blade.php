<x-app-layout>
    <x-slot name="title">
        {{ __('Edit question') }}
    </x-slot>  
    <x-slot name="nav">
        @include('layouts.navigation-admin-quiz')
    </x-slot> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit question') }} ({{ $question->question }})
        </h2>
    </x-slot>

    <div class="flex justify-end">
        <div class="w-full py-6  sm:px-6 lg:px-8 self-end">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="post" class="ml-5" action="{{ route('admin.question.update', ['class' => Request::segment(3), 'quiz' => $quiz->id, 'question' => $question->id]) }}" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="mb-4">
                            <x-label for="question" :value="__('Question')" />
                            <x-input id="question" class="block mt-1 w-full" type="text" name="question" value="{{ $question->question }}" required />
                            <x-validation-message name="question"/>
                        </div>

                        <div class="flex items-center justify-end mt-4">            
                            <x-button class="ml-3">
                                {{ __('Update question') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            {{-- <div class="p-6 bg-white border-b border-gray-200"> --}}
                    {{-- @if ($class === null)
                    <h5 class="text-gray-400 p-2">fill your class in profile before accessing courses!</h5>
                    @else --}}
                    <ul class="list-reset flex flex-col">
                        {{-- <h1 class="p-2 mb-2 text-xl font-semibold">Class courses</h1> --}}
                        @foreach ($question->options as $option)
                            <li class="rounded-t relative -mb-px block border p-4 border-grey flex items-center justify-between">
                                {{ $option->option }} 
                                @if ($option->correct == 0)
                                <i class="fas fa-times text-red-400"></i>
                                @else 
                                <i class="fas fa-check text-green-400"></i>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                {{-- @endif --}}
            </div>
        </div>
    </div>

    <x-slot name="script">
        @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() { 
                success('Question updated!')
            }, true); 
        </script>
        @endif
    </x-slot>
</x-app-layout>
