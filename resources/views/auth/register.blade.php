@extends('layouts.auth_app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mx-4">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <h1>{{ __('Register') }}</h1>
                        <p class="text-muted">Create your account</p>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="icon-user"></i>
                                </span>
                            </div>
                            <input class="form-control" type="text" placeholder="{{ __('Username') }}" name="username" value="{{ old('username') }}" required autofocus>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="icon-user"></i>
                                </span>
                            </div>
                            <input class="form-control" type="text" placeholder="{{ __('First Name') }}" name="first_name" value="{{ old('first_name') }}" required autofocus>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="icon-user"></i>
                                </span>
                            </div>
                            <input class="form-control" type="text" placeholder="{{ __('Middle Name') }}" name="middle_name" value="{{ old('middle_name') }}" required autofocus>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="icon-user"></i>
                                </span>
                            </div>
                            <input class="form-control" type="text" placeholder="{{ __('Last Name') }}" name="last_name" value="{{ old('last_name') }}" required autofocus>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input class="form-control" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="icon-lock"></i>
                                </span>
                            </div>
                            <input class="form-control" type="password" placeholder="{{ __('Password') }}" name="password" required>
                        </div>
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="icon-lock"></i>
                                </span>
                            </div>
                            <input class="form-control" type="password" placeholder="{{ __('Confirm Password') }}" name="password_confirmation" required>
                        </div>
                        <button class="btn btn-block btn-success" type="submit">{{ __('Register') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

@section('javascript')

@endsection