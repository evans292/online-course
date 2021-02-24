<x-app-layout>
    <x-slot name="title">
        {{ __('Classwork') }}
    </x-slot>  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Classwork') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <!-- Settings Dropdown -->
            <div class="sm:flex sm:items-center sm:ml-6 mb-2">
                <x-dropdown align="left" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 bg-indigo-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <i class="fas fa-plus mr-1"></i>Add
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link href="{{ route('teacher.assignment.create') }}">
                            <i class="far fa-clipboard mr-2"></i>{{ __('Assignment') }}
                        </x-dropdown-link>
                        <x-dropdown-link href="#">
                            <i class="far fa-clipboard mr-2"></i>{{ __('Quiz Assignment') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-xl text-green-700 font-bold">Assign work to your class here</h1>
                    <div class="mt-2">
                        <p class="text-sm font-semibold"><i class="far fa-clipboard text-gray-500 text-xl my-2 mr-3"></i> Create assignments and questions</p>
                        <p class="text-sm font-semibold"><i class="far fa-list-alt text-gray-500 text-xl my-2 mr-2"></i> Use topics to organize classwork into modules or units</p>
                        <p class="text-sm font-semibold"><i class="fas fa-sort text-gray-500 text-xl my-2 mr-3"></i> Use topics to organize classwork into modules or units</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
