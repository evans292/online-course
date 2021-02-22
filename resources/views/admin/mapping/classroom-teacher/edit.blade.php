<x-admin-layout>
    <x-slot name="title">
      Edit Class - Teacher ({{ $class->name }})
    </x-slot>  

    <div class="px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-between">
                    <form method="post" class="w-full ml-5" action="{{ route('admin.classroom-teacher.update', ['class' => $class->id]) }}" novalidate>
                        @csrf
                        @method('patch')
                        <div class="mb-4">
                            <x-label for="name" :value="__('Name')" />
                            <x-input id="name" class="block mt-1 w-full bg-gray-200" type="text" name="name" value="{{ $class->name }}" required readonly/>
                            <x-validation-message name="name"/>
                        </div>

                        <div class="mb-4">
                            <x-label for="teacher" value="{{ __('Teacher') }}" />
                            <select name="teacher[]" id="teacher" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm select2" multiple>
                                @foreach ($class->teachers as $teacher)
                                    <option selected value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                            <x-validation-message name="teacher"/>
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
        <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create( document.querySelector( '#information' ), {
                    removePlugins: [ 'Link' ],
                    toolbar: [ 'heading','bold', 'italic', 'blockQuote' ]
                } )
                .catch( error => {
                    console.error( error );
                } );
        </script>
        @if (session('success'))
        <script>
            Vue.use(VueToast);
            Vue.$toast.success('Teacher updated!', {
             duration: 1500,
             dismissible: true,
            })
        </script>
        @endif
    </x-slot>

  </x-admin-layout>