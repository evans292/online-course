<x-app-layout>
    <x-slot name="title">
        Question
    </x-slot>  
    <x-slot name="nav">
        @include('layouts.navigation-admin-quiz')
    </x-slot> 
    <x-slot name="style">
        <style>
            thead tr th:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px;}
            thead tr th:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px;}
            
            tbody tr td:first-child { border-top-left-radius: 5px; border-bottom-left-radius: 0px;}
            tbody tr td:last-child { border-top-right-radius: 5px; border-bottom-right-radius: 0px;}
        </style>
    </x-slot>  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Question List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              @if ($questions->count() === 0)
              <div class="flex justify-between">
                <h5 class="text-gray-400 p-5">question empty, try to create one!</h5>
                <a href="{{ route('admin.question.create', ['class' => Request::segment(3), 'quiz' => Request::segment(4)]) }}" class="inline-flex items-center px-4 py-2 bg-indigo-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"><i class="fas fa-plus mr-1"></i>Add question</a>
              </div>
              @else
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="bg-white pb-4 px-4 rounded-md w-full">
                        <div class="flex justify-between w-full pt-6 ">
                          <h1 class="p-1 text-xl font-semibold">Question Table</h1>
                        <a href="{{ route('admin.question.create', ['class' => Request::segment(3), 'quiz' => Request::segment(4)]) }}" class="inline-flex items-center px-4 py-2 bg-indigo-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"><i class="fas fa-plus mr-1"></i>Add question</a>
                        </div>
                    <div class="w-full flex justify-end px-2 mt-2">
                          <div class="w-full sm:w-64 inline-block relative ">
                            <div class="pointer-events-none absolute pl-3 inset-y-0 left-0 flex items-center px-2 text-gray-300">
                            </div>
                          </div>
                        </div>
                      <div class="overflow-x-auto mt-6">
                        <table class="table-auto border-collapse w-full">
                          <thead>
                            <tr class="rounded-lg text-sm font-medium text-gray-700 text-left" style="font-size: 0.9674rem">
                              <th class="px-4 py-2 bg-gray-200 " style="background-color:#f8f8f8">#</th>
                              <th class="px-4 py-2 " style="background-color:#f8f8f8">Quiz</th>
                              <th class="px-4 py-2 " style="background-color:#f8f8f8">Question</th>
                              <th class="px-4 py-2 " style="background-color:#f8f8f8">Created</th>
                              <th class="px-4 py-2 " style="background-color:#f8f8f8">Action</th>
                            </tr>
                          </thead>
                          <tbody class="text-sm font-normal text-gray-700">
                            @foreach ($questions as $data)
                            <tr class="hover:bg-gray-100 border-b border-gray-200 py-10">
                              <td class="px-4 py-4">{{ $loop->iteration }}</td>
                              <td class="px-4 py-4">{{ $data->quiz->title }}</td>
                              <td class="px-4 py-4"><a class="text-green-400 hover:text-green-600" href="{{ route('admin.question.show', ['class' => Request::segment(3), 'quiz' => $data->quiz_id, 'question' => $data->id]) }}">{!! Str::limit($data->question, 50)  !!}</a></td>
                              <td class="px-4 py-4">{{ $data->created_at->diffForHumans() }}</td>
                              <td class="px-4 py-4">
                                <form id="{{ $data->id }}" action="{{ route('admin.question.destroy', ['class' => Request::segment(3), 'quiz' => $data->quiz_id, 'question' => $data->id]) }}" method="POST">
                                  @csrf
                                  @method('delete')
                                </form>
                                <a href="#" onclick="deleteConfirm('{{ $data->question }}', '{{ $data->id }}')"><i class="fas fa-trash-alt text-red-400 mr-1"></i></a>
                                <a href="{{ route('admin.question.edit', ['class' => Request::segment(3), 'quiz' => $data->quiz_id, 'question' => $data->id]) }}"><i class="fas fa-pencil-alt text-yellow-400"></i></a>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                         {{-- <div id="pagination" class="w-full flex justify-center border-t border-gray-100 pt-4 items-center">
                          
                          <svg class="h-6 w-6" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g opacity="0.4">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M9 12C9 12.2652 9.10536 12.5196 9.29289 12.7071L13.2929 16.7072C13.6834 17.0977 14.3166 17.0977 14.7071 16.7072C15.0977 16.3167 15.0977 15.6835 14.7071 15.293L11.4142 12L14.7071 8.70712C15.0977 8.31659 15.0977 7.68343 14.7071 7.29289C14.3166 6.90237 13.6834 6.90237 13.2929 7.29289L9.29289 11.2929C9.10536 11.4804 9 11.7348 9 12Z" fill="#2C2C2C"/>
                  </g>
                  </svg>
                        <p class="leading-relaxed cursor-pointer mx-2 text-blue-600 hover:text-blue-600 text-sm">1</p>
                        <p class="leading-relaxed cursor-pointer mx-2 text-sm hover:text-blue-600" >2</p>
                        <p class="leading-relaxed cursor-pointer mx-2 text-sm hover:text-blue-600"> 3 </p>
                        <p class="leading-relaxed cursor-pointer mx-2 text-sm hover:text-blue-600"> 4 </p>
                        <svg class="h-6 w-6" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15 12C15 11.7348 14.8946 11.4804 14.7071 11.2929L10.7071 7.2929C10.3166 6.9024 9.6834 6.9024 9.2929 7.2929C8.9024 7.6834 8.9024 8.3166 9.2929 8.7071L12.5858 12L9.2929 15.2929C8.9024 15.6834 8.9024 16.3166 9.2929 16.7071C9.6834 17.0976 10.3166 17.0976 10.7071 16.7071L14.7071 12.7071C14.8946 12.5196 15 12.2652 15 12Z" fill="#18A0FB"/>
                  </svg>
                        </div> --}}
                      </div>
                  @endif
                </div>
            </div>
        {{ $questions->links() }}
        </div>
    </div>

    <x-slot name="script">
      @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() { 
                success('Question deleted!')
            }, true); 
        </script>
        @endif
  </x-slot>
</x-app-layout>
