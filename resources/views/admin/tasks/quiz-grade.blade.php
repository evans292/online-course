<x-app-layout>
    <x-slot name="title">
        {{ __('Quiz Grade') }}
    </x-slot>  
    <x-slot name="nav">
        @include('layouts.navigation-admin')
    </x-slot> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quiz Grade') }}
        </h2>
    </x-slot>

    @if ($class->quizzes->count() !== 0)
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="p-2 text-center font-semibold text-2xl mb-3">Quiz Grade for Class {{ $class->name }}</h1>
                    <a href="{{ route('admin.grades.pdf', ['class' => Request::segment(3)]) }}" class="float-right mb-3 inline-flex items-center px-4 py-2 bg-red-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <i class="fas fa-file-pdf mr-3"></i>
                        PDF
                    </a>
                    <table class="table-auto border-collapse w-full">
                        <thead>
                          <tr class="rounded-lg text-sm font-medium text-gray-700 text-left" style="font-size: 0.9674rem">
                            <th class="px-4 py-2 border-2 bg-gray-200">Name</th>
                            @foreach ($class->quizzes as $quiz)
                            <th class="px-4 py-2 border-2">{{ $quiz->title }}</th>
                            @endforeach
                          </tr>
                        </thead>
                        <tbody class="text-sm font-normal text-gray-700">
                            @foreach ($class->students as $student)
                            <tr class="rounded-lg text-sm font-medium text-gray-700 text-left" style="font-size: 0.9674rem">
                                <td class="px-4 py-4 border-2">{{ $student->name }}</td>
                                @foreach ($student->results as $res)
                                <td class="px-4 py-4 border-2">{{ $res->grade }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    No quiz ever held yet!
                </div>
            </div>
        </div>
    </div>
    @endif
    
</x-app-layout>
