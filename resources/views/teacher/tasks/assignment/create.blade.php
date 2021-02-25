<x-teacher-layout>
    <x-slot name="title">
        Create assignment
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new assignment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-between">
                    <form method="post" class="w-full ml-5" action="{{ route('teacher.assignment.store') }}" novalidate enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <x-label for="title" :value="__('Title')" />
                            <x-input id="title" class="block mt-1 w-full" type="text" name="title" value="" required />
                            <x-validation-message name="title"/>
                        </div>

                        <div class="mb-4">
                            <x-label for="instructions" :value="__('Instructions')" />
                            {{-- <x-input id="instructions" class="block mt-1 w-full" type="text" name="instructions" value="" required /> --}}
                            <textarea name="instructions" id="instructions" cols="30" rows="10" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                            <x-validation-message name="instructions"/>
                        </div>

                        <div class="mb-4">
                            <x-label for="point" value="{{ __('Point') }}" />
                            <select name="point" id="point" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm select2">
                                <option value="" class="text-gray-400" selected>-- select point --</option>
                                    <option value="100">100</option>
                                    <option value="10">10</option>
                                    <option value="ungraded">Ungraded</option>
                            </select>
                            <x-validation-message name="course"/>
                        </div>

                        <div class="mb-4">
                            <x-label for="course" value="{{ __('Course') }}" />
                            <select name="course" id="course" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm select2">
                                <option value="" class="text-gray-400" selected>-- select course --</option>
                                @foreach (Auth::user()->teachers[0]->subjectmatters as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->title }}</option>
                                @endforeach
                            </select>
                            <x-validation-message name="course"/>
                        </div>

                        <div class="mb-4">
                            <x-label for="birthdate" :value="__('Due date')" />
                            <x-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" value="" required />
                            <x-validation-message name="birthdate"/>
                        </div>

                        <div class="mb-4">
                            <x-label for="path" :value="__('Assignment attachment (audio, document, image)')" />
                            <input type="file" name="path" id="path" class="bg-gray-100 block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-sm shadow-sm">
                            <x-validation-message name="path"/>
                        </div>

                        <div class="flex items-center justify-end mt-4">            
                            <x-button class="ml-3">
                                {{ __('Add') }}
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
            Vue.$toast.success('Subject added!', {
             duration: 1500,
             dismissible: true,
            })
        </script>
        @endif
    </x-slot>
</x-teacher-layout>
