@extends('layouts.app')

@section('content')

    <body id="kt_body"
        class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed page-loading">
        <!--begin::Main-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Login-->
            <div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white"
                id="kt_login">
                <!--begin::Aside-->
                <div class="login-aside order-2 order-lg-1 d-flex flex-row-auto position-relative overflow-hidden">
                    <!--begin: Aside Container-->
                    <div class="d-flex flex-column-fluid flex-column justify-content-between py-9 px-7 py-lg-13 px-lg-35">
                        <!--begin::Logo-->
                        <a href="#" class="text-center pt-2">
                            <img src="assets/media/logos/logowithbg.png" class="max-h-100px" alt="" />
                        </a>
                        <!--end::Logo-->
                        <!--begin::Aside body-->
                        <div class="d-flex flex-column-fluid flex-column flex-center">
                            <!--begin::Signin-->
                            <div class="login-form login-signin py-11">
                                <!--begin::Form-->
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <!--begin::Title-->
                                    <div class="text-center pb-8">
                                        <h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Sign In</h2>
                                        <span class="text-muted font-weight-bold font-size-h4">Or
                                            <a href="{{ route('register') }}" class="font-weight-bolder" style="color: #0BB783;"
                                                id="kt_login_signup">Create An Account</a></span>
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <label for="email" class="font-size-h6 font-weight-bolder text-dark">{{ __('Email Address') }}</label>
                                        <input id="email" type="email" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" autocomplete="email" autofocus />
                                        @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <!--end::Form group-->
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between mt-n5">
                                            <label for="password" class="font-size-h6 font-weight-bolder text-dark pt-5">{{ __('Password') }}</label>
                                        </div>
                                        <input id="password" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg @error('password') is-invalid @enderror"
                                            type="password" name="password" autocomplete="off" />

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <!--end::Form group-->
                                    <!--begin::Action-->
                                    <div class="text-center pt-2">
                                        <button type="submit"
                                            class="btn btn-dark font-weight-bolder font-size-h6 px-8 py-4 my-3">Sign
                                            In</button>
                                    </div>

                                    
                                    <!--end::Action-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Signin-->
                        </div>
                        <!--end::Aside body-->
                    </div>
                    <!--end: Aside Container-->
                </div>
                <!--begin::Aside-->
                <!--begin::Content-->
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
                <!--end::Content-->
            </div>
            <!--end::Login-->
        </div>
        <!--end::Main-->
    </body>
@endsection
