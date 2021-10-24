@extends('templates.dashboard')
@section('title')
    Dashboard
@endsection
@section("dashboard-main")
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Video List</h1>
      </div>

      @if (session("success"))
      <p class="alert alert-success alert-dismissable fade show" role="alert">{{ session("success") }}</p>
      @endif
      @if (session("fail"))
      <p class="alert alert-danger alert-dismissable fade show" role="alert">{{ session("fail") }}</p>
      @endif

      <div class="table-responsive mt-3" id="csvTable">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Thumbnail</th>
              <th scope="col">Video Title</th>
              <th scope="col">Video URL</th>
              <th scope="col">Clips</th>
              <th scope="col">Action</th>
              <th scope="col">View Count</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($videos as $video)
              <tr>

                <td>{{ $loop->iteration }}</td>
                <?php
                $youtubeVideoID = [];
                if (!preg_match("/(\w|-|_){11}/", $video["video_url"], $youtubeVideoID)) {
                    $youtubeVideoID = [""];
                }
                ?>

                <td><img src="
                    {{ $video["thumbnail"]
                    ? "/storage/" . $video['thumbnail']
                    : "https://i.ytimg.com/vi/" . $youtubeVideoID[0] . "/mqdefault.jpg"}}
                    " width="100"></td>
                <td>{{ $video["title"] }}</td>
                <td>{{ $video["video_url"] }}</td>
                <td>{{ count($video->chapters) }}</td>
                <td>
                    <div class="d-flex">
                        <a href="/dashboard/edit/{{ $video["slug"] }}" class="btn btn-outline-info me-1"><i class="bi bi-pencil-square"></i></a>
                        <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete-{{ $video->slug }}"><i class="bi bi-trash"></i></button>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                    <span class="form-control rounded-0 rounded-start bg-transparent" id="pageViews">
                        {{ $video->page_views }}
                    </span>
                    <div>
                        <button
                        type="button"
                        class="btn btn-secondary rounded-0 rounded-end"
                        id="resetViews"
                        data-slug="{{ $video->slug }}"
                        data-csrf-token="{{ csrf_token() }}"
                        >
                        Reset
                        </button>
                    </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    @foreach ($videos as $video)
    <div class="modal fade" id="delete-{{ $video->slug }}" tabindex="-1" aria-labelledby="delete-{{ $video->slug }}Label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="delete-{{ $video->slug }}Label">Delete Confirmation</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/dashboard/delete/{{ $video->slug }}" method="POST">
                @csrf
                @method("delete")
                <div class="modal-body">
                    Are you sure want to delete video '{{ $video->title }}'
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
          </div>
        </div>
      </div>
      @endforeach

      <script>
        document.querySelector('#resetViews').onclick = ({target}) => {
            if (confirm("Are you sure to reset page Views?")) {
                fetch("/dashboard/reset-views/" + target.dataset.slug,
                {
                    headers: {
                        "X-CSRF-Token": target.dataset.csrfToken
                    },
                    method: "put"
                })
                .then(() => document.querySelector('#pageViews').innerHTML = 0)
            }
        }
    </script>
@endsection

