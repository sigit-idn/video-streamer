@extends('templates.main')

@section('css')
@yield("meta")
    <!-- Favicon -->
    <link rel="shortcut icon" href="/images/favicon.png">
    <!-- CSS bootstrap-->
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <!--  Style -->
    <link rel="stylesheet" href="/css/style.css" />
    <!--  Responsive -->
    <link rel="stylesheet" href="/css/responsive.css" />
        @endsection

@section("body")
@include("pages.components.header")

@yield("main")

@include("pages.components.footer")

@endsection

@section('script')

<!-- js-min -->
<script src="/js/jquery-3.6.0.min.js"></script>
<script src="/js/asyncloader.min.js"></script>
<!-- JS bootstrap -->
<script src="/js/bootstrap.min.js"></script>
<!-- owl-carousel -->
<script src="/js/owl.carousel.min.js"></script>
<!-- counter-js -->
<script src="/js/jquery.waypoints.min.js"></script>
<script src="/js/jquery.counterup.min.js"></script>
<!-- popper-js -->
<script src="/js/popper.min.js"></script>
<script src="/js/swiper-bundle.min.js"></script>
<!-- Iscotop -->
<script src="/js/isotope.pkgd.min.js"></script>

<script src="/js/jquery.magnific-popup.min.js"></script>

<script src="/js/slick.min.js"></script>

<script src="/js/streamlab-core.js"></script>

<script src="/js/script.js"></script>

<script>
    document.querySelectorAll('.page-link')?.forEach(link => {
        link.classList.add('bg-dark', 'border-0', 'text-danger')
    })
    document.querySelector('.page-item.active .page-link')?.className = "page-link bg-danger border-0 text-white"
</script>

@endsection
