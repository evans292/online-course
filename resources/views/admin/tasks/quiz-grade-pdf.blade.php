<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  
        <!-- Styles -->
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('font-awesome/app.css') }}" />
        {{-- <script src="https://kit.fontawesome.com/39ddfceea2.js" crossorigin="anonymous"></script> --}}
        {{ $style ?? ''}} 
        <style>
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
            }
        </style>
        <!-- Scripts -->
        <script src="{{asset('js/app.js')}}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">

            <!-- Page Content -->
            <main>
               
            @if ($class->quizzes->count() !== 0)
            <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
            </main>
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', function() { 
                window.print()
            }, true); 
        </script>
    </body>
</html>


    
