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
    if ($videos[0]) {
        $headerVideo = $videos[0];
        $headerYoutubeVideoID = [];
        if (!preg_match("/(\w|-|_){11}/", $headerVideo["video_url"], $headerYoutubeVideoID)) {
            $headerYoutubeVideoID = [""];
        };
    } else {
        $headerVideo["thumbnail"] = "";
        $headerYoutubeVideoID = [""];
    }
    ?>

        <div class="gen-breadcrumb" style="background-image: url('{{$headerVideo["thumbnail"] ? "/storage/"
    . $headerVideo['thumbnail']
    : "https://i.ytimg.com/vi/"
    . $headerYoutubeVideoID[0]
    . "/mqdefault.jpg"}}');">
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
                                    <a href="/video/{{ $video->slug }}">
                                  <div class="gen-movie-contain">
                                      <div class="gen-movie-img">
                                          <?php
                                          $video["video_url"] = str_replace("ifrome", "iframe", $video["video_url"]);
                                          $video["video_url_2"] = str_replace("ifrome", "iframe", $video["video_url_2"]);
                                          $video["video_url_3"] = str_replace("ifrome", "iframe", $video["video_url_3"]);
                                          $video["video_url_4"] = str_replace("ifrome", "iframe", $video["video_url_4"]);
                                          $video["video_url_5"] = str_replace("ifrome", "iframe", $video["video_url_5"]);
                                            $youtubeVideoID = [];
                                            if (!preg_match("/(\w|-|_){11}/", $video["video_url"], $youtubeVideoID)) {
                                                $youtubeVideoID = [""];
                                            }
                                            ?>
                                            <img
                                            src="{{ $video["thumbnail"]
                                            ? "/storage/"
                                            . $video['thumbnail']
                                            : (
                                                preg_match("/youtu/", $video["video_url"]) ?
                                                "https://i.ytimg.com/vi/" . $youtubeVideoID[0] . "/mqdefault.jpg"
                                                : "/images/favicon.png"
                                                )}}"
                                            alt="{{ $video["title"] }}">

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
                                    </a>
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
