<x-app-layout>
    <x-slot name="title">
        {{ __('Student work') }}
    </x-slot>  
    <x-slot name="nav">
        @include('layouts.navigation-admin-ass')
    </x-slot> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student work') }}
        </h2>
    </x-slot>

    <div class="py-12 flex">

        @include('admin.tasks.accumulation.student-list')
    
        <div class="w-4/6 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                        <p class="font-semibold text-xl">[{{ $assignment->title }}]</p> 

                        <div class="flex justify-end mt-5">
                            <div class="mx-5 border-l-2 pl-3">
                                <p class="text-4xl">{{ $assignment->accumulations->count() }}</p>
                                <p class="text-gray-400 text-sm">Turned in</p>
                            </div>
                            <div class="border-l-2 pl-3">
                            <p class="text-4xl">{{ $assignment->schoolclass->students->count() - $assignment->accumulations->count() }}</p>
                               <p class="text-gray-400 text-sm">Assigned</p>
                            </div>
                            <div class="border-l-2 pl-3 mx-5">
                                <p class="text-4xl">{{ $assignment->accumulations->where('point', '!==', null)->count() }}</p>
                                   <p class="text-gray-400 text-sm">Graded</p>
                                </div>
                        </div>

                </div>
            </div>
        </div>



    </div>
</x-app-layout>
