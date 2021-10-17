@extends('templates.front-end')

@section("meta")
    <meta name="keywords" content="{{ $video["tags"] }}" >
@endsection

@section('main')

    <!--=========== Loader =============-->
    <div id="gen-loading">
        <div id="gen-loading-center">
            <img src="/images/logo-1.png" alt="loading">
        </div>
    </div>
    <!--=========== Loader =============-->

    <!-- Single Video Start -->
    <section class="gen-section-padding-3 gen-single-video">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="gen-video-holder">
                                <?php
                                    $youtubeVideoID = [];
                                    preg_match("/(\w|-|_){11}/", $video["video_url"], $youtubeVideoID);
                                ?>
                                @if (preg_match("/(<iframe|<embed)/", $video["video_url"]))
                                {!! $video["video_url"] !!}

                                @elseif (preg_match("/youtu/", $video["video_url"]))
                                <iframe id="videoPlayer" width="100%" height="550px" src="https://www.youtube.com/embed/{{ $youtubeVideoID[0] }}"
                                   frameborder="0"
                                   allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                   allowfullscreen>
                               </iframe>
                                @else

                                <video id="videoPlayer" src="{{ $video[video_url] }}" controls style="width: 100%" ></video>

                                @endif
                            </div>
                        </div>

                        <div class="gen-btn-container d-flex flex-wrap flex-md-nowrap justify-content-between w-100">
                            @if (count($video->chapters))
                            <a href="javascript:void(0)" class="gen-button p-1 pe-2 p-md-3 bg-dark"
                            onclick="document.querySelector('#chapters').classList.toggle('d-none')"
                            >Chapters</a>
                            @endif
                            <div class="d-flex justify-content-end flex-row-reverse" id="mirrorLinks">
                                <a class="gen-button p-1 pe-2 p-md-3 text-capitalize text-md-uppercase" href="javascript:void(0)" data-src="{{ $video["video_url"] }}">
                                    <span class="button-text">Mirror 1</span>
                                </a>
                                @for ($i = 2; $i <= 5; $i++)
                                @if ($video["video_url_$i"])
                                <a class="gen-button p-1 pe-2 p-md-3 text-capitalize text-md-uppercase" href="javascript:void(0)" data-src="{{ $video["video_url_$i"] }}">
                                    <span class="button-text">Mirror {{ $i }}</span>
                                </a>
                                @endif
                                @endfor
                            </div>
                        </div>

                        <ul class="list-group d-none overflow-scroll px-2" style="height: 40vh" id="chapters">
                            <li class="list-group-item bg-dark text-white border-bottom mb-2"><h3>Chapters</h3></li>
                            @foreach ($video->chapters as $chapter)
                            <li class="list-group-item bg-dark text-white mb-1">
                                <span class="text-warning">{{ $chapter["start_pos"] }} - {{ $chapter["end_pos"] }}</span>
                                <p class="mb-1">{{ $chapter["chapter_name"] }}</p>
                                <a href="{{ $chapter["url"] }}">{{ $chapter["url"] }}</a>
                            </li>
                            @endforeach
                        </ul>

                        <div class="w-100 overflow-scroll">
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
                                            <li>
                                                <a href="#"><span>{{ $video['category'] }}</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <p>
                                        <h3 class="lead" id="videoDescription">
                                            {{ $video["description"] }}
                                        </h3>
                                    </p>
                                    @if (strlen($video["description"]) > 200)
                                    <a href="javascript:void(0)" id="descriptionToggle">Show more...</a>
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
                                                        preg_match("/(\w|-|_){11}/", $video["video_url"], $youtubeVideoID)
                                                        ?>
                                                      <img
                                                      src="{{ $video["thumbnail"]
                                                        ? "/storage/" . $video['thumbnail']
                                                        : "https://i.ytimg.com/vi/" . $youtubeVideoID[0] . "/mqdefault.jpg"}}"
                                                        alt="streamlab-image">
                                                      <div class="gen-movie-action">
                                                          <a href="/video/{{ $video->slug }}" class="gen-button">
                                                              <i class="fa fa-play"></i>
                                                          </a>
                                                      </div>
                                                  </div>
                                                  <div class="gen-info-contain">
                                                      <div class="gen-movie-info">
                                                          <h3 class="shadow"><a href="/video/{{ $video->slug }}">{{ $video->title }}</a></h3>
                                                          <small class="text-warning shadow">{{ count($video->chapters) }} Chapter{{ count($video->chapters) > 1 ? "s" : ''  }}</small>
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
    <div id="back-to-top">
        <a class="top" id="top" href="#top"> <i class="ion-ios-arrow-up"></i> </a>
    </div>
    <!-- Back-to-Top end -->

    <script>
        const videoPlayer = document.querySelector("#videoPlayer");
        document.querySelectorAll('#mirrorLinks a').forEach(link =>
            link.addEventListener('click', ({target}) => {

                if (/(<iframe|<embed)/.test(target.dataset.src)) {
                    videoPlayer.outerHTML = target.dataset.src
                    `

                if (/youtu/.test(target.dataset.src)) {
                    videoPlayer.outerHTML = `
                <iframe id="videoPlayer" width="100%" height="550px" src="https://www.youtube.com/embed/${target.dataset.src.match(/(\w|-|_){11}/)[0]}"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
                    `
                } else {
                    videoPlayer.outerHTML = `
                    <video id="videoPlayer" src="${ target.dataset.src }" controls style="width: 100%" >
                    `
                }
            }
            )
        )

        const videoDescription = document.querySelector('#videoDescription');
        const excerpt = videoDescription.innerHTML.slice(0, 200) + "...";
        const description = videoDescription.innerHTML;
        videoDescription.innerHTML = excerpt
        let isMore = true
        document.querySelector("#descriptionToggle").addEventListener("click", ({target}) => {
            isMore = !isMore
            target.innerHTML = "Show " + (isMore ? "more..." : "less...")
            videoDescription.innerHTML = !isMore ? description : excerpt

        })

        function onPlayerReady(event) {
            return console.log(event)
                event.target.playVideo();

                /// Time tracking starting here

                var lastTime = -1;
                var interval = 1000;

                var checkPlayerTime = function () {
                    if (lastTime != -1) {
                        if(player.getPlayerState() == YT.PlayerState.PLAYING ) {
                            var t = player.getCurrentTime();

                            //console.log(Math.abs(t - lastTime -1));

                            ///expecting 1 second interval , with 500 ms margin
                            if (Math.abs(t - lastTime - 1) > 0.5) {
                                // there was a seek occuring
                                console.log("seek"); /// fire your event here !
                            }
                        }
                    }
                    lastTime = player.getCurrentTime();
                    setTimeout(checkPlayerTime, interval); /// repeat function call in 1 second
                }
                setTimeout(checkPlayerTime, interval); /// initial call delayed
            }
            function onPlayerStateChange(event) {

            }

    </script>

@endsection
