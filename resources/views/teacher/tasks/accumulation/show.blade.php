<x-app-layout>
    <x-slot name="title">
        {{ __('Student work') }}
    </x-slot>  
    <x-slot name="nav">
        @include('layouts.navigation-teacher-ass')
    </x-slot> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student work') }}
        </h2>
    </x-slot>

    <div class="py-12 flex">

        @include('teacher.tasks.accumulation.student-list')
    
        <div class="w-4/6 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h1 class="text-xl font-semibold">{{ $data[0]->student->name }}</h1>
                        @if ($data[0]->point !== null)
                        <h1 class="font-bold">{{ $data[0]->point }} <span class="text-gray-400"> / {{ $assignment->point }}</span></h1>
                        @else
                        <h1 class="font-bold text-gray-400">No grade</h1>
                        @endif
                    </div>

                    <p class="text-gray-400 text-sm mt-2">Turned in {{ $data[0]->created_at->format('g:i A') }}</p>

                    <div class="mt-5 text-right">
                        <a href="{{ route('teacher.accumulation.download', ['class' => Request::segment(3), 'assignment' => Request::segment(4), 'student' => $data[0]->student->id, 'accumulation' => $data[0]->id]) }}" class="inline-flex items-center px-4 py-2 bg-blue-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"><i class="fas fa-download mr-1"></i>Download attachment</a>
                    </div>


                </div>

                
            </div>

            
        </div>
    </div>

    <div class="flex justify-end">
        <div class="w-2/6  sm:px-6 lg:px-8 self-end">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="post" class="ml-5" action="{{ route('teacher.accumulation.update', ['class' => Request::segment(3), 'assignment' => Request::segment(4), 'student' => $data[0]->student->id]) }}" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="mb-4">
                            <x-label for="point" :value="__('Point')" />
                            <x-input id="point" class="block mt-1 w-full" type="number" name="point" value="{{ ($data[0]->point !== null) ? $data[0]->point : '0'}}" required />
                            <x-validation-message name="point"/>
                        </div>
        
                        <div class="flex items-center justify-end mt-4">            
                            <x-button class="ml-3">
                                {{ __('Return') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        @if (session('success'))
        <script>
            Vue.use(VueToast);
            Vue.$toast.success('Accumulation graded!', {
             duration: 1500,
             dismissible: true,
            })
        </script>
        @endif
    </x-slot>
</x-app-layout>
