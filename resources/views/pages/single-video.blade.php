@extends('templates.front-end')

@section("meta")
    <meta name="keywords" content="{{ $video["tags"] }}" >
@endsection

@section('main')
<script>
function replaceTag(element){
    element.innerHTML = `<iframe width="100%" height="550px" allowfullscreen src="${element.src}" id="${element.id}">`
}
</script>

    <!--=========== Loader =============-->
    <div id="gen-loading">
        <div id="gen-loading-center">
            <img src="/images/logo-1.png" alt="loading">
        </div>
    </div>
    <!--=========== Loader =============-->

    <!-- Single Video Start -->
    <section class="gen-section-padding-3 gen-single-video mt-5">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="gen-video-holder" id="videoPlayer">
                                <?php
                                if(count($video->mirrors))
                                    $video["video_url"] = str_replace("ifrome", "iframe", $video->mirrors[0]["video_url"]);

                                    $youtubeVideoID = [];
                                    preg_match("/(\w|-|_){11}/", $video["video_url"], $youtubeVideoID);

                                    $vimeoVideoID = [];
                                    preg_match("/\d{9}/", $video["video_url"], $vimeoVideoID);
                                ?>
                                @if (preg_match("/<iframe|<embed|<video/", $video["video_url"]))
                                {!! $video["video_url"] !!}

                                @elseif (preg_match("/youtu/", $video["video_url"]))
                                <iframe allowfullscreen width="100%" height="550px" src="https://www.youtube.com/embed/{{ $youtubeVideoID[0] }}">
                               </iframe>
                               @elseif (preg_match("/embed|play/", $video["video_url"]))
                               <iframe allowfullscreen width="100%" height="550px" src="{{ $video["video_url"] }}">
                            </iframe>
                            @elseif (preg_match("/vimeo/", $video["video_url"]))
                            <iframe allowfullscreen width="100%" height="550px" src="https://player.vimeo.com/video/{{ $vimeoVideoID[0] }}">
                           </iframe>
                            @else
                            <video onerror="replaceTag(this)" src="{{ $video["video_url"] }}" controls style="width: 100%" ></video>
                            @endif
                            </div>
                        </div>

                        <div class="flex justify-content-end">
                            <div class="d-flex flex-row-reverse w-100" id="mirrorLinks">
                                @foreach ($video->mirrors as $mirror)

                                @if ($mirror)
                                <a
                                class="gen-button p-1 pe-2 p-md-3 text-capitalize text-md-uppercase"
                                href="javascript:void(0)"
                                data-src="{{ str_replace("ifrome", "iframe", $mirror["video_url"]) }}">
                                    <span class="button-text">{{ $mirror["video_label"] }}</span>
                                </a>
                                @endif

                                @endforeach
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="single-video">
                                <div class="gen-single-video-info">
                                    <h2 class="gen-title">{{ $video['title'] }}</h2>
                                    <div class="gen-single-meta-holder">
                                        <ul>
                                            @if ($video["tags"])
                                            <li>Tags:
                                                @foreach (explode(",", $video["tags"]) as $tag)
                                                <a href="/tag/{{ $tag }}" class="badge ms-2 rounded bg-info text-dark">{{ $tag }}</a>
                                                @endforeach
                                            </li>
                                            @endif
                                            {{-- <li>
                                                <a href="#"><span>{{ $video['category'] }}</span></a>
                                            </li> --}}
                                        </ul>
                                    </div>
                                    <p>
                                        <h3 class="fs-6 lh-base fw-normal" id="videoDescription">
                                            {!! $video["description"] !!}
                                        </h3>
                                    </p>
                                    @if (strlen($video["description"]) > 200)
                                    <a href="javascript:void(0)" id="descriptionToggle">Show more...</a>
                                    @endif

                                    @if (count($video->chapters))
                                    <div class="bg-dark text-white border-bottom d-flex py-2 px-3 justify-content-between me-2 align-items-center">
                                        <h3 class="lead">Clips Detail</h3>
                                        <a href="javascript:void(0)" onclick="
                                            document.getElementById('clips').classList.toggle('d-none')
                                        ">hide/show</a>
                                    </div>
                                    <ul class="list-group overflow-scroll pe-2" id="clips" style="height: 40vh" id="chapters">
                                        @foreach ($video->chapters as $chapter)
                                        <li class="list-group-item bg-dark text-white mb-1">
                                            <div class="text-warning d-flex justify-content-between align-self-center">
                                                <span>{{ $chapter["start_pos"] }} - {{ $chapter["end_pos"] }}</span>
                                                @if ($chapter["url"])
                                                <a class="gen-button py-1 px-2 text-nowrap d-flex flex-nowrap"
                                                href="{{ $chapter["url"] }}"
                                                id="buyButton[{{ $loop->index }}]"
                                                data-chapter-id="{{ $chapter["id"] }}"
                                                target="_blank"
                                                >Buy Now</a>
                                                @endif
                                            </div>
                                            <p class="mb-1">{{ $chapter["chapter_name"] }}</p>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="pm-inner">
                                <div class="gen-more-like">
                                    <h5 class="gen-more-title">More Like This</h5>
                                    <div class="row post-loadmore-wrapper">
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
                                                     <a href="/video/{{ $video->slug }}">
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
                                                     </a>
                                                      <div class="gen-movie-action">
                                                          <a href="/video/{{ $video->slug }}" class="gen-button">
                                                              <i class="fa fa-play"></i>
                                                          </a>
                                                      </div>
                                                  </div>
                                                  <div class="gen-info-contain">
                                                      <div class="gen-movie-info">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Single Video End -->

    <!-- Back-to-Top start -->
    {{-- <div id="back-to-top">
        <a class="top" id="top" href="#top"> <i class="ion-ios-arrow-up"></i> </a>
    </div> --}}
    <!-- Back-to-Top end -->

        @csrf
    <script src="/js/single-page.js"></script>

@endsection
