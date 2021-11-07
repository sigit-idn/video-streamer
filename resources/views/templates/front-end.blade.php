@extends('templates.main')

@section('css')
@yield("meta")
    <!-- Favicon -->
    <link rel="shortcut icon" href="/images/favicon.png">
    <!-- CSS bootstrap-->
    {{-- <link rel="stylesheet" href="/css/bootstrap.min.css" /> --}}
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
{{-- <script src="/js/owl.carousel.min.js"></script> --}}
<!-- counter-js -->
{{-- <script src="/js/jquery.waypoints.min.js"></script>
<script src="/js/jquery.counterup.min.js"></script> --}}
<!-- popper-js -->
{{-- <script src="/js/popper.min.js"></script> --}}
{{-- <script src="/js/swiper-bundle.min.js"></script> --}}
<!-- Iscotop -->
{{-- <script src="/js/isotope.pkgd.min.js"></script> --}}

{{-- <script src="/js/jquery.magnific-popup.min.js"></script> --}}

{{-- <script src="/js/slick.min.js"></script> --}}

<script src="/js/streamlab-core.js"></script>

<script src="/js/script.js"></script>

<script>
if (document.querySelector(".page-link")) {
  document.querySelectorAll(".page-link").forEach(function (link) {
    link.classList.add("bg-dark", "border-0", "text-danger");
  });
}

if (document.querySelector(".page-item.active .page-link")) {
  document.querySelector(".page-item.active .page-link").className =
    "page-link bg-danger border-0 text-white";
}

var typeWriter = document.querySelector("#typeWriter");
if (typeWriter) {
    window.addEventListener("scroll", function () {
        typeWriter.style.opacity = 1 - (window.scrollY / window.innerHeight) * 2;
    });

    function typeWrite(typeWriterTexts) {
        for (
            var typeWriterIndex = 0;
            typeWriterIndex < typeWriterTexts.length;
            typeWriterIndex++
            ) {
                setTimeout(function () {
                    var randomIndex = Math.floor(Math.random() * typeWriterTexts.length)
                var typeWriterArray =
                typeWriterTexts[randomIndex].split("");
                    typeWriter.innerHTML = "";
                    typeWriterArray.forEach(function (typeWriterLetter, textLetterIndex) {
                        setTimeout(function () {
                            typeWriter.innerHTML += typeWriterLetter;
                        }, 100 * textLetterIndex);
                    });
                }, typeWriterIndex * 300 * typeWriterTexts[typeWriterIndex].length + 800);
            }
        }

        typeWrite(typeWriterTexts);
        setInterval(function () {
            typeWrite(typeWriterTexts);
        }, 300 * typeWriterTexts.join("").split("").length + 3000);
    }

</script>

@endsection
