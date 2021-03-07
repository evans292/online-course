<x-app-layout>
    <x-slot name="title">
        Quiz results
    </x-slot>  
    <x-slot name="style">
        <style>
            thead tr th:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px;}
            thead tr th:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px;}
            
            tbody tr td:first-child { border-top-left-radius: 5px; border-bottom-left-radius: 0px;}
            tbody tr td:last-child { border-top-right-radius: 5px; border-bottom-right-radius: 0px;}
        </style>
    </x-slot>  
    <x-slot name="nav">
        @include('layouts.navigation')
    </x-slot> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $result->quiz->title }} results
        </h2>
    </x-slot>

    @if($result)
    <div class="p-6">

        <table class="table-auto border-collapse w-full">
            <tr class="rounded-lg text-sm font-medium text-gray-700 text-left border bg-white" style="font-size: 0.9674rem">
              <th class="px-4 py-2 border-r">User</th>
              <td class="px-4 py-4">{{$result->student->name}}</td>
            </tr>
            <tr class="rounded-lg text-sm font-medium text-gray-700 text-left border bg-white" style="font-size: 0.9674rem">
              <th class="px-4 py-2 border-r">Date</th>
              <td class="px-4 py-4">{{$result->created_at}} ({{$result->created_at->diffForHumans()}})</td>
            </tr>
            <tr class="rounded-lg text-sm font-medium text-gray-700 text-left border bg-white" style="font-size: 0.9674rem">
              <th class="px-4 py-2 border-r">Score</th>
              <td class="px-4 py-4">{{ $result->grade }} / {{ $result->quiz->point }}</td>
            </tr>
        </table>
        <table class="table-auto border-collapse w-full mt-5">
            <?php $n = 0 ?>
            @foreach($result->quiz->questions as $question)
                <?php $n++ ?>
                <tr class="rounded-lg text-sm font-medium text-gray-700 text-left border bg-white">
                    <th class="px-4 py-2 border-r">Question #{{$n}}</th>
                    <th class="px-4 py-2 border-r">{{$question->question_text}}</th>
                </tr>
                <tr class="rounded-lg text-sm font-medium text-gray-700 text-left border bg-white">
                    <td class="px-4 py-4">Options</td>
                    <td class="px-4 py-4">
                        <ul class="list-outside list-disc">
                            @foreach($question->options as $option)
                                @if($option->correct == 1)
                                    <li style="font-weight: bold;">{{$option->option}}
                                        <em>(correct answer)</em>
                                        @foreach($result->options as $user_option)
                                            @if($user_option->option_id == $option->id)
                                                <em>(your answer)</em>
                                            @endif
                                        @endforeach
                                    </li>
                                @else
                                    <li>
                                        {{$option->option}}
                                        @foreach($result->options as $user_option)
                                            @if($user_option->option_id == $option->id)
                                                <em style="font-weight: bold;">(your answer)</em>
                                            @endif
                                        @endforeach
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    @else
    <h1>No Result</h1>
@endif
    

</x-app-layout>
