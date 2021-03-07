<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-green-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('teacher.courses.index')" :active="request()->routeIs('teacher.courses.index')">
                        {{ __('Class List') }}
                    </x-nav-link>
                    <x-nav-link :href="route('teacher.courses.show', ['course' => Request::segment(3)])" :active="request()->routeIs('teacher.courses.show', ['course' => Request::segment(3)])">
                        {{ __('Stream') }}
                    </x-nav-link>
                    <x-nav-link :href="route('teacher.tasks', ['class' => Request::segment(3)])" :active="request()->routeIs('teacher.tasks')">
                        {{ __('Classwork') }}
                    </x-nav-link>
                    <x-nav-link :href="route('teacher.peoples', ['class' => Request::segment(3)])" :active="request()->routeIs('teacher.peoples')">
                        {{ __('People') }}
                    </x-nav-link>
                    <x-nav-link :href="route('teacher.grades', ['class' => Request::segment(3)])" :active="request()->routeIs('teacher.grades')">
                        {{ __('Quiz Grades') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            @if (Auth::user()->profilepic === null)
                            <img src="{{ asset('image/download.png') }}" class="rounded-full w-10 h-10 mr-2"> 
                            @else
                            <img src="{{ asset('storage/' . Auth::user()->profilepic) }}" class="rounded-full w-10 h-10 mr-2">
                            @endif
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @can('manage-users')
                        <x-dropdown-link href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt mr-2"></i>{{ __('Admin Dashboard') }}
                        </x-dropdown-link>
                        @endcan
                        @can('manage-courses')
                        <x-dropdown-link href="{{ route('teacher.dashboard') }}">
                            <i class="fas fa-tachometer-alt mr-2"></i>{{ __('Teacher Dashboard') }}
                        </x-dropdown-link>
                        @endcan
                        <x-dropdown-link href="{{ route('profile') }}">
                            <i class="fas fa-user mr-2"></i>{{ __('Profile') }}
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt mr-2"></i>{{ __('Logout') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('teacher.courses.index')" :active="request()->routeIs('teacher.courses.index')">
                {{ __('Class List') }}
            </x-responsive-nav-link>
            @can('manage-courses')
            <x-responsive-nav-link :href="route('teacher.courses.show', ['course' => Request::segment(3)])" :active="request()->routeIs('teacher.courses.show', ['course' => Request::segment(3)])">
                {{ __('Stream') }}
            </x-responsive-nav-link>
            @endcan
            @can('manage-courses')
            <x-responsive-nav-link :href="route('teacher.tasks', ['class' => Request::segment(3)])" :active="request()->routeIs('teacher.tasks', ['class' => Request::segment(3)])">
                {{ __('Classwork') }}
            </x-responsive-nav-link>
            @endcan
            @can('manage-courses')
            <x-responsive-nav-link :href="route('teacher.peoples', ['class' => Request::segment(3)])" :active="request()->routeIs('teacher.peoples')">
                {{ __('People') }}
            </x-responsive-nav-link>
            @endcan
            @can('manage-courses')
            <x-responsive-nav-link :href="route('teacher.grades', ['class' => Request::segment(3)])" :active="request()->routeIs('teacher.grades')">
                {{ __('Quiz Grades') }}
            </x-responsive-nav-link>
            @endcan
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                @can('manage-users')
                <x-responsive-nav-link href="{{ route('admin.dashboard') }}">
                    {{ __('Admin Dashboard') }}
                </x-responsive-nav-link>
                @endcan
                @can('manage-courses')
                <x-responsive-nav-link href="{{ route('teacher.dashboard') }}">
                    {{ __('Teacher Dashboard') }}
                </x-responsive-nav-link>
                @endcan
                <x-responsive-nav-link href="{{ route('profile') }}">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
