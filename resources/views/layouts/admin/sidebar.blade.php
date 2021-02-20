<nav
        class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-no-wrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6"
      >
        <div
          class="md:flex-col md:items-stretch md:min-h-full md:flex-no-wrap px-0 flex flex-wrap items-center justify-between w-full mx-auto"
        >
          <button
            class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
            type="button"
            onclick="toggleNavbar('example-collapse-sidebar')"
          >
            <i class="fas fa-bars"></i>
          </button>
          <a
            class="md:block text-left md:pb-2 text-gray-700 mr-0 inline-block whitespace-no-wrap text-sm uppercase font-bold p-4 px-0"
            href="{{ route('dashboard') }}"
          >
            {{config('app.name', 'Laravel')}}
          </a>
          <ul class="md:hidden items-center flex flex-wrap list-none">
            <li class="inline-block relative">
              <a
                class="text-gray-600 block"
                href="#pablo"
                onclick="openDropdown(event,'user-responsive-dropdown')"
                ><div class="items-center flex">
                  <span
                    class="w-12 h-12 text-sm text-white bg-gray-300 inline-flex items-center justify-center rounded-full"
                    >@if (Auth::user()->profilepic === null)
                    <img src="{{ asset('image/download.png') }}" class="w-full rounded-full align-middle border-none shadow-lg"> 
                    @else
                    <img
                      alt="..."
                      class="w-full rounded-full align-middle border-none shadow-lg"
                      src="{{ asset('storage/' . Auth::user()->profilepic) }}"/>
                    @endif</span></div
              ></a>
              <div
                class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                id="user-responsive-dropdown"
              >
              <x-responsive-nav-link href="{{ route('dashboard') }}">
                {{ __('Home') }}
              </x-responsive-nav-link>
              <x-responsive-nav-link href="{{ route('profile') }}">
                {{ __('Profile') }}
              </x-responsive-nav-link>
              <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Logout') }}
                </x-responsive-nav-link>
            </form>
              </div>
            </li>
          </ul>
          <div
            class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden"
            id="example-collapse-sidebar"
          >
            <div
              class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-gray-300"
            >
              <div class="flex flex-wrap">
                <div class="w-6/12">
                  <a
                    class="md:block text-left md:pb-2 text-gray-700 mr-0 inline-block whitespace-no-wrap text-sm uppercase font-bold p-4 px-0"
                    href="{{ route('dashboard') }}"
                  >
                    {{config('app.name', 'Laravel')}}
                  </a>
                </div>
                <div class="w-6/12 flex justify-end">
                  <button
                    type="button"
                    class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                    onclick="toggleNavbar('example-collapse-sidebar')"
                  >
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </div>

            <ul class="md:flex-col md:min-w-full flex flex-col list-none">
              <li class="items-center">
                <x-side-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                  <i class="fas fa-tv mr-2 text-sm {{ (request()->routeIs('admin.dashboard')) ? 'text-green-500' : 'text-gray-800'}}" ></i>
                  {{ __('Dashboard') }}
                </x-side-link>
              </li>
            </ul>


            <!-- Divider -->
            <hr class="my-4 md:min-w-full" />
            <!-- Heading -->
            <h6
              class="md:min-w-full text-gray-600 text-xs uppercase font-bold block pt-1 pb-4 no-underline"
            >
              Manage User
            </h6>
            <!-- Navigation -->

            <ul class="md:flex-col md:min-w-full flex flex-col list-none">
              <li class="items-center">
                <x-side-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                  <i class="fas fa-users mr-2 text-sm {{ (request()->routeIs('admin.users.index')) ? 'text-green-500' : 'text-gray-800'}}" ></i>
                  {{ __('User') }}
                </x-side-link>
              </li>

              <li class="items-center">
                <x-side-link :href="route('admin.students.index')" :active="request()->routeIs('admin.students.index')">
                  <i class="fas fa-user-graduate mr-3 text-sm {{ (request()->routeIs('admin.students.index')) ? 'text-green-500' : 'text-gray-800'}}" ></i>
                  {{ __('Student') }}
                </x-side-link>
              </li>

              <li class="items-center">
                <x-side-link :href="route('admin.teachers.index')" :active="request()->routeIs('admin.teachers.index')">
                  <i class="fas fa-chalkboard-teacher mr-2 text-sm {{ (request()->routeIs('admin.teachers.index')) ? 'text-green-500' : 'text-gray-800'}}" ></i>
                  {{ __('Teacher') }}
                </x-side-link>
              </li>
            </ul>

            <!-- Divider -->
            <hr class="my-4 md:min-w-full" />
            <!-- Heading -->
            <h6
              class="md:min-w-full text-gray-600 text-xs uppercase font-bold block pt-1 pb-4 no-underline"
            >
              Manage Classroom
            </h6>
            <!-- Navigation -->

            <ul class="md:flex-col md:min-w-full flex flex-col list-none">
              <li class="items-center">
                <x-side-link :href="route('admin.departments.index')" :active="request()->routeIs('admin.departments.index')">
                  <i class="fas fa-building mr-3 text-sm {{ (request()->routeIs('admin.departments.index')) ? 'text-green-500' : 'text-gray-800'}}" ></i>
                  {{ __('Department') }}
                </x-side-link>
              </li>

              <li class="items-center">
                <x-side-link :href="route('admin.schoolclasses.index')" :active="request()->routeIs('admin.schoolclasses.index')">
                  <i class="fas fa-chalkboard mr-2 text-sm {{ (request()->routeIs('admin.schoolclasses.index')) ? 'text-green-500' : 'text-gray-800'}}" ></i>
                  {{ __('Class') }}
                </x-side-link>
              </li>
            </ul>


            <!-- Divider -->
            <hr class="my-4 md:min-w-full" />
            <!-- Heading -->
            <h6
              class="md:min-w-full text-gray-600 text-xs uppercase font-bold block pt-1 pb-4 no-underline"
            >
              Manage Course
            </h6>
            <!-- Navigation -->

            <ul class="md:flex-col md:min-w-full flex flex-col list-none">
              <li class="items-center">
                <x-side-link :href="route('admin.departments.index')" :active="request()->routeIs('admin.departments.index')">
                  <i class="fas fa-building mr-3 text-sm {{ (request()->routeIs('admin.departments.index')) ? 'text-green-500' : 'text-gray-800'}}" ></i>
                  {{ __('Department') }}
                </x-side-link>
              </li>

            </ul>
          </div>
        </div>
      </nav>