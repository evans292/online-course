<nav
          class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-no-wrap md:justify-start flex items-center p-4"
        >
          <div
            class="w-full mx-autp items-center flex justify-between md:flex-no-wrap flex-wrap md:px-10 px-4"
          >
            <p
              class="text-white text-sm uppercase hidden lg:inline-block font-semibold"
              >{{ $title ?? config('app.name', 'Laravel') }}</p
            >
            <form
              class="md:flex hidden flex-row flex-wrap items-center lg:ml-auto mr-3"
            >
              <div class="relative flex w-full flex-wrap items-stretch">
              </div>
            </form>
            <ul
              class="flex-col md:flex-row list-none items-center hidden md:flex"
            >
              <a
                class="text-gray-600 block"
                href="#pablo"
                onclick="openDropdown(event,'user-dropdown')"
              >
                <div class="items-center flex">
                  <span
                    class="w-12 h-12 text-sm text-white bg-gray-300 inline-flex items-center justify-center rounded-full"
                    >
                    @if (Auth::user()->profilepic === null)
                    <img src="{{ asset('image/download.png') }}" class="w-full rounded-full align-middle border-none shadow-lg"> 
                    @else
                    <img
                      alt="..."
                      class="w-full rounded-full align-middle border-none shadow-lg"
                      src="{{ asset('storage/' . Auth::user()->profilepic) }}"/>
                    @endif
                </span>
                </div>
              </a>
              <div
                class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                id="user-dropdown"
              >
              <x-dropdown-link href="{{ route('dashboard') }}">
                <i class="fas fa-home mr-2"></i>{{ __('Home') }}
              </x-dropdown-link>
              <x-dropdown-link href="{{ route('profile') }}">
                <i class="fas fa-user mr-2"></i>{{ __('Profile') }}
              </x-dropdown-link>
              <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt mr-2"></i>{{ __('Logout') }}
                </x-dropdown-link>
            </form>
              </div>
            </ul>
          </div>
        </nav>