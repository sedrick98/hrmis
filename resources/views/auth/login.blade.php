@extends('layouts.auth_app')

@section('content')


<body style="background-image: url('/images/logos/dost1.jpg'); background-size: cover">


  <div class="container" style="width:750px; margin-top:-80px;">
    <div>
      <img src="{{asset('images/logos/dostlogo1.png')}}" alt="DOST 11 Logo" style="display:block; height:150px; width:150px; margin:auto">
    </div><br>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-group">
          <div class="card p-4">
            <div class="card-body">
              <h1>Login</h1>
              <p class="text-muted">Sign In to your account</p>
              <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group mb-3">

                  @if (count($errors) > 0)
                  <div class="error">
                    <ul>
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                  @endif
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <svg class="c-icon">
                        <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
                      </svg>
                    </span>
                  </div>
                  <input class="form-control" type="text" placeholder="{{ __('username') }}" name="username" value="{{ old('username') }}" required autofocus>
                </div>
                <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <svg class="c-icon">
                        <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-lock-locked"></use>
                      </svg>
                    </span>
                  </div>
                  <input class="form-control" type="password" placeholder="{{ __('Password') }}" name="password" required>
                </div>
                <div class="row">
                  <div class="col-6">
                    <button class="btn btn-primary px-4" type="submit">{{ __('Login') }}</button>
                  </div>
              </form>
              <div class="col-6 text-right">
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  </div>


</body>


@endsection

@section('javascript')

@endsection