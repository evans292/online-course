<x-student-layout>
    <x-slot name="title">
        Assignment No. {{ $ass->id }}
    </x-slot>  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Assignment No. {{ $ass->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <i class="fas fa-clipboard-list text-white text-2xl mr-3 bg-green-400 p-2 rounded-lg"></i>
                            <a class="text-xl text-green-700 font-semibold">{{ $ass->title }}</a>
                        </div>
                    </div>

                    <p class="ml-12 text-gray-400 text-sm mt-1">{{ $ass->teacher->name }} <span class="text-xs">•</span> {{ $ass->created_at->format('M d') }}</p>
                    <p class="ml-12 text-sm mt-2 font-semibold">{{ $ass->point }} points</p>

                    <hr class="my-5 border-green-400">

                    <p>{{ $ass->instructions }}</p>

                    <hr class="my-5 border">

                </div>
            </div>
        </div>
    </div>

</x-student-layout>
