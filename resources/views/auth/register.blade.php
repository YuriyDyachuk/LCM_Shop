@extends('layouts.master')

{{--@section('title')--}}
{{--    @lang('translation.Register')--}}
{{--@endsection--}}

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-primary bg-soft">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-primary p-4">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="auth-logo">
                            <span class="auth-logo-light">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <span class="avatar-title rounded-circle bg-light">
                                        <img src="{{ URL::asset('admin-panel/assets/images/logo_sm.png') }}" alt=""
                                             class="rounded-circle" height="34">
                                    </span>
                                </div>
                            </span>
                            <span class="auth-logo-dark">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <span class="avatar-title rounded-circle bg-light">
                                        <img src="{{ URL::asset('admin-panel/assets/images/logo_sm.png') }}" alt=""
                                             class="rounded-circle" height="34">
                                    </span>
                                </div>
                            </span>
                        </div>
                        <div >
                            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input name="first_name" type="text"
                                           class="form-control @error('first_name') is-invalid @enderror"
                                           id="first_name"
                                           placeholder="Enter first name">
                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input name="last_name" type="text"
                                           class="form-control @error('last_name') is-invalid @enderror"
                                           id="last_name"
                                           placeholder="Enter last name">
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input name="phone" type="text"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           id="phone"
                                           placeholder="Enter phone number"
                                    >
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input name="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           id="email"
                                           placeholder="Enter email" autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="userpassword">Password</label>
                                    <div class="input-group auth-pass-inputgroup @error('password') is-invalid @enderror">
                                        <input type="password" name="password"
                                               class="form-control  @error('password') is-invalid @enderror"
                                               id="userpassword" value="" placeholder="Enter password"
                                               aria-label="Password" aria-describedby="password-addon">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="confirm_password">Confirm Password</label>
                                    <div class="input-group auth-pass-inputgroup @error('password') is-invalid @enderror">
                                        <input type="password" name="password_confirmation"
                                               class="form-control  @error('confirm_password') is-invalid @enderror"
                                               id="confirm_password" value="" placeholder="Confirm password"
                                               aria-label="Password" aria-describedby="password-addon">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-3 d-grid">
                                    <button class="btn btn-primary waves-effect waves-light"
                                            type="submit">Submit</button>
                                </div>
                                <div class=" mt-3 text-center">
                                    <p class="text-muted">
                                        Do have an account?
                                        <a href="{{route('login')}}" class=" me-1">
                                            Sign in now</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(window).on('load',function () {
            let links = `
                <link href="{{ URL::asset('admin-panel/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
                <link href="{{ URL::asset('admin-panel/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
               `
            $('head').append(links)
            document.getElementById('phone').addEventListener('input', function (y) {
                var a = y.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
                y.target.value = !a[2] ? a[1] : '(' + a[1] + ') ' + a[2] + (a[3] ? '-' + a[3] : '');
            });
        })
    </script>
@endsection
@section('styles')
    <style>
        .dropdown{
            display: none;
        }
        .form-control{
            height: 40px;
        }
        .btn-primary{
            height: 45px;
        }
        .mb-3{
            text-align: left;
        }
        .form-label{
            font-weight: bold !important;
        }
        input{
            font-size: 1rem !important;
        }
    </style>
@endsection
