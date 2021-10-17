@extends("templates.front-end")

@section('body')


    <!-- Log-in  -->
    <section class="position-relative pb-0">
        <div class="gen-login-page-background"></div>
        <div class="container">
            <div class="row">
                @if (session("success"))
                <p class="alert alert-success alert-dismissable fade show" role="alert">{{ session("success") }}</p>
                @endif
                @if (session("loginError"))
                <p class="alert alert-danger alert-dismissable fade show" role="alert">{{ session("loginError") }}</p>
                @endif
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <form method="POST" action="/login">
                            @csrf
                            <h4>Log In</h4>
                            <p class="login-username">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" id="email" class="input @error("email") is-invalid @enderror" value="" size="20">
                                @error("email")
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                            </p>
                            <p class="login-password">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="input @error("password") is-invalid @enderror" value="" size="20">
                                @error("password")
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                            </p>
                            <p class="login-submit">
                                <button type="submit" class="button button-primary">
                            </p>
                            Don't have account? <a href="register.html">Register</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Log-in  -->

<main class="form-signin">



	<form method="POST" action="/login">
        @csrf
    <h1 class="h3 mb-3 fw-normal">Login</h1>
{{--
		<div class="form-floating">
			<input type="text" class="form-control @error("username") is-invalid @enderror" id="username" name="username" placeholder="Enter yout username" required value="{{ @old("username") }}">
			<label for="username">Username</label>
            @error("username")
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
		</div> --}}

    <div class="form-floating">
			<input type="email" class="form-control @error("email") is-invalid @enderror" id="email" name="email" placeholder="name@example.com" required value="{{ @old("email") }}">
      <label for="email">Email address</label>
      @error("email")
          <p class="invalid-feedback">{{ $message }}</p>
      @enderror
    </div>

    <div class="form-floating">
			<input type="password" class="form-control @error("password") is-invalid @enderror" id="password" name="password" placeholder="Password" required value="{{ @old("password") }}">
      <label for="password">Password</label>
      @error("password")
          <p class="invalid-feedback">{{ $message }}</p>
      @enderror
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
  </form>
</main>

@endsection
