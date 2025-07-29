<x-guest-layout>
    <br>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h2 class="text-2xl mt-3 font-bold text-center text-white mb-6">Masuk ke Sistem</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-white" />
            <x-text-input id="email" class="block mt-1 w-full rounded-md" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-200" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-white" />
            <x-text-input id="password" class="block mt-1 w-full rounded-md" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-200" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center text-white">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-500 shadow-sm focus:ring-indigo-400" name="remember">
                <span class="ml-2 text-sm">Ingat saya</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-100 hover:text-white" href="{{ route('password.request') }}">
                    Lupa Password?
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>
    </form>
    <br>
</x-guest-layout>
