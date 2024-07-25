@extends('layouts.app')

@section('content')
    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

    <body id="kt_body"
        class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed page-loading">
        <div class="d-flex flex-column flex-root">
            <div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white"
                id="kt_login">
                <div class="login-aside order-2 order-lg-1 d-flex flex-row-auto position-relative overflow-hidden">
                    <div class="d-flex flex-column-fluid flex-column justify-content-between py-9 px-7 py-lg-13 px-lg-35">
                        <a href="#" class="text-center pt-2">
                            <img src="assets/media/logos/logowithbg.png" class="max-h-100px" alt="" />
                        </a>
                        <div class="d-flex flex-column-fluid flex-column flex-center">
                            <div class="login-form login-signin py-11">
                                
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="text-center pb-8">
                                        <h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Register</h2>
                                        <span class="text-muted font-weight-bold font-size-h4">
                                            <a href="{{ route('login') }}" class="font-weight-bolder" style="color: #0BB783;"
                                                id="kt_login_signup">Already Have An Account?</a></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="name"
                                            class="font-size-h6 font-weight-bolder text-dark">{{ __('Name') }}</label>
                                        <input id="name" type="text"
                                            class="form-control form-control-solid h-auto py-7 px-6 rounded-lg @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name') }}" autocomplete="name" autofocus />
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat"
                                            class="font-size-h6 font-weight-bolder text-dark">{{ __('Alamat') }}</label>
                                        <input id="alamat" type="text"
                                            class="form-control form-control-solid h-auto py-7 px-6 rounded-lg @error('alamat') is-invalid @enderror"
                                            name="alamat" value="{{ old('alamat') }}" autocomplete="alamat" autofocus />
                                        @error('alamat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="no_telepon"
                                            class="font-size-h6 font-weight-bolder text-dark">{{ __('No Telepon') }}</label>
                                        <input id="no_telepon" type="text"
                                            class="form-control form-control-solid h-auto py-7 px-6 rounded-lg @error('no_telepon') is-invalid @enderror"
                                            name="no_telepon" value="{{ old('no_telepon') }}" autocomplete="no_telepon" autofocus />
                                        @error('no_telepon')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="no_str"
                                            class="font-size-h6 font-weight-bolder text-dark">{{ __('No STR') }}</label>
                                        <input id="no_str" type="text"
                                            class="form-control form-control-solid h-auto py-7 px-6 rounded-lg @error('no_str') is-invalid @enderror"
                                            name="no_str" value="{{ old('no_str') }}" autocomplete="no_str" autofocus />
                                        @error('no_str')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="nik"
                                            class="font-size-h6 font-weight-bolder text-dark">{{ __('NIK') }}</label>
                                        <input id="nik" type="text"
                                            class="form-control form-control-solid h-auto py-7 px-6 rounded-lg @error('nik') is-invalid @enderror"
                                            name="nik" value="{{ old('nik') }}" autocomplete="nik" autofocus />
                                        @error('nik')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email"
                                            class="font-size-h6 font-weight-bolder text-dark">{{ __('Email Address') }}</label>
                                        <input id="email" type="email"
                                            class="form-control form-control-solid h-auto py-7 px-6 rounded-lg @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" autocomplete="email" autofocus />
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between mt-n5">
                                            <label for="password"
                                                class="font-size-h6 font-weight-bolder text-dark pt-5">{{ __('Password') }}</label>
                                        </div>
                                        <input id="password"
                                            class="form-control form-control-solid h-auto py-7 px-6 rounded-lg @error('password') is-invalid @enderror"
                                            type="password" name="password" autocomplete="off" />
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="d-flex justify-content-between mt-n5">
                                            <label for="password-confirm"
                                                class="font-size-h6 font-weight-bolder text-dark pt-5">{{ __('Confirm Password') }}</label>
                                        </div>
                                        <input id="password-confirm"
                                            class="form-control form-control-solid h-auto py-7 px-6 rounded-lg"
                                            type="password" name="password_confirmation" autocomplete="off" />
                                    </div>
                                    <div class="text-center pt-2">
                                        <button type="submit"
                                            class="btn btn-dark font-weight-bolder font-size-h6 px-8 py-4 my-3">Register</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content order-1 order-lg-2 d-flex flex-column w-100 pb-0" style="background-color: #0BB783;">
                    <!--begin::Title-->
                    <div
                        class="d-flex flex-column justify-content-center text-center pt-lg-25 pt-md-4 pt-sm-4 px-lg-0 pt-4 px-7">
                        <h3 class="display4 font-weight-bolder my-7 text-dark" style="color: #986923;">M&nbsp; I &nbsp; B&nbsp; U
                        </h3>
                        <p class="font-weight-bolder font-size-h2-md font-size-lg text-dark opacity-70">Website Monitoring Data Kesehatan Ibu Hamil, <br>Anak, Serta Data Imunisasi
                        </p>
                    </div>
                    <!--end::Title-->
                    <!--begin::Image-->
                    <div class="content-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center"
                        style="background-image: url(assets/media/svg/illustrations/login-visual-2.svg);"></div>
                    <!--end::Image-->
                </div>
            </div>
        </div>
        <script>
            var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
        </script>
        <script>
            var KTAppSettings = {
                "breakpoints": {
                    "sm": 576,
                    "md": 768,
                    "lg": 992,
                    "xl": 1200,
                    "xxl": 1400
                },
                "colors": {
                    "theme": {
                        "base": {
                            "white": "#ffffff",
                            "primary": "#3699FF",
                            "secondary": "#E5EAEE",
                            "success": "#1BC5BD",
                            "info": "#8950FC",
                            "warning": "#FFA800",
                            "danger": "#F64E60",
                            "light": "#E4E6EF",
                            "dark": "#181C32"
                        },
                        "light": {
                            "white": "#ffffff",
                            "primary": "#E1F0FF",
                            "secondary": "#EBEDF3",
                            "success": "#C9F7F5",
                            "info": "#EEE5FF",
                            "warning": "#FFF4DE",
                            "danger": "#FFE2E5",
                            "light": "#F3F6F9",
                            "dark": "#D6D6E0"
                        },
                        "inverse": {
                            "white": "#ffffff",
                            "primary": "#ffffff",
                            "secondary": "#3F4254",
                            "success": "#ffffff",
                            "info": "#ffffff",
                            "warning": "#ffffff",
                            "danger": "#ffffff",
                            "light": "#464E5F",
                            "dark": "#ffffff"
                        }
                    },
                    "gray": {
                        "gray-100": "#F3F6F9",
                        "gray-200": "#EBEDF3",
                        "gray-300": "#E4E6EF",
                        "gray-400": "#D1D3E0",
                        "gray-500": "#B5B5C3",
                        "gray-600": "#7E8299",
                        "gray-700": "#5E6278",
                        "gray-800": "#3F4254",
                        "gray-900": "#181C32"
                    }
                },
                "font-family": "Poppins"
            };
        </script>
        <script src="assets/plugins/global/plugins.bundle.js"></script>
        <script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
        <script src="assets/js/scripts.bundle.js"></script>
        <script src="assets/js/pages/custom/login/login-general.js"></script>
    </body>
@endsection
