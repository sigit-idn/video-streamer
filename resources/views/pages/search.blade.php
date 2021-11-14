@extends('templates.front-end')

@section('main')
    <?php
    $youtubeVideoID = [];
    $headerImage = '';
    if (count($videos)) {
        if (count($videos[0]->mirrors)) {
            $headerVideo['video_url'] = $videos[0]->mirrors[0]['video_url'];
        }
    
        if (!preg_match('/(\w|-|_){11}/', $videos[0]['video_url'], $youtubeVideoID)) {
            $youtubeVideoID[0] = '';
        }
    
        $headerImage = $videos[0]['thumbnail'] ? '/storage/' . $videos[0]['thumbnail'] : 'https://i.ytimg.com/vi/' . $youtubeVideoID[0] . '/mqdefault.jpg';
    }
    ?>
    <!-- breadcrumb -->
    <div class="gen-breadcrumb" style="background-image: url('{{ $headerImage }}');">
        <div class="container position-relative">
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
                                <li class="breadcrumb-item"><a href="/"><i class="fas fa-home mr-2"></i>Home</a></li>
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
                <div class="d-flex align-items-center">Found {{ $videos->count() }} results for "{{ $tag ?? $search }}"
                    by
                    <form action="/search" class="d-flex">
                        <input type="hidden" name="s" value="{{ $search ?? '' }}">
                        <select name="by" id="searchBy" class="bg-transparent border-0 text-danger">
                            <option value="all">all</option>
                            <option value="title">title</option>
                            <option value="tags">tags</option>
                            <option value="description">description</option>
                            <option value="clips">clips</option>
                        </select>
                    </form>
                </div>
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
                                                    if (count($video->mirrors)) {
                                                        $video['video_url'] = str_replace('ifrome', 'iframe', $video->mirrors[0]['video_url']);
                                                    }
                                                    preg_match('/(\w|-|_){11}/', $video['video_url'], $youtubeVideoID);
                                                    ?>
                                                    <a href="/video/{{ $video->slug }}">
                                                        <img src="{{ $video['thumbnail'] ? '/storage/' . $video['thumbnail'] : (preg_match('/youtu/', $video['video_url']) ? 'https://i.ytimg.com/vi/' . $youtubeVideoID[0] . '/mqdefault.jpg' : '/images/favicon.png') }}"
                                                            alt="{{ $video['title'] }}">
                                                    </a>
                                                    <div class="gen-movie-action">
                                                        <a href="/video/{{ $video->slug }}" class="gen-button">
                                                            <i class="fa fa-play"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="gen-info-contain">
                                                    <div class="gen-movie-info">
                                                        <h3><a href="/video/{{ $video->slug }}">{{ $video->title }}</a>
                                                        </h3>
                                                        <small class="text-warning lh-1 shadow">
                                                            @foreach (explode(',', $video['tags']) as $tag)
                                                                <a href="/tag/{{ $tag }}"
                                                                    class="badge me-1 rounded bg-warning text-dark">{{ $tag }}</a>
                                                            @endforeach
                                                        </small>
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
                            @if (method_exists($videos, 'withQueryString'))
                                {{ $videos->withQueryString()->links() }}
                            @elseif (method_exists($videos, "links"))
                                {{ $videos->links() }}
                            @endif
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

    <script>
        document.querySelectorAll("#searchBy option").forEach(option => {
            option.selected = option.value == window.location.href.match(/(?<=by=)\w+/)
        })
        document.querySelector("#searchBy").addEventListener('change', ({
                target
            }) =>
            target.parentElement.submit()
        )
    </script>
@endsection
