@php
    $cryptocurrencies = [
        [
            "title" => "Bitcoin",
            "qr"    => "/images/cryptocurrency/bitcoin.jpg",
            "url"   => "https://www.blockchain.com/btc/address/3BTbmmRubF8uwVb4UFuYcckX2soKDWjiyi",
            "code"  => "3BTbmmRubF8uwVb4UFuYcckX2soKDWjiyi"
        ],
        [
            "title" => "Ethereum",
            "qr"    => "/images/cryptocurrency/ethereum.jpg",
            "url"   => "https://etherscan.io/address/0x998F25Be40241CA5D8F5fCaF3591B5ED06EF3Be7",
            "code"  => "0x998F25Be40241CA5D8F5fCaF3591B5ED06EF3Be7"
        ],
    ];
@endphp

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

        <div class="gen-breadcrumb">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav aria-label="breadcrumb">
                        <div class="gen-breadcrumb-title">
                            <h1>Cryptocurrency</h1>
                        </div>
                        <div class="gen-breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/"><i
                                            class="fas fa-home mr-2"></i>Home</a></li>
                                <li class="breadcrumb-item active">Cryptocurrency</li>
                            </ol>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <!-- breadcrumb -->

    <!-- Section-1 Start -->
    <section class="gen-section-padding-3">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="gen-style-1">
                        <div class="row">
                            <select id="cryptocurrencySelect" value class="form-control bg-dark text-white">
                                @foreach ($cryptocurrencies as $cryptocurrency)
                                    <option value="{{ $cryptocurrency["title"] }}">{{ $cryptocurrency["title"] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <a id="paymentUrl" href="{{ $cryptocurrencies[0]["url"] }}" class="btn btn-danger mt-2 mx-auto" style="max-width: 150px">
                                Pay Here
                            </a>
                        </div>
                        <div class="row">
                            <img id="qrCode" src="{{ $cryptocurrencies[0]["qr"] }}"
                            alt="{{ $cryptocurrencies[0]["title"] }}"
                            style="width: 100%; max-width: 300px; margin: 1em auto">
                        </div>
                        <div class="row mt-3">
                            <div class="input-group">
                                <span id="paymentCode" class="overflow-scroll form-control text-center border-0 bg-dark text-white">{{ $cryptocurrencies[0]["code"] }}</span>
                                <button class="btn btn-danger" id="copyPaymentCode">Copy</button>
                            </div>
                        </div>
                        <div class="row mt-3 px-2 text-danger mx-auto d-none" id="copiedMessage" style="max-width: 200px;">
                            Payment Code Coppied!
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="gen-pagination">
                        <nav aria-label="Page navigation">
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        var cryptocurrencies = <?= json_encode($cryptocurrencies) ?>;

        document
  .querySelector("#cryptocurrencySelect")
  .addEventListener("change", function (event) {
    var selectedItem = cryptocurrencies.find(function (cryptocurrency) {
      return cryptocurrency.title == event.target.value;
    });

    document.querySelector("#qrCode").src = selectedItem.qr;
    document.querySelector("#paymentUrl").src = selectedItem.url;
    document.querySelector("#paymentCode").innerHTML = selectedItem.code;
  });

document
  .querySelector("#copyPaymentCode")
  .addEventListener("click", function () {
    var copiedMessage = document.querySelector("#copiedMessage");
    navigator.clipboard
      .writeText(document.querySelector("#paymentCode").innerHTML)
      .then(function () {
        copiedMessage.classList.remove("d-none");

        setTimeout(() => {
          copiedMessage.classList.add("d-none");
        }, 5000);
      });
  });

    </script>

    <!-- Section-1 End -->

    <!-- Back-to-Top start -->
    {{-- <div id="back-to-top">
        <a class="top" id="top" href="#top"> <i class="ion-ios-arrow-up"></i> </a>
    </div> --}}
    <!-- Back-to-Top end -->
    @endsection
