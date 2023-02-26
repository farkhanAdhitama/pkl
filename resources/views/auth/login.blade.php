@extends('layouts.empty')

@section('content')
    <style>
        .content-wrapper {
            background-image: url("assets/images/smanka_login.jpg");
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>

    <body>
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper full-page-wrapper">
                <div class="content-wrapper d-flex align-items-center auth">
                    <div class="row flex-grow">
                        <div class="col-lg-4 mx-auto">
                            <div class="auth-form-light text-left p-5">
                                <div class="brand-logo">
                                    <h3 class="text-primary">Manajemen Perpustakaan</h3>
                                    <h3 class="text-primary">SMA Negeri 1 Kajen</h3>
                                </div>
                                <h4>Selamat Datang</h4>
                                <h6 class="font-weight-light">Login untuk melanjutkan.</h6>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="row">
                                        <label for="username"
                                            class="col col-form-label ">{{ __('Username atau Email') }}</label>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <input id="username" name="username" type="text"
                                                class="form-control @error('username') is-invalid @enderror"
                                                placeholder="Masukkan Username atau Email" name="username"
                                                value="{{ old('username') }}" required autocomplete="username" autofocus>

                                            @error('username')
                                                <span class="text-danger">
                                                    <sub>{{ $message }}</sub>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label for="password" class="col col-form-label">{{ __('Password') }}</label>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Masukkan Password" name="password"
                                                autocomplete="current-password">

                                            @error('password')
                                                <span class="text-danger">
                                                    <sub>{{ $message }}</sub>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="my-2 d-flex justify-content-between align-items-center">
                                        <div class="form-check">
                                            <label class="form-check-label" for="remember">
                                                {{ __('Ingat Saya') }}
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}> </label>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <a class="auth-link text-black float-end"
                                                href="{{ route('password.request') }}">
                                                {{ __('Lupa Password?') }}
                                            </a>
                                        @endif
                                    </div>

                                    <div class="row mb-0">
                                        <div class="text-center ">
                                            <button type="submit" class="btn  w-100 px-4 btn-gradient-primary">
                                                {{ __('Login') }}
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>

    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
@endsection
