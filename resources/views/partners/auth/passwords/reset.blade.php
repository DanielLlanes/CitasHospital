@extends('staff.layouts.auth')
@section('title')
    {{ __('Reset Password') }}
@endsection
@section('content')

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="limiter">
    <div class="container-login100 page-background">
        <div class="wrap-login100" style="background: -webkit-linear-gradient(top, #904433, #ce4128);>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="login100-form" method="POST" action="{{ route('staff.password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <span class="d-flex justify-content-center">
                    <img alt="" src="{{ asset('staffFiles/assets/img/hospital1.png') }}">
                </span>
                <span class="login100-form-title p-b-34 p-t-27">
                    {{ __('Reset Password') }}
                </span>
                <div class="wrap-input100" data-validate = "Enter username">
                    <input class="input100" type="text" autocomplete="off" name="email" value="{{ $email ?? old('email') }}" placeholder="{{ __('E-Mail Address') }}">
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>
                @error('email')
                    <span class="invalid-feedback d-block mb-5" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="wrap-input100" data-validate="Enter password">
                    <input class="input100" type="password" autocomplete="off" name="password" placeholder="{{ __('Password') }}">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>

                </div>
                @error('password')
                    <span class="invalid-feedback d-block mb-5" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="wrap-input100" data-validate="Enter password confirmation">
                    <input class="input100" type="password" autocomplete="off" name="password_confirmation" placeholder="{{ __('Confirm Password') }}">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>
                <div class="container-login100-form-btn mt-5">
                    <button class="login100-form-btn" type="submit">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
