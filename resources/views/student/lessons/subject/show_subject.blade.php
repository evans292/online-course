<x-app-layout>
    <x-slot name="title">
        {{ $subjectmatter->title }}
    </x-slot>  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $subjectmatter->title }} 
        </h2>
        <p class="text-gray-300 mt-2">
            by {{ $subjectmatter->teacher->name }} - <span class="text-xs text-gray-200">{{ $subjectmatter->created_at->diffForHumans() }}</span>
        </p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between mb-2">
                        <h3 class="font-semibold text-lg text-gray-800 leading-tight p-2">Subject Detail</h3>
                        <div>
                            <a href="{{ route('student.subject.download', ['lesson' => $subjectmatter->course_id, 'subjectmatter' => $subjectmatter->id]) }}" class="inline-flex items-center px-4 py-2 bg-blue-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"><i class="fas fa-download mr-1"></i>Download attachment</a>
                            <a href="{{ $subjectmatter->link }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-red-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"><i class="fab fa-youtube mr-1"></i>Watch video</a>
                        </div>
                    </div>
                    <hr>
                    <p class="p-1 text-gray-400">{!! $subjectmatter->details !!}. <span>Silahkan download materinya</span></p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
