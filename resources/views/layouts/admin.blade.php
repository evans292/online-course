<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#000000" />
    <script src="https://kit.fontawesome.com/39ddfceea2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
  </head>
  <body class="text-gray-800 antialiased">
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root">
      
        @include('layouts.admin.sidebar')

      <div class="relative md:ml-64 bg-gray-100">
        @include('layouts.admin.topbar')
        
        <!-- Content -->
        <div class="relative bg-green-600 md:pt-32 pb-32 pt-12">
          {{ $slot }}
        </div>
      </div>

    </div>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
      charset="utf-8"
    ></script>
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
    </script>
  </body>
</html>
