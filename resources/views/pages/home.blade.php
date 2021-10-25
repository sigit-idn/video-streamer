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
    <?php
    $headerVideo = $videos[0];
    $headerYoutubeVideoID = [];
    if (!preg_match("/(\w|-|_){11}/", $headerVideo["video_url"], $headerYoutubeVideoID)) {
        $headerYoutubeVideoID = [""];
    };

    ?>

    <div class="gen-breadcrumb" style="background-image: url('{{$headerVideo["thumbnail"] ? "/storage/"
    . $headerVideo['thumbnail']
    : "https://i.ytimg.com/vi/"
    . $headerYoutubeVideoID[0]
    . "/hq720.jpg"}}');">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav aria-label="breadcrumb">
                        <div class="gen-breadcrumb-title">
                            <h1>Videos</h1>
                        </div>
                        <div class="gen-breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/"><i
                                            class="fas fa-home mr-2"></i>Home</a></li>
                                <li class="breadcrumb-item active">Videos</li>
                            </ol>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="typewriter position-absolute end-0 top-0 me-3">
                <p>Hello World!</p>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->

    <!-- Section-1 Start -->
    <section class="gen-section-padding-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="gen-style-1">
                        <div class="row">
                          @foreach ($videos as $video)
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="gen-carousel-movies-style-1 movie-grid style-1">
                                  <div class="gen-movie-contain">
                                      <div class="gen-movie-img">
                                          <?php
                                            $youtubeVideoID = [];
                                            if (!preg_match("/(\w|-|_){11}/", $video["video_url"], $youtubeVideoID)) {
                                                $youtubeVideoID = [""];
                                            }
                                            ?>
                                          <img
                                          src="{{ $video["thumbnail"] ? "/storage/" . $video['thumbnail'] : "https://i.ytimg.com/vi/" . $youtubeVideoID[0] . "/mqdefault.jpg"}}"
                                            alt="streamlab-image">

                                          <div class="gen-movie-action">
                                              <a href="/video/{{ $video->slug }}" class="gen-button">
                                                  <i class="fa fa-play"></i>
                                              </a>
                                          </div>
                                      </div>
                                      <div class="gen-info-contain">
                                          <div class="gen-movie-info lh-1">
                                              <h3 class="shadow"><a href="/video/{{ $video->slug }}">{{ $video->title }}</a></h3>
                                              <small class="text-warning lh-1 shadow">
                                                  @foreach (explode(",", $video["tags"]) as $tag)
                                                    <a href="/tag/{{ $tag }}" class="badge me-1 rounded bg-warning text-dark">{{ $tag }}</a>
                                                @endforeach</small>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="gen-pagination">
                        <nav aria-label="Page navigation">
                            {{ $videos->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section-1 End -->

    <!-- Back-to-Top start -->
    {{-- <div id="back-to-top">
        <a class="top" id="top" href="#top"> <i class="ion-ios-arrow-up"></i> </a>
    </div> --}}
    <!-- Back-to-Top end -->
    @endsection
