<div class="min-h-screen flex flex-row sm:justify-around items-center pt-6 sm:pt-0 bg-gray-50" style="background-image:url({{ asset('image/bg.svg') }});">
    <div class="w-0 md:w-1/2">
        {{ $image }}
    </div>

    <div class="w-full sm:max-w-md">
        {{ $title }}

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>


</div>
