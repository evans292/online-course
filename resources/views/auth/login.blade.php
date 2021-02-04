<x-guest-layout>
    <x-slot name="title">
        Select Role
    </x-slot>    
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50" style="background-image:url({{ asset('image/bg.svg') }});">        
        <h3 class="text-3xl text-center">Select Role</h3>
        <a href="{{ route('login.admin') }}" class="w-full sm:max-w-md mt-3 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg transform hover:scale-110 transition ease-in-out hover:bg-purple-400 hover:text-white">
            <h1>Admin</h1>
        </a>
        <a href="{{ route('login.student') }}" class="w-full sm:max-w-md mt-3 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg transform hover:scale-110 transition ease-in-out hover:bg-blue-400 hover:text-white">
            <h1>Student</h1>
        </a>
        <a href="{{ route('login.teacher') }}" class="w-full sm:max-w-md mt-3 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg transform ease-in-out hover:scale-110 transition hover:bg-green-400 hover:text-white">
            <h1>Teacher & Headmaster</h1>
        </a>
    </div>
</x-guest-layout>
