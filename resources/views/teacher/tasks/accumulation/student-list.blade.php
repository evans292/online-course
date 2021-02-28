<div class="w-2/6 mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <ul class="list-reset flex flex-col">
                {{-- <h1 class="p-2 mb-2 text-xl font-semibold">Class courses</h1> --}}
                @foreach ($ass as $acc)
                <li class="rounded-t relative -mb-px block border p-2 border-grey flex items-center">
                    @if ($acc->student->user->profilepic === null)
                    <img src="{{ asset('image/download.png') }}" class="rounded-full w-10 h-10 mr-2"> 
                    @else
                    <img src="{{ asset('storage/' . $acc->student->user->profilepic) }}" class="rounded-full w-10 h-10 mr-2">
                    @endif
                    <a href="{{ route('teacher.accumulation.show', ['class' => Request::segment(3), 'assignment' => Request::segment(4), 'student' => $acc->student->id]) }}" class="hover:text-green-400 text-sm ml-2">{{ $acc->student->name }}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{ $ass->links() }}
</div>
