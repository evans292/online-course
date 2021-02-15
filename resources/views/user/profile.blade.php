<x-app-layout>
    <x-slot name="title">
        Profile - {{ $data->name }}
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-between">
                    @if (Auth::user()->profilepic === null)
                    <img src="{{ asset('image/download.png') }}" class="rounded-lg w-1/4 h-1/4"> 
                    @else
                    <img src="{{ asset('storage/' . Auth::user()->profilepic) }}" class="rounded-lg w-1/4 h-1/4">
                    @endif
                    <form method="post" class="w-full ml-5" action="{{ route('profile.update', ['userid' => $data->user_id, 'profileid' => $data->id]) }}" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        @if (Auth::user()->role_id === 2)
                        <div class="mb-4">
                            <x-label for="nis" :value="__('NIS')" />
                            <x-input id="nis" class="block mt-1 w-full bg-gray-100" type="number" name="nis" value="{{ $data->nis }}" required disabled/>
                            <x-validation-message name="nis"/>
                        </div>
                        @elseif (Auth::user()->role_id === 3 || Auth::user()->role_id === 4)
                        <div class="mb-4">
                            <x-label for="nip" :value="__('NIP')" />
                            <x-input id="nip" class="block mt-1 w-full bg-gray-100" type="number" name="nip" value="{{ $data->nip }}" required disabled/>
                            <x-validation-message name="nip"/>
                        </div>
                        @endif 

                        @if (Auth::user()->role_id === 2)
                        @if ($data->schoolclass_id !== null)
                        <div class="mb-4">
                            <x-label for="class" value="{{ __('Class') }}" />
                            <select name="class" id="class" class="bg-gray-100 block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" disabled>
                                    <option value="{{ $data->schoolclass_id }}" selected>{{ $data->schoolclass->name }}</option>
                            </select>
                            <x-validation-message name="class"/>
                        </div> 
                        @else
                        <div class="mb-4">
                            <x-label for="class" value="{{ __('Class') }}" />
                            <select name="class" id="class" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option value="" class="text-gray-400" selected>-- select class --</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}" {{ ($data->schoolclass_id === $class->id) ? 'selected' : '' }}>{{ $class->name }}</option>
                                @endforeach
                            </select>
                            <x-validation-message name="class"/>
                        </div>
                        @endif
                        @endif

                        <div class="mb-4">
                            <x-label for="name" :value="__('Name')" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $data->name }}" required />
                            <x-validation-message name="name"/>
                        </div>
            
                        <div class="mb-4">
                            <x-label for="birthdate" :value="__('Birthdate')" />
                            <x-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" value="{{ $data->birthdate }}" required />
                            <x-validation-message name="birthdate"/>
                        </div>
                        
                        <div class="mb-4">
                            <x-label for="gender" value="{{ __('Gender') }}" />
                            <select name="gender" id="gender" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option value="" class="text-gray-400" selected>-- select gender --</option>
                                @foreach ($genders as $key => $gender)
                                    <option value="{{ $key }}" {{ ($data->gender === $key) ? 'selected' : '' }}>{{ $gender }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <x-label for="address" value="{{ __('Address') }}" />
                            <x-input id="address" class="block mt-1 w-full" type="text" name="address" value="{{ $data->address }}" required />
                        </div>

                        <div class="mb-4">
                            <x-label for="phone" :value="__('Phone')" />
                            <x-input id="phone" class="block mt-1 w-full" type="number" name="phone" value="{{ $data->phone }}" required />
                            <x-validation-message name="phone"/>
                        </div>

                        <div class="mb-4">
                            <x-label for="pic" :value="__('Profile Picture')" />
                            <input type="file" name="pic" id="pic" class="bg-gray-100 block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-sm shadow-sm">
                            <x-validation-message name="pic"/>
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
            Vue.$toast.success('Profile updated!', {
             duration: 1500,
             dismissible: true,
            })
        </script>
        @endif
    </x-slot>
</x-app-layout>
