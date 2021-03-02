<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#000000" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- <script src="https://kit.fontawesome.com/39ddfceea2.js" crossorigin="anonymous"></script> --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('font-awesome/app.css') }}" />

    {{ $style ?? ''}} 
    <style>
      input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
      }
  </style>
  <script src="{{asset('js/app.js')}}" defer></script>

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
  </head>
  <body class="text-gray-800 antialiased">
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root">
      
        @include('layouts.teacher.sidebar')

      <div class="relative md:ml-64 bg-gray-50">
        @include('layouts.admin.topbar')
        
        <!-- Content -->
        <div class="relative bg-gradient-to-r from-green-400 to-blue-500  md:pt-32 pb-32 pt-12">
          {{ $slot }}
        </div>
      </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> 
    
    <!-- Vue.js -->
     <script src="https://cdn.jsdelivr.net/npm/vue@2.6"></script>
     <!-- Lastly add this package -->
     <script src="https://cdn.jsdelivr.net/npm/vue-toast-notification"></script>
     <link href="https://cdn.jsdelivr.net/npm/vue-toast-notification/dist/theme-sugar.css" rel="stylesheet">
     <!-- Init the plugin -->
      {{ $script ?? ''}} 
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    <script type="text/javascript">
      /* Sidebar - Side navigation menu on mobile/responsive mode */
      function toggleNavbar(collapseID) {
        document.getElementById(collapseID).classList.toggle("hidden");
        document.getElementById(collapseID).classList.toggle("bg-white");
        document.getElementById(collapseID).classList.toggle("m-2");
        document.getElementById(collapseID).classList.toggle("py-3");
        document.getElementById(collapseID).classList.toggle("px-6");
      }
      /* Function for dropdowns */
      function openDropdown(event, dropdownID) {
        let element = event.target;
        while (element.nodeName !== "A") {
          element = element.parentNode;
        }
        Popper.createPopper(element, document.getElementById(dropdownID), {
          placement: "bottom-start",
        });
        document.getElementById(dropdownID).classList.toggle("hidden");
        document.getElementById(dropdownID).classList.toggle("block");
      }

      $(document).ready(function() {
        $('.select2').select2({
          placeholder: 'Select an option'
        });
      });
    </script>
  </body>
</html>
