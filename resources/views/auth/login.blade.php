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

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Login Type Dropdown -->
        <div>
            <x-input-label for="login_type" :value="__('Login as')" />
            <select id="login_type" class="block mt-1 w-full" onchange="toggleLoginFields()">
                <option value="professional">{{ __('Professional') }}</option>
                <option value="expectant">{{ __('Expectant') }}</option>
            </select>
        </div>

        <!-- Professional Login Fields -->
        <div id="professional_fields">
            <!-- Name -->
            <div class="mt-4">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
        </div>

        <!-- Expectant Login Fields -->
        <div id="expectant_fields" style="display: none;">
            <!-- ID -->
            <div class="mt-4">
                <x-input-label for="id" :value="__('ID')" />
                <x-text-input id="id" class="block mt-1 w-full" type="text" name="id" :value="old('id')" />
                <x-input-error :messages="$errors->get('id')" class="mt-2" />
            </div>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        function toggleLoginFields() {
            const loginType = document.getElementById('login_type').value;
            const professionalFields = document.getElementById('professional_fields');
            const expectantFields = document.getElementById('expectant_fields');

            console.log("Login Type: ", loginType);

            if (loginType === 'professional') {
                professionalFields.style.display = 'block';
                expectantFields.style.display = 'none';
            } else {
                professionalFields.style.display = 'none';
                expectantFields.style.display = 'block';
            }
        }

        // Call the function initially to set the correct fields on page load
        document.addEventListener('DOMContentLoaded', (event) => {
            toggleLoginFields();
        });
    </script>
</x-guest-layout>
