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
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('staff.password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
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
        <div class="wrap-login100">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form class="login100-form" method="POST" action="{{ route('staff.password.email') }}">
                @csrf
                <span class="d-flex justify-content-center">
                    <img alt="" src="{{ asset('staffFiles/assets/img/hospital1.png') }}">
                </span>
                <span class="login100-form-title  p-t-27">
                   {{ __('Reset Password') }}
                </span>
                <p class="text-center txt-small-heading">
                    {!! __('Forgot Your Password? Let Us Help You.') !!}
                </p>
                <div class="wrap-input100 mb-0" data-validate = "{{ __('E-Mail Address') }}">
                    <input class="input100" type="text" autocomplete="off" name="email" placeholder="{{ __('E-Mail Address') }}">
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>
                @error('email')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="container-login100-form-btn mt-5">
                    <button class="login100-form-btn" type="submit">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>
                <div class="text-center p-t-27">
                    <a class="txt1" href="{{ route('staff.login') }}">
                        {{ __('Login') }}?
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
