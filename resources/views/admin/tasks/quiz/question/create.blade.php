<x-app-layout>
    <x-slot name="title">
        {{ __('Add question') }}
    </x-slot>  
    <x-slot name="nav">
        @include('layouts.navigation-admin-quiz')
    </x-slot> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add question') }} ({{ $quiz->title }})
        </h2>
    </x-slot>

    <div class="flex justify-end">
        <div class="w-full py-6  sm:px-6 lg:px-8 self-end">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="post" class="ml-5" action="{{ route('admin.question.store', ['class' => Request::segment(3), 'quiz' => $quiz->id]) }}" novalidate enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <x-label for="question" :value="__('Question')" />
                            <x-input id="question" class="block mt-1 w-full" type="text" name="question" value="{{ old('question') }}" required />
                            <x-validation-message name="question"/>
                        </div>
        
                </div>
            </div>
        </div>

       
    </div>

    <div class="w-full py-6  sm:px-6 lg:px-8 self-end">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <x-label for="question" :value="__('*Fill all the option (radio is for correct answer)')" />
                    <div class="mb-4 flex items-center">
                        <x-input class="block mt-1 w-full" type="text" name="option[]" placeholder="option 1" required />

                        <input type="radio"
                        name="correct[]"
                        value="1"
                        placeholder="Iveskite atsakyma"
                        class="ml-2"
                        />
                    </div>
                    <div class="mb-4 flex items-center">
                        <x-input class="block mt-1 w-full" type="text" name="option[]" placeholder="option 2" required />

                        <input type="radio"
                        name="correct[]"
                        value="2"
                        placeholder="Iveskite atsakyma"
                        class="ml-2"
                        />
                    </div>
                    <div class="mb-4 flex items-center">
                        <x-input class="block mt-1 w-full" type="text" name="option[]" placeholder="option 3" required />

                        <input type="radio"
                        name="correct[]"
                        value="3"
                        placeholder="Iveskite atsakyma"
                        class="ml-2"
                        />
                    </div>
                    <div class="mb-4 flex items-center">
                        <x-input class="block mt-1 w-full" type="text" name="option[]" placeholder="option 4" required />

                        <input type="radio"
                        name="correct[]"
                        value="4"
                        placeholder="Iveskite atsakyma"
                        class="ml-2"
                        />
                    </div>
                    
    
                    <div class="flex items-center justify-end mt-4">            
                        <x-button class="ml-3">
                            {{ __('Add question') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-slot name="script">
        @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() { 
                success('Question added!')
            }, true); 
        </script>
        @endif
    </x-slot>
</x-app-layout>
