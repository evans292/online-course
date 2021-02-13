<x-app-layout>
    <x-slot name="title">
        {{ __('Dashboard') }}
    </x-slot>  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Welcome {{ Auth::user()->name }}!
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        @if (session('student'))
        <script>
            Vue.use(VueToast);
            Vue.$toast.success('Hello Student!', {
             duration: 1500,
             dismissible: true,
             position: 'top'
            })
        </script>
        @endif
        @if (session('teacher'))
        <script>
            Vue.use(VueToast);
            Vue.$toast.success('Hello Teacher!', {
             duration: 1500,
             dismissible: true,
             position: 'top'
            })
        </script>
        @endif
        @if (session('headmaster'))
        <script>
            Vue.use(VueToast);
            Vue.$toast.success('Hello Headmaster!', {
             duration: 1500,
             dismissible: true,
             position: 'top'
            })
        </script>
        @endif
        @if (session('admin'))
        <script>
            Vue.use(VueToast);
            Vue.$toast.success('Hello Admin!', {
             duration: 1500,
             dismissible: true,
             position: 'top'
            })
        </script>
        @endif
    </x-slot>
</x-app-layout>
