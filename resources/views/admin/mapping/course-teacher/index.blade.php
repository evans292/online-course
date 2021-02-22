<x-admin-layout>
    <x-slot name="title">
      {{ __('Course - Teacher Map') }}
    </x-slot>  
    
    <x-slot name="style">
      <style>
          thead tr th:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px;}
          thead tr th:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px;}
          
          tbody tr td:first-child { border-top-left-radius: 5px; border-bottom-left-radius: 0px;}
          tbody tr td:last-child { border-top-right-radius: 5px; border-bottom-right-radius: 0px;}
      </style>
  </x-slot>  

    <div class="px-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          {{-- @if ($datas->count() === 0)
          <div class="flex justify-between">
            <h5 class="text-gray-400 p-2">subject empty, try to create one!</h5>
            <a href="{{ route('teacher.courses.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"><i class="fas fa-plus mr-1"></i>Add subject</a>
          </div>
          @else --}}
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="bg-white pb-4 px-4 rounded-md w-full">
                    <div class="flex justify-between w-full pt-6 ">
                      <h1 class="p-1 text-xl font-semibold">Courses - Teachers Table</h1>
                      {{-- <svg width="14" height="4" viewBox="0 0 14 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g opacity="0.4">
                      <circle cx="2.19796" cy="1.80139" r="1.38611" fill="#222222"/>
                      <circle cx="11.9013" cy="1.80115" r="1.38611" fill="#222222"/>
                      <circle cx="7.04991" cy="1.80115" r="1.38611" fill="#222222"/>
                      </g>
                      </svg> --}}
                    {{-- <a href="#" class="inline-flex items-center px-4 py-2 bg-indigo-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"><i class="fas fa-plus mr-1"></i>Add map</a> --}}
                    </div>
                <div class="w-full flex justify-end px-2 mt-2">
                      <div class="w-full sm:w-64 inline-block relative ">
                        {{-- <input type="" name="" class="leading-snug border border-gray-300 block w-full appearance-none bg-gray-100 text-sm text-gray-600 py-1 px-4 pl-8 rounded-lg" placeholder="Search" /> --}}
              
                        <div class="pointer-events-none absolute pl-3 inset-y-0 left-0 flex items-center px-2 text-gray-300">
              
                          {{-- <svg class="fill-current h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 511.999 511.999">
                            <path d="M508.874 478.708L360.142 329.976c28.21-34.827 45.191-79.103 45.191-127.309C405.333 90.917 314.416 0 202.666 0S0 90.917 0 202.667s90.917 202.667 202.667 202.667c48.206 0 92.482-16.982 127.309-45.191l148.732 148.732c4.167 4.165 10.919 4.165 15.086 0l15.081-15.082c4.165-4.166 4.165-10.92-.001-15.085zM202.667 362.667c-88.229 0-160-71.771-160-160s71.771-160 160-160 160 71.771 160 160-71.771 160-160 160z" />
                          </svg> --}}
                        </div>
                      </div>
                    </div>
                  <div class="overflow-x-auto mt-6">
                    <table class="table-auto border-collapse w-full">
                      <thead>
                        <tr class="rounded-lg text-sm font-medium text-gray-700 text-left" style="font-size: 0.9674rem">
                          <th class="px-4 py-2 bg-gray-200 " style="background-color:#f8f8f8">#</th>
                          <th class="px-4 py-2 " style="background-color:#f8f8f8">Course</th>
                          <th class="px-4 py-2 " style="background-color:#f8f8f8">Teacher</th>
                          <th class="px-4 py-2 " style="background-color:#f8f8f8">Total Teacher</th>
                          <th class="px-4 py-2 " style="background-color:#f8f8f8">Action</th>
                        </tr>
                      </thead>
                      <tbody class="text-sm font-normal text-gray-700">
                        @foreach ($datas as $data)
                        <tr class="hover:bg-gray-100 border-b border-gray-200 py-10">
                          <td class="px-4 py-4">{{ $loop->iteration }}</td>
                          <td class="px-4 py-4">{{ $data->name }}</td>
                          <td class="px-4 py-4">
                              <ul class="list-outside list-disc">
                                  @foreach ($data->teachers as $item)
                                      <li>{{ $item->name }}</li>
                                  @endforeach
                              </ul>
                          </td>
                          <td class="px-4 py-4">{{ $data->teachers->count() }}</td>
                          {{-- <td class="px-4 py-4">{{ $data->created_at }}</td>  --}}
                          <td class="px-4 py-4">
                            <a href="{{ route('admin.course-teacher.edit', ['course' => $data->id]) }}"><i class="fas fa-pencil-alt text-yellow-400"></i></a>
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
              {{-- @endif --}}
            </div>
        </div>
    {{ $datas->links() }}
    </div>
    </div>

  </x-admin-layout>