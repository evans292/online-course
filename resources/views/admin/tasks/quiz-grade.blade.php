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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="p-2 text-center font-semibold text-2xl mb-3">Quiz Grade for Class {{ $class->name }}</h1>
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

</x-app-layout>
