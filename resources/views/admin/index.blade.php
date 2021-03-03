<x-admin-layout>
  <x-slot name="title">
    {{ __('Admin Dashboard') }}
  </x-slot>  

  <div class="px-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                Ini dashboard admin 
            </div>
        </div>
    </div>
  </div>

  <x-slot name="script">
    @if (session('admin'))
        <script>
            document.addEventListener('DOMContentLoaded', function() { 
                greet('Admin', 'bottom-right')
            }, true); 
        </script>
    @endif
</x-slot>
</x-admin-layout>