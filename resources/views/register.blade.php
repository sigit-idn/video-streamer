@extends('templates.front-end')

@section('main')


    <!-- register -->
    <section class="position-relative pb-0">
        <div class="gen-register-page-background" style="background-image: ;">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <form id="pms_register-form" class="pms-form" method="POST" action="/register">
                            @csrf
                            <h4>Register</h4>
                            <input type="hidden" id="pmstkn" name="pmstkn" value="59b502f483"><input type="hidden"
                                name="_wp_http_referer" value="/register/">
                            <ul class="pms-form-fields-wrapper pl-0 d-flex flex-column">
                                <li class="pms-field w-100 pms-first-name-field ">
                                    <label for="pms_first_name">Name</label>
                                    <input class="@error("name") is-invalid @enderror" id="pms_first_name" name="name" type="text" value="{{ old("name") }}">
                                    @error("name")
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                </li>
                                <li class="pms-field w-100 pms-user-email-field ">
                                    <label for="pms_user_email">E-mail</label>
                                    <input class="@error("email") is-invalid @enderror" id="pms_user_email" name="email" type="text" value="{{ old("email") }}">
                                    @error("email")
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                </li>
                                <li class="pms-field w-100 pms-user-login-field ">
                                    <label for="pms_user_login">Username</label>
                                    <input class="@error("username") is-invalid @enderror" id="pms_user_login" name="username" type="text" value="{{ old("username") }}">
                                    @error("username")
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </li>
                                <li class="pms-field w-100 pms-pass1-field">
                                    <label for="pms_pass1">Password</label>
                                    <input class="@error("password") is-invalid @enderror" id="pms_pass1" name="password" type="password">
                                    @error("password")
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </li>
                            </ul>
                            <span id="pms-submit-button-loading-placeholder-text" class="d-none">Processing. Please wait...</span>
                            <button name="pms_register" type="submit">Register</button>
                            <p>Already have an account? <a href="/login">Login</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- register -->

@endsection
