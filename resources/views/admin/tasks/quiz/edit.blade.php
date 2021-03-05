<x-app-layout>
    <x-slot name="title">
        Edit assignment
    </x-slot>
    <x-slot name="nav">
        @include('layouts.navigation-admin')
    </x-slot> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit subject') }} - {{ $quiz->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-between">
                    <form method="post" class="w-full ml-5" action="{{ route('admin.quiz.update', ['quiz' => $quiz->id]) }}" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="classId" value="{{ $quiz->schoolclass_id }}">

                        <div class="mb-4">
                            <x-label for="title" :value="__('Title')" />
                            <x-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $quiz->title }}" required />
                            <x-validation-message name="title"/>
                        </div>

                        <div class="mb-4">
                            <x-label for="instructions" :value="__('Instructions')" />
                            {{-- <x-input id="instructions" class="block mt-1 w-full" type="text" name="instructions" value="{{ $quiz->instructions }}" required /> --}}
                            <textarea name="instructions" id="instructions" cols="30" rows="10" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ $quiz->instructions }}</textarea>
                            <x-validation-message name="instructions"/>
                        </div>

                        <div class="mb-4">
                            <x-label for="point" value="{{ __('Point') }}" />
                            <select name="point" id="point" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm select2">
                                @if ($quiz->point !== null)
                                    <option value="{{ $quiz->point }}" selected>{{ $quiz->point }}</option>    
                                @else
                                <option value="" selected>Ungraded</option> 
                                @endif   
                                <option value="">Ungraded</option> 
                                <option value="100">100</option>
                                <option value="10">10</option>
                            </select>
                            <x-validation-message name="course"/>
                        </div>

                        <div class="mb-4">
                            <x-label for="subject" value="{{ __('Subject') }}" />
                            <select name="subject" id="subject" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm select2">
                                @foreach (Auth::user()->admins[0]->subjectmatters as $subject)
                                    <option value="{{ $subject->id }}" {{ ($subject->id === $quiz->subjectmatter_id) ? 'selected' : '' }}>{{ $subject->title }}</option>
                                @endforeach
                            </select>
                            <x-validation-message name="subject"/>
                        </div>

                        <div class="mb-4">
                            <x-label for="due" :value="__('Due date')" />
                            <x-input id="due" class="block mt-1 w-full" type="date" name="due" value="{{ $quiz->due->format('Y-m-d') }}" required />
                            <x-validation-message name="due"/>
                        </div>

                        <div class="flex items-center justify-end mt-4">            
                            <x-button class="ml-3">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() { 
                success('Assignment updated!')
            }, true); 
        </script>
        @endif
    </x-slot>
</x-app-layout>
