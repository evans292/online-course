<x-teacher-layout>
    <x-slot name="title">
        Edit assignment
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit subject') }} - {{ $ass->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-between">
                    <form method="post" class="w-full ml-5" action="{{ route('teacher.assignment.update', ['assignment' => $ass->id]) }}" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="classId" value="{{ $ass->schoolclass_id }}">

                        <div class="mb-4">
                            <x-label for="title" :value="__('Title')" />
                            <x-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $ass->title }}" required />
                            <x-validation-message name="title"/>
                        </div>

                        <div class="mb-4">
                            <x-label for="instructions" :value="__('Instructions')" />
                            {{-- <x-input id="instructions" class="block mt-1 w-full" type="text" name="instructions" value="{{ $ass->instructions }}" required /> --}}
                            <textarea name="instructions" id="instructions" cols="30" rows="10" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ $ass->instructions }}</textarea>
                            <x-validation-message name="instructions"/>
                        </div>

                        <div class="mb-4">
                            <x-label for="point" value="{{ __('Point') }}" />
                            <select name="point" id="point" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm select2">
                                @if ($ass->point !== null)
                                    <option value="{{ $ass->point }}" selected>{{ $ass->point }}</option>    
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
                                @foreach (Auth::user()->teachers[0]->subjectmatters as $subject)
                                    <option value="{{ $subject->id }}" {{ ($subject->id === $ass->subjectmatter_id) ? 'selected' : '' }}>{{ $subject->title }}</option>
                                @endforeach
                            </select>
                            <x-validation-message name="subject"/>
                        </div>

                        <div class="mb-4">
                            <x-label for="due" :value="__('Due date')" />
                            <x-input id="due" class="block mt-1 w-full" type="date" name="due" value="{{ $ass->due->format('Y-m-d') }}" required />
                            <x-validation-message name="due"/>
                        </div>

                        <div class="mb-4">
                            <x-label for="path" :value="__('Assignment attachment (audio, document, image)')" />
                            <input type="file" name="path" id="path" class="bg-gray-100 block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-sm shadow-sm">
                            <x-validation-message name="path"/>
                        </div>

                        <div class="mb-4">
                            <x-label for="status" value="{{ __('Status') }}" />
                            <select name="status" id="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm select2">
                                @foreach ($status as $stat)
                                <option value="{{ $stat }}" {{ ($stat === $ass->status) ? 'selected' : '' }}>{{ $stat }}</option>    
                                @endforeach
                            </select>
                            <x-validation-message name="status"/>
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
            Vue.$toast.success('Assignment updated!', {
             duration: 1500,
             dismissible: true,
            })
        </script>
        @endif
    </x-slot>
</x-teacher-layout>
