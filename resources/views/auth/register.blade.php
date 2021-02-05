<x-guest-layout>
    <x-slot name="title">
        Register
     </x-slot>
    <x-auth-card>
            <x-slot name="image">
                <img src="{{ asset('image/undraw_welcome_cats_thqn.svg') }}" alt="Image">
            </x-slot>
        <x-slot name="title">
            <a href="/">
                {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
                <h3 class="text-3xl text-center md:text-left">Register</h3>
                <p class="text-center md:text-left">Online course SMKN 1 Sumedang</p>
            </a>
        </x-slot>

        <!-- Validation Errors -->
        {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

        <form method="POST" action="{{ route('register') }}" x-data="{role_id:2}" novalidate>
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                <x-validation-message name="name"/>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                <x-validation-message name="email"/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                <x-validation-message name="password"/>

            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')"/>

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
                <x-validation-message name="password_confirmation"/>
            </div>

            <div class="mt-4">
                <x-label for="role_id" value="{{ __('Register as:') }}" />
                <select name="role_id" x-model="role_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <option value="2">Student</option>
                    <option value="3">Teacher</option>
                    {{-- <option value="4">Headmaster</option> --}}
                </select>
            </div>

            <div class="mt-4" x-show="role_id == 2">
                <x-label for="nis" value="{{ __('NIS') }}" />
                <x-input id="nis" class="block mt-1 w-full" type="number" :value="old('nis')" name="nis" />
            </div>

            <div class="mt-4" x-show="role_id == 3">
                <x-label for="nip" value="{{ __('NIP') }}" />
                <x-input id="nip" class="block mt-1 w-full" type="number" :value="old('nip')" name="nip" />
            </div>

            <div class="mt-4" x-show="role_id == 4">
                <x-label for="nip" value="{{ __('NIP') }}" />
                <x-input id="nip" class="block mt-1 w-full" type="number" :value="old('nip')" name="nip" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
