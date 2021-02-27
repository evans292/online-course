<x-student-layout>
    <x-slot name="title">
        {{ __('Classwork') }}
    </x-slot>  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Classwork') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if ($datas->count() === 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-xl text-green-700 font-bold">No assignment :)</h1>
                </div>
            </div>
            @else
            @foreach ($datas as $data)
            <div x-data="{ expanded: false }">
            <div class="hover:bg-white overflow-hidden hover:shadow-lg sm:rounded-lg mb-2" x-bind:class="expanded ? 'shadow-lg' : ''">
                    <div class="p-4 hover:bg-white cursor-pointer relative overflow-hidden transition-all max-h-32 ease-in duration-200" x-ref="container" x-bind:class="expanded ? 'bg-white' : ''"  x-bind:style="expanded ? 'max-height: ' + $refs.container.scrollHeight + 'px' : ''" x-on:click.self="expanded = !expanded">
                        <div class="flex justify-between" x-on:click.self="expanded = !expanded">
                            <div>
                                <i class="fas fa-clipboard-list text-white text-2xl my-2 mr-3 bg-green-400 p-2 rounded-lg"></i>
                                <a class="font-semibold">{{ $data->title }}</a>
                            </div>
                            <div class="flex self-center mt-3">
                                <span class="self-center text-xs text-gray-400 mr-2">Posted {{ $data->created_at->format('M d') }}</span>
                            </div>
                        </div>   
                        <hr class="my-3">     
                        <p class="text-xs text-gray-400">
                            Due 
                            @if (Carbon\Carbon::now()->format('Y-m-d') === $data->due->format('Y-m-d'))
                                Today
                            @elseif (Carbon\Carbon::now(-1)->format('Y-m-d') === $data->due->format('Y-m-d'))  
                                Yesterday
                            @elseif (Carbon\Carbon::now()->addDay()->format('Y-m-d') === $data->due->format('Y-m-d'))  
                                Tomorrow
                            @else
                                {{ $data->due->diffForHumans() }}
                            @endif
                        </p> 
                        <p class="mt-5 text-sm text-justify">{{ Str::limit($data->instructions, 300) }}</p>
                        <hr class="my-3">     
                        <a href="{{ route('student.courses.subject.assignment.details', ['course' => Request::segment(3), 'subject' => Request::segment(3), 'assignment' => $data->id]) }}" class="text-green-600 font-semibold p-1 text-sm hover:bg-blue-50">View assignment</a>
                    </div>
                </div>
            </div> 
            @endforeach
            @endif

            {{ $datas->links() }}
        </div>
    </div>

    <x-slot name="script">
        @if (session('success'))
        <script>
            Vue.use(VueToast);
            Vue.$toast.success('Assignment deleted!', {
             duration: 1500,
             dismissible: true,
            })
        </script>
        @endif
    </x-slot>
</x-student-layout>
