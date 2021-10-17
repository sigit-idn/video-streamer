@extends('templates.front-end')

@section('main')

    <!-- breadcrumb -->
    <div class="gen-breadcrumb" style="background-image: url('images/background/asset-25.jpeg');">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav aria-label="breadcrumb">
                        <div class="gen-breadcrumb-title">
                            <h1>
                                Videos
                            </h1>
                        </div>
                        <div class="gen-breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i
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
                @if (isset($tag))
                <p>Showing Videos in tag "{{ $tag }}"</p>
                @else
                <p>Search Results</p>
                @endif
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="gen-style-1">
                        <div class="row">
                        @if (!count($videos))
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            No Search Result
                        </div>

                        @else

                          @foreach ($videos as $video)
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="gen-carousel-movies-style-1 movie-grid style-1">
                                  <div class="gen-movie-contain">
                                      <div class="gen-movie-img">
                                          <?php
                                            $youtubeVideoID = [];
                                            preg_match("/(\w|-|_){11}/", $video["video_url"], $youtubeVideoID)
                                            ?>
                                          <img
                                          src="{{ $video["thumbnail"]
                                            ? "/storage/" . $video['thumbnail']
                                            : "https://i.ytimg.com/vi/" . $youtubeVideoID[0] . "/mqdefault.jpg"}}"
                                            alt="streamlab-image">
                                          <div class="gen-movie-add">
                                              <div class="wpulike wpulike-heart">
                                                  <div class="wp_ulike_general_class wp_ulike_is_not_liked">
                                                      <button type="button"
                                                          class="wp_ulike_btn wp_ulike_put_image"></button>
                                                  </div>
                                              </div>
                                              <ul class="menu bottomRight">
                                                  <li class="share top">
                                                      <i class="fa fa-share-alt"></i>
                                                      <ul class="submenu">
                                                          <li><a href="#" class="facebook"><i
                                                                      class="fab fa-facebook-f"></i></a>
                                                          </li>
                                                          <li><a href="#" class="facebook"><i
                                                                      class="fab fa-instagram"></i></a>
                                                          </li>
                                                          <li><a href="#" class="facebook"><i
                                                                      class="fab fa-twitter"></i></a></li>
                                                      </ul>
                                                  </li>
                                              </ul>
                                              <div class="movie-actions--link_add-to-playlist dropdown">
                                                  <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                          class="fa fa-plus"></i></a>
                                                  <div class="dropdown-menu mCustomScrollbar">
                                                      <div class="mCustomScrollBox">
                                                          <div class="mCSB_container">
                                                              <a class="login-link" href="/login">Sign in to add this
                                                                  movie to a
                                                                  playlist.</a>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="gen-movie-action">
                                              <a href="/video/{{ $video->slug }}" class="gen-button">
                                                  <i class="fa fa-play"></i>
                                              </a>
                                          </div>
                                      </div>
                                      <div class="gen-info-contain">
                                          <div class="gen-movie-info">
                                              <h3><a href="/video/{{ $video->slug }}">{{ $video->title }}</a></h3>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="gen-pagination">
                        <nav aria-label="Page navigation">
                            {{ $videos->withQueryString()->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section-1 End -->

    <!-- Back-to-Top start -->
    <div id="back-to-top">
        <a class="top" id="top" href="#top"> <i class="ion-ios-arrow-up"></i> </a>
    </div>
    <!-- Back-to-Top end -->
    @endsection
