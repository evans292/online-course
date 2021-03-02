<x-app-layout>
    <x-slot name="title">
        Edit subject 
    </x-slot>
    <x-slot name="nav">
        @include('layouts.navigation')
    </x-slot> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit subject') }} - {{ $subject->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-between">
                    <form method="post" class="w-full ml-5" action="{{ route('teacher.courses.update', ['course' => $subject->id]) }}" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="mb-4">
                            <x-label for="title" :value="__('Title')" />
                            <x-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $subject->title }}" required />
                            <x-validation-message name="title"/>
                        </div>

                        <div class="mb-4">
                            <x-label for="details" :value="__('Details')" />
                            {{-- <x-input id="details" class="block mt-1 w-full" type="text" name="details" value="" required /> --}}
                            <textarea name="details" id="details" cols="30" rows="10" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ $subject->details }}</textarea>
                            <x-validation-message name="details"/>
                        </div>

                        <div class="mb-4">
                            <x-label for="link" :value="__('Youtube Link')" />
                            <x-input id="link" class="block mt-1 w-full" type="text" name="link" value="{{ $subject->link }}" required />
                            <x-validation-message name="link"/>
                        </div>

                        <div class="mb-4">
                            <x-label for="course" value="{{ __('Course') }}" />
                            <select name="course" id="course" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm select2">
                                {{-- <option value="" class="text-gray-400" selected>-- select course --</option> --}}
                                @foreach (Auth::user()->teachers[0]->courses as $course)
                                    <option value="{{ $course->id }}" {{ ($subject->course_id === $course->id) ? 'selected' : '' }}>{{ $course->name }}</option>
                                @endforeach
                            </select>
                            <x-validation-message name="course"/>
                        </div>

                        <div class="mb-4">
                            <x-label for="path" :value="__('Subject attachment (audio, document, image)')" />
                            <input type="file" name="path" id="path" class="bg-gray-100 block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-sm shadow-sm">
                            <x-validation-message name="path"/>
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
            Vue.use(VueToast);
            Vue.$toast.success('Subject updated!', {
             duration: 1500,
             dismissible: true,
            })
        </script>
        @endif
    </x-slot>
</x-app-layout>
