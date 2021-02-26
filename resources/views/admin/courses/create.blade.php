<x-admin-layout>
    <x-slot name="title">
      {{ __('Create Course') }}
    </x-slot>  

    <div class="px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-between">
                    <form method="post" class="w-full ml-5" action="{{ route('admin.courses.store') }}" novalidate>
                        @csrf
                        <div class="mb-4">
                            <x-label for="name" :value="__('Name')" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required />
                            <x-validation-message name="name"/>
                        </div>

                        <div class="mb-4">
                            <x-label for="information" :value="__('Information')" />
                            {{-- <x-input id="details" class="block mt-1 w-full" type="text" name="details" value="" required /> --}}
                            <textarea name="information" id="information" cols="30" rows="10" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('information') }}</textarea>
                            <x-validation-message name="information"/>
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

  </x-admin-layout>