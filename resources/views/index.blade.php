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

    <!-- Login Container -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Ingia') }}</div>

                    <div class="card-body">
                        <p>{{ __('Tafadhali chagua njia yako ya kuingia:') }}</p>
                        <a href="{{ route('professional') }}" class="btn btn-primary btn-block">
                            {{ __('Mtaalamu wa afya') }}
                        </a>
                        <br/>
                        <a href="{{ route('maternal') }}" class="btn btn-secondary btn-block mt-3">
                            {{ __('Mama mjamzito') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
