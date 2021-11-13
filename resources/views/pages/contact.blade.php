@extends('templates.front-end')
@section('main')
    <!--=========== Loader =============-->
    <div id="gen-loading">
        <div id="gen-loading-center">
            <img src="images/logo-1.png" alt="loading">
        </div>
    </div>
    <!--=========== Loader =============-->

    <!-- breadcrumb -->
    <div class="gen-breadcrumb" style="background-image: url('images/background/asset-25.jpeg');">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav aria-label="breadcrumb">
                        <div class="gen-breadcrumb-title">
                            <h1>
                                contact us
                            </h1>
                        </div>
                        <div class="gen-breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home mr-2"></i>Home</a></li>
                                <li class="breadcrumb-item active">contact us</li>
                            </ol>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->

    <!-- Icon-Box Start -->
    <section class="gen-section-padding-3">
        <div class="container container-2">
            <div class="row">
            </div>
        </div>
    </section>
    <!-- Icon-Box End -->

    <!-- Map Start -->
    <Section class="gen-section-padding-3 gen-top-border">
        <div class="container container-2">
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2">
                    <h2 class="mb-5">get in touch</h2>
                    <form method="POST">
                        @csrf
                        <div class="row gt-form">
                            <div class="col-md-6 mb-4"><input type="email" name="email" required
                                    value="{{ old('email') }}" placeholder="Email"></div>
                            <div class="col-md-6 mb-4"><input type="text" name="name" value="{{ old('name') }}"
                                    placeholder="Name"></div>
                            <div class="col-md-6 mb-4"><input type="text" name="title" required
                                    value="{{ old('title') }}" placeholder="Title"></div>
                            <div class="col-md-12 mb-4"><textarea name="message" rows="6" required
                                    placeholder="Message">{{ old('message') }}</textarea></div>
                            <div class="col-md-6 mb-4">
                                <p class="mb-1">{{ $question }}</p>
                                <input type="text" name="verification" value="{{ old('verification') }}"
                                    placeholder="Your answer">
                                <p class="invalid-feedback d-block">
                                    {{ session('verification') }}
                                </p>
                                <button type="submit" class="mt-4">Submit</button>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
        </div>
    </Section>
    <!-- Map End -->
@endsection
