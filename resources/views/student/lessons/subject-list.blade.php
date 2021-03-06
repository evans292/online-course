<x-app-layout>
    <x-slot name="title">
        {{ $course }}
    </x-slot>  
    <x-slot name="nav">
        @include('layouts.navigation')
    </x-slot> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $course }} 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="p-2 mb-2 text-xl font-semibold">({{ $count }}) Subject</h1>
                    @if ($count === 0)
                    <h5 class="text-gray-400 p-2">Subject empty!</h5>
                    @else
                    <ul class="list-reset flex flex-col">
                        @foreach ($subjectmatters as $subjectmatter)
                            <li class="rounded-t relative -mb-px block border p-4 border-grey flex justify-between">
                                <a href="{{ route('student.courses.subject.details', ['course' => $subjectmatter->course_id, 'subject' => $subjectmatter->id]) }}" class="hover:text-green-400">{{ $subjectmatter->title }}</a>
                                @if ($subjectmatter->teacher['name'] !== null)
                                <p class="text-gray-300">by {{ $subjectmatter->teacher['name'] }}</p>
                                @else 
                                <p class="text-gray-300">by {{ $subjectmatter->admin['name'] }}</p>
                                @endif
                            </li>
                        @endforeach
                      </ul>
                    @endif
                </div>
            </div>
          {{ $subjectmatters->links() }}
        </div>
    </div>


</x-app-layout>
