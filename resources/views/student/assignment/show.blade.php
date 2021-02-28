<x-student-layout>
    <x-slot name="title">
        Assignment No. {{ $ass->id }}
    </x-slot>  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Assignment No. {{ $ass->id }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-between">
        @if (Carbon\Carbon::now()->subDay()->format('Y-m-d') === $ass->due->format('Y-m-d'))
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <i class="fas fa-clipboard-list text-white text-2xl mr-3 bg-gray-400 p-2 rounded-lg"></i>
                            <a class="text-xl text-gray-700 font-semibold">{{ $ass->title }} (closed)</a>
                        </div>
                    </div>

                    <p class="ml-12 text-gray-400 text-sm mt-1">{{ $ass->teacher->name }} <span class="text-xs">•</span> {{ $ass->created_at->format('M d') }}</p>
                    <p class="ml-12 text-sm mt-2 font-semibold text-gray-400">{{ $ass->point }} points</p>

                    <hr class="my-5 border-gray-400">

                    <p class="text-gray-400 class="text-justify"">{{ $ass->instructions }}</p>

                    <hr class="my-5 border">

                    <div class="flex justify-between">
                        <p class=""></p>
                        <a href="{{ route('student.courses.subject.assignment.download', ['course' => Request::segment(3), 'subject' => Request::segment(5), 'assignment' => Request::segment(7)]) }}" class="inline-flex items-center px-4 py-2 bg-green-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"><i class="fas fa-download mr-1"></i>Download attachment</a>
                    </div>
                </div>
            </div>
        </div> 

        <div class="w-2/4 sm:px-6 lg:px-8 mb-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                <div class="p-6 bg-white">
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl">Your Work</h1>
                        <p class="text-green-600 text-sm my-3 font-semibold">Assigned</p>
                    </div>

                    <div class="flex w-full items-center justify-center bg-grey-lighter" x-data="{ fileName: 'Select a file' }">
                        <label class="w-full flex items-center p-2 bg-white text-green-400 rounded-md shadow-lg tracking-wide uppercase border border-green-400 cursor-pointer hover:bg-green-400 hover:text-white">
                            <svg class="w-4 h-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                            </svg>
                            <span class="mt-1 ml-3 text-sm leading-normal normal-case" x-text="fileName"></span>
                            <input type='file' x-ref="file" @change="fileName = $refs.file.files[0].name" class="hidden" />
                        </label>
                    </div>

                    <x-button class="mt-3 w-full normal-case">
                        <i class="fas fa-check text-white mr-2"></i>
                        Mark as done
                    </x-button>

                </div>
            </div>
        </div>
        @else
        <div class="w-full mx-auto sm:px-6 lg:px-8">
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

                    <p class="text-justify">{{ $ass->instructions }}</p>

                    <hr class="my-5 border">

                    <div class="flex justify-between">
                        <p class=""></p>
                        <a href="{{ route('student.courses.subject.assignment.download', ['course' => Request::segment(3), 'subject' => Request::segment(5), 'assignment' => Request::segment(7)]) }}" class="inline-flex items-center px-4 py-2 bg-green-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"><i class="fas fa-download mr-1"></i>Download attachment</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-2/4 sm:px-6 lg:px-8 mb-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                <div class="p-6 bg-white">
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl">Your Work</h1>
                        <p class="text-green-600 text-sm my-3 font-semibold">Assigned</p>
                    </div>

                    <div class="flex w-full items-center justify-center bg-grey-lighter" x-data="{ fileName: 'Select a file' }">
                        <label class="w-full flex items-center p-2 bg-white text-green-400 rounded-md shadow-lg tracking-wide uppercase border border-green-400 cursor-pointer hover:bg-green-400 hover:text-white">
                            <svg class="w-4 h-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                            </svg>
                            <span class="mt-1 ml-3 text-sm leading-normal normal-case" x-text="fileName"></span>
                            <input type='file' x-ref="file" @change="fileName = $refs.file.files[0].name" class="hidden" />
                        </label>
                    </div>

                    <x-button class="mt-3 w-full normal-case">
                        <i class="fas fa-check text-white mr-2"></i>
                        Mark as done
                    </x-button>

                </div>
            </div>
        </div>
        @endif
        
        

    </div>

</x-student-layout>