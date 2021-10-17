@extends('templates.main')

@section("css")
<style>
  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
  }

  @media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
  }
  </style>

<!-- Custom styles for this template -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link href="/css/dashboard.css" rel="stylesheet">

@endsection

@section('body')
@include('dashboard.components.header')

<div class="container-fluid">
  <div class="row mb-5">
    @include('dashboard.components.left-nav')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 border-left">
    @yield("dashboard-main")
    </main>
  </div>
</div>
@endsection

@section("script")

<script src="/js/dashboard.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script> --}}
@endsection
