<x-app-layout>
    <x-slot name="title">
        {{ $subject->title }}
    </x-slot>  
    <x-slot name="nav">
        @include('layouts.navigation-admin')
    </x-slot> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $subject->title }} 
        </h2>
        <p class="text-gray-400 mt-2">
            @if ($subject->teacher['name'] !== null)
            by {{ $subject->teacher['name'] }} - <span class="text-xs text-gray-300">{{ $subject->created_at->diffForHumans() }}</span>
            @else
            by {{ $subject->admin['name'] }} - <span class="text-xs text-gray-300">{{ $subject->created_at->diffForHumans() }}</span>
            @endif
        </p>
    </x-slot>

  @if ($datas->count() === 0)
    <div class="py-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-2 bg-white border-b border-gray-200">
                <div class="flex justify-between">
                  <h5 class="text-gray-400 p-5">No one views yet!</h5>
                </div>
              </div>
          </div>
      </div>
  </div>
    @else
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="bg-white pb-4 px-4 rounded-md w-full">
                        <div class="flex justify-between w-full pt-6 ">
                          <h1 class="p-1 text-xl font-semibold">Subject view count</h1>
                        </div>
                        <hr>
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
                              <th class="px-4 py-2 " style="background-color:#f8f8f8">Student Name</th>
                              <th class="px-4 py-2 " style="background-color:#f8f8f8">View Count</th>
                              <th class="px-4 py-2 " style="background-color:#f8f8f8">Last Viewing</th>
                            </tr>
                          </thead>
                          <tbody class="text-sm font-normal text-gray-700">
                            @foreach ($datas as $data)
                            <tr class="hover:bg-gray-100 border-b border-gray-200 py-10">
                              <td class="px-4 py-4">{{ $loop->iteration }}</td>
                              <td class="px-4 py-4">{{ $data->student->name }}</td>
                              <td class="px-4 py-4">{{ $data->views }} x</td>
                              <td class="px-4 py-4">{{ $data->updated_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      </div>
                </div>
            </div>
        {{ $datas->links() }}
        </div>
    </div>
    @endif

    @if ($subject->path !== 'public/')
    @if ($downloads->count() === 0)
    <div class="py-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-2 bg-white border-b border-gray-200">
                <div class="flex justify-between">
                  <h5 class="text-gray-400 p-5">No one downloads yet!</h5>
                </div>
              </div>
          </div>
      </div>
  </div>
    @else
    <div class="py-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
                  <div class="bg-white pb-4 px-4 rounded-md w-full">
                      <div class="flex justify-between w-full pt-6 ">
                        <h1 class="p-1 text-xl font-semibold">Subject download count</h1>
                      </div>
                      <hr>
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
                            <th class="px-4 py-2 " style="background-color:#f8f8f8">Student Name</th>
                            <th class="px-4 py-2 " style="background-color:#f8f8f8">Download Count</th>
                            <th class="px-4 py-2 " style="background-color:#f8f8f8">Last Downloading</th>
                          </tr>
                        </thead>
                        <tbody class="text-sm font-normal text-gray-700">
                          @foreach ($downloads as $data)
                          <tr class="hover:bg-gray-100 border-b border-gray-200 py-10">
                            <td class="px-4 py-4">{{ $loop->iteration }}</td>
                            <td class="px-4 py-4">{{ $data->student->name }}</td>
                            <td class="px-4 py-4">{{ $data->downloads }} x</td>
                            <td class="px-4 py-4">{{ $data->updated_at->diffForHumans() }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    </div>
              </div>
          </div>
      {{ $downloads->links() }}
      </div>
  </div>
  @endif
  @endif

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between mb-2">
                        
                        <h3 class="font-semibold text-lg text-gray-800 leading-tight">Subject Detail</h3>
                    @if ($subject->path !== 'public/')
                        <div>
                            <a href="{{ route('admin.subjectmatters.download', ['course' => $subject->course_id, 'subject' => $subject->id]) }}" class="inline-flex items-center px-4 py-2 bg-blue-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"><i class="fas fa-download mr-1"></i>Download attachment</a>
                        </div>
                    @endif
                    </div>
                    <hr>
                    <p class="p-1 text-gray-400 text-justify">{!! $subject->details !!}</p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight p-2">Watch Video</h3>
                    <hr>
                        <iframe width="600" height="400" class="mt-5"
                        src="{{ $subject->link }}">
                        </iframe>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
