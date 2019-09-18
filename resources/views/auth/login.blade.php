@extends('layouts.app')

@section('content')
<div class="container">
    <div class="login-box mt-2">
<!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
          <div class="login-logo">
            <img style="height: 120px;" src="img/clinick1.png">
        </a>
    </div>
      <p class="login-logo">Login</p>
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="input-group mb-3">
          <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
          </div>
      </div>
      @error('email')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
</div>
<div class="input-group mb-3">

    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password"> 
    <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
      </div>
  </div>
      @error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror   
</div>
<div class="row ml-2">
  <div class="col-8">
    <div class="icheck-primary">
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label" for="remember">
            {{ __('Remember Me') }}
        </label>
    </div>
</div>
<!-- /.col -->
<div class="col-4">
    <button type="submit" class="btn btn-primary btn-block btn-flat">
        {{ __('Login') }}
    </button>
</div>
<!-- /.col -->
</div>
<hr>

<p class="mb-1">
 @if (Route::has('password.request'))
 <a class="btn btn-link" href="{{ route('password.request') }}">
    {{ __('Forgot Your Password?') }}
</a>
@endif
</p>
</div>
</form>
</div>
</div>
</div>
@endsection
