<x-teacher-layout>
    <x-slot name="title">
        {{ __('Classwork') }}
    </x-slot>  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Classwork') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Settings Dropdown -->
            <div class="sm:flex sm:items-center sm:ml-6 mb-2">
                <x-dropdown align="left" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <i class="fas fa-plus mr-1"></i>Create
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

            @if ($datas->count() === 0)
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
            @else
            @foreach ($datas as $data)
            <div x-data="{ expanded: false }">
            <div class="hover:bg-white overflow-hidden hover:shadow-lg sm:rounded-lg mb-2" x-bind:class="expanded ? 'shadow-lg' : ''">
                    <div class="p-4 hover:bg-white border-b border-gray-200 cursor-pointer relative overflow-hidden transition-all max-h-20 ease-in duration-200" x-ref="container" x-bind:class="expanded ? 'bg-white' : ''"  x-bind:style="expanded ? 'max-height: ' + $refs.container.scrollHeight + 'px' : ''" @click="expanded = !expanded">
                        <div class="flex justify-between">
                            <div>
                                <i class="fas fa-clipboard-list text-white text-2xl my-2 mr-3 bg-green-400 p-2 rounded-lg"></i>
                                <a href="#">{{ $data->title }}</a>
                            </div>
                            <div class="flex self-center mt-3">
                                <span class="self-center text-xs text-gray-400 mr-2">Posted {{ $data->created_at->format('g:i A') }}</span>
                                <img src="{{ asset('image/dots.svg') }}" alt="Kiwi standing on oval" class="h-6 w-6 mt-1">
                            </div>
                        </div>   
                        <hr class="my-2">     
                        <p class="text-xs text-gray-400">Due {{ $data->due->format('M d') }}</p> 
                        <p class="mt-5 text-sm">{{ Str::limit($data->instructions, 300) }}</p>
                        <div class="flex justify-end">
                            <div class="mx-5 border-l-2 pl-3">
                                <p class="text-4xl">0</p>
                                <p class="text-gray-400 text-sm"> Turned in</p>
                            </div>
                            <div class="border-l-2 pl-3">
                            <p class="text-4xl">{{ $data->schoolclass->students->count() }}</p>
                               <p class="text-gray-400 text-sm">Assigned</p>
                            </div>
                        </div>
                        <hr class="my-2">     
                        <a href="{{ route('teacher.assignment.show', ['assignment' => $data->id]) }}" class="text-green-600 font-semibold p-2 text-sm hover:bg-blue-50">View assignment</a>
                    </div>
                </div>
            </div> 
            @endforeach
            @endif

            {{ $datas->links() }}
        </div>
    </div>

</x-teacher-layout>
