<x-app-layout>
    <x-slot name="title">
        Data
    </x-slot> 
    <x-slot name="nav">
        @include('layouts.navigation')
    </x-slot>  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data List') }}
        </h2>
    </x-slot>

    <div class="py-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            {{-- @if ($subjects[0]->subjectcounts->count() === 0)
            <div class="flex justify-between">
              <h5 class="text-gray-400 p-5">No one downloads yet!</h5>
            </div>
            @else --}}
              <div class="p-6 bg-white border-b border-gray-200">
                  <div class="bg-white pb-4 px-4 rounded-md w-full">
                      <div class="flex justify-between w-full pt-6 ">
                        <h1 class="p-1 text-xl font-semibold">Admin Subject data</h1>
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
                            <th class="px-4 py-2 " style="background-color:#f8f8f8">Admin Name</th>
                            <th class="px-4 py-2 " style="background-color:#f8f8f8">Subject and Student Who Viewed the Subject</th>
                          </tr>
                        </thead>
                        <tbody class="text-sm font-normal text-gray-700">
                          @foreach ($admins as $admin)
                              <tr class="hover:bg-gray-100 border-b border-gray-200 py-10">
                              <td class="px-4 py-4">{{ $loop->iteration }}</td>
                              <td class="px-4 py-4">{{ $admin->name }}</td>
                              <td class="px-4 py-4">
                                <ul class="list-outside list-disc">
                                 @foreach ($admin->subjectmatters as $items)
                                 <p class="font-bold">-- {{ $items->title }} --</p>
                                    @foreach ($items->subjectcounts as $item)
                                    <li>{{ $item->student->name }}</li>
                                    @endforeach
                                @endforeach
                                </ul>
                              </td>
                              </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    </div>
                {{-- @endif --}}
              </div>
          </div>
      {{ $admins->links() }}
      </div>
  </div>

    <div class="py-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            {{-- @if ($subjects[0]->subjectcounts->count() === 0)
            <div class="flex justify-between">
              <h5 class="text-gray-400 p-5">No one downloads yet!</h5>
            </div>
            @else --}}
              <div class="p-6 bg-white border-b border-gray-200">
                  <div class="bg-white pb-4 px-4 rounded-md w-full">
                      <div class="flex justify-between w-full pt-6 ">
                        <h1 class="p-1 text-xl font-semibold">Teacher Subject data</h1>
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
                            <th class="px-4 py-2 " style="background-color:#f8f8f8">Teacher Name</th>
                            <th class="px-4 py-2 " style="background-color:#f8f8f8">Subject and Student Who Viewed the Subject</th>
                          </tr>
                        </thead>
                        <tbody class="text-sm font-normal text-gray-700">
                          @foreach ($teachers as $teacher)
                              <tr class="hover:bg-gray-100 border-b border-gray-200 py-10">
                              <td class="px-4 py-4">{{ $loop->iteration }}</td>
                              <td class="px-4 py-4">{{ $teacher->name }}</td>
                              <td class="px-4 py-4">
                                <ul class="list-outside list-disc">
                                 @foreach ($teacher->subjectmatters as $items)
                                 <p class="font-bold">-- {{ $items->title }} --</p>
                                    @foreach ($items->subjectcounts as $item)
                                    <li>{{ $item->student->name }}</li>
                                    @endforeach
                                @endforeach
                                </ul>
                              </td>
                              </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    </div>
                {{-- @endif --}}
              </div>
          </div>
      {{ $teachers->links() }}
      </div>
  </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              @if ($subjectcount->count() === 0)
              <div class="flex justify-between">
                <h5 class="text-gray-400 p-5">No one views yet!</h5>
              </div>
              @else
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="bg-white pb-4 px-4 rounded-md w-full">
                        <div class="flex justify-between w-full pt-6 ">
                          <h1 class="p-1 text-xl font-semibold">Subject view count data</h1>
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
                              <th class="px-4 py-2 " style="background-color:#f8f8f8">Subject Name</th>
                              <th class="px-4 py-2 " style="background-color:#f8f8f8">Student Name</th>
                              <th class="px-4 py-2 " style="background-color:#f8f8f8">View Count</th>
                              <th class="px-4 py-2 " style="background-color:#f8f8f8">Last Viewing</th>
                            </tr>
                          </thead>
                          <tbody class="text-sm font-normal text-gray-700">
                            @foreach ($subjects as $count)
                                <tr class="hover:bg-gray-100 border-b border-gray-200 py-10">
                                <td class="px-4 py-4">{{ $loop->iteration }}</td>
                                <td class="px-4 py-4">{{ $count->title }}</td>
                                <td class="px-4 py-4">
                                    <ul class="list-outside list-disc">
                                     @foreach ($count->subjectcounts as $item)
                                        <li>{{ $item->student->name }}</li>
                                    @endforeach
                                    </ul>
                                </td>
                                <td class="px-4 py-4">
                                    <ul class="list-outside list-disc">
                                     @foreach ($count->subjectcounts as $item)
                                        <li>{{ $item->views }} x</li>
                                    @endforeach
                                    </ul>
                                </td>
                                <td class="px-4 py-4">
                                    <ul class="list-outside list-disc">
                                     @foreach ($count->subjectcounts as $item)
                                     <li>{{ $item->updated_at->diffForHumans() }}</li>
                                    @endforeach
                                    </ul>
                                </td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      </div>
                  @endif

                </div>
            </div>
        {{ $subjects->links() }}
        </div>
    </div>

    <div class="py-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @if ($downloadcount->count() === 0)
            <div class="flex justify-between">
              <h5 class="text-gray-400 p-5">No one downloads yet!</h5>
            </div>
            @else
              <div class="p-6 bg-white border-b border-gray-200">
                  <div class="bg-white pb-4 px-4 rounded-md w-full">
                      <div class="flex justify-between w-full pt-6 ">
                        <h1 class="p-1 text-xl font-semibold">Subject download count data</h1>
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
                            <th class="px-4 py-2 " style="background-color:#f8f8f8">Subject Name</th>
                            <th class="px-4 py-2 " style="background-color:#f8f8f8">Student Name</th>
                            <th class="px-4 py-2 " style="background-color:#f8f8f8">Download Count</th>
                            <th class="px-4 py-2 " style="background-color:#f8f8f8">Last Downloading</th>
                          </tr>
                        </thead>
                        <tbody class="text-sm font-normal text-gray-700">
                          @foreach ($subjects as $count)
                              <tr class="hover:bg-gray-100 border-b border-gray-200 py-10">
                              <td class="px-4 py-4">{{ $loop->iteration }}</td>
                              <td class="px-4 py-4">{{ $count->title }}</td>
                              <td class="px-4 py-4">
                                  <ul class="list-outside list-disc">
                                   @foreach ($count->downloadsubjectcounts as $item)
                                      <li>{{ $item->student->name }}</li>
                                  @endforeach
                                  </ul>
                              </td>
                              <td class="px-4 py-4">
                                  <ul class="list-outside list-disc">
                                   @foreach ($count->downloadsubjectcounts as $item)
                                      <li>{{ $item->downloads }} x</li>
                                  @endforeach
                                  </ul>
                              </td>
                              <td class="px-4 py-4">
                                  <ul class="list-outside list-disc">
                                   @foreach ($count->downloadsubjectcounts as $item)
                                   <li>{{ $item->updated_at->diffForHumans() }}</li>
                                  @endforeach
                                  </ul>
                              </td>
                              </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    </div>
                @endif

              </div>
          </div>
      {{ $subjects->links() }}
      </div>
  </div>


</x-app-layout>
