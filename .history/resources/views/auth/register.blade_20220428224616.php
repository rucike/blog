<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/project/public">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value=" __('Name/Nickname')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>


            <!-- Choose the Type of Blog -->
            <div class="mt-4">
                <x-label for="type" :value="__('Choose the Type of Your Blogs')"/>

                <select id="type" name="type" class="block mt-1 w-full sm:rounded-lg">
                    <option value="personal">{{ __('Personal blogs') }}</option>
                    <option value="business">{{ __('Business / corporate blogs') }}</option>
                    <option value="professional">{{ __('Personal brands / professional blogs') }}</option>
                    <option value="fashion">{{ __('Fashion blogs') }}</option>
                    <option value="lifestyle">{{ __('Lifestyle blogs') }}</option>
                    <option value="travel">{{ __('Travel blogs') }}</option>
                    <option value="food">{{ __('Food blogs') }}</option>
                    <option value="review">{{ __('Affiliate / Review Blogs') }}</option>
                    <option value="multimedia">{{ __('Multimedia blogs') }}</option>
                    <option value="news">{{ __('News blogs') }}</option>   
                </select>
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
