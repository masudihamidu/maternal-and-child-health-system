<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <form method="POST" action="{{ route('maternalAuth.login') }}">
        @csrf

        <!-- Maternal Card -->
        <div class="mt-4">
            <x-input-label for="maternalCard" :value="__('Maternal Card')" />
            <x-text-input id="maternalCard" class="block mt-1 w-full" type="text" name="maternalCard" :value="old('maternalCard')" required autofocus />
            <x-input-error :messages="$errors->get('maternalCard')" class="mt-2" />
        </div>

        <!-- Maternal Card (acting as password) -->
        <div class="mt-4">
            <x-input-label for="maternalCard" :value="__('Maternal Card (treated as password)')" />
            <x-text-input id="maternalCard" class="block mt-1 w-full" type="password" name="maternalCard" required />
            <x-input-error :messages="$errors->get('maternalCard')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">


            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
