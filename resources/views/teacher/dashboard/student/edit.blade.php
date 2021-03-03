<x-teacher-layout>
    <x-slot name="title">
      Edit Student - {{ $student->name }}
    </x-slot>  

    <div class="px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-between">
                    @if ($student->user->profilepic === null)
                    <img src="{{ asset('image/download.png') }}" class="rounded-lg w-1/4 h-1/4"> 
                    @else
                    <img src="{{ asset('storage/' . $student->user->profilepic) }}" class="rounded-lg w-1/4 h-1/4">
                    @endif
                    <form method="post" class="w-full ml-5" action="{{ route('teacher.students.update', ['student' => $student->id]) }}" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                            <div class="mb-4">
                                <x-label for="nis" :value="__('NIS')" />
                                <x-input id="nis" class="block mt-1 w-full" type="number" name="nis" value="{{ $student->nis }}" required/>
                                <x-validation-message name="nis"/>
                            </div>
    
                            <div class="mb-4">
                                <x-label for="class" value="{{ __('Class') }}" />
                                <select name="class" id="class" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                    <option value="" class="text-gray-400" selected>-- select class --</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}" {{ ($student->schoolclass_id === $class->id) ? 'selected' : '' }}>{{ $class->name }}</option>
                                    @endforeach
                                </select>
                                <x-validation-message name="class"/>
                            </div>
    
                            <div class="mb-4">
                                <x-label for="name" :value="__('Name')" />
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $student->name }}" required />
                                <x-validation-message name="name"/>
                            </div>
                
                            <div class="mb-4">
                                <x-label for="birthdate" :value="__('Birthdate')" />
                                <x-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" value="{{ $student->birthdate }}" required />
                                <x-validation-message name="birthdate"/>
                            </div>
                            
                            <div class="mb-4">
                                <x-label for="gender" value="{{ __('Gender') }}" />
                                <select name="gender" id="gender" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                    <option value="" class="text-gray-400" selected>-- select gender --</option>
                                    @foreach ($genders as $key => $gender)
                                        <option value="{{ $key }}" {{ ($student->gender === $key) ? 'selected' : '' }}>{{ $gender }}</option>
                                    @endforeach
                                </select>
                                <x-validation-message name="gender"/>
                            </div>
    
                            <div class="mb-4">
                                <x-label for="address" value="{{ __('Address') }}" />
                                <textarea name="address" id="address" cols="30" rows="10" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ $student->address }}</textarea>
                                <x-validation-message name="address"/>
                            </div>
    
                            <div class="mb-4">
                                <x-label for="phone" :value="__('Phone')" />
                                <x-input id="phone" class="block mt-1 w-full" type="number" name="phone" value="{{ $student->phone }}" required />
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
            document.addEventListener('DOMContentLoaded', function() { 
                success('Student updated!')
            }, true); 
        </script>
        @endif
    </x-slot>

  </x-teacher-layout>