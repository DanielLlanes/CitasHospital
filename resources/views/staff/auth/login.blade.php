@extends('staff.layouts.auth')
@section('title')
    {{ __('Login') }}
@endsection
@section('content')
<div class="limiter">
    <div class="container-login100 page-background">
        <div class="wrap-login100">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        {{ $errors->all() }}
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="login100-form" method="POST" action="{{ route('staff.login') }}">
                @csrf
                <span class="d-flex justify-content-center">
                    <img alt="" src="{{ asset('staffFiles/assets/img/hospital1.png') }}">
                </span>
                <span class="login100-form-title p-b-34 p-t-27">
                    {{ __('Login') }}
                </span>
                <div class="wrap-input100" data-validate = "Enter username">
                    <input class="input100" type="text" autocomplete="off" name="login" placeholder="{{ __('Username or Email') }}">
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>
                @error('email')
                    <span class="invalid-feedback d-bock mb-5" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                @error('username')
                    <span class="invalid-feedback d-bock mb-5" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="wrap-input100" data-validate="Enter password">
                    <input class="input100" type="password" autocomplete="off" name="password" placeholder="{{ __('Password') }}">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>
                @error('password')
                @enderror
                <div class="contact100-form-checkbox">
                    <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="label-checkbox100" for="ckb1">
                        {{ __('Remember Me') }}
                    </label>
                </div>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" type="submit">
                        {{ __('Login') }}
                    </button>
                </div>
                @if (Route::has('staff.password.request'))
                   <div class="text-center p-t-30 mt-5">
                       <a class="txt1" href="{{ route('staff.password.request') }}">
                           {{ __('Forgot Your Password?') }}
                       </a>
                   </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
