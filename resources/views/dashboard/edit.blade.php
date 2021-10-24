@extends('templates.dashboard')
@section('title')
    Edit a Video
@endsection
@section("dashboard-main")
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><span class="text-muted lead">Title: </span>{{ $video->title }}</h1>
      </div>

      <div class="table-responsive mt-3" id="csvTable">
        <form action="/dashboard/edit/{{ $video->slug }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("put")

        <div class="border-bottom mb-3">
          <div class="mb-3">
            <label for="video_url[0]" class="form-label">Mirror link 1:</label>
            <input class="form-control @error("video_url.0") is-invalid @enderror" name="video_url[0]" id="video_url[0]" value="{{ $video->video_url }}" placeholder="Insert URL" required>
          </div>
          <div class="mb-3">
            <label for="video_url[1]" class="form-label">Mirror link 2:</label>
            <input class="form-control @error("video_url.1") is-invalid @enderror" name="video_url[1]" id="video_url[1]" value="{{ $video->video_url_2 }}" placeholder="(Optional) Insert URL">
          </div>
          <div class="mb-3">
            <label for="video_url[2]" class="form-label">Mirror link 3:</label>
            <input class="form-control @error("video_url.2") is-invalid @enderror" name="video_url[2]" id="video_url[2]" value="{{ $video->video_url_3 }}" placeholder="(Optional) Insert URL">
          </div>
          <div class="mb-3">
            <label for="video_url[3]" class="form-label">Mirror link 4:</label>
            <input class="form-control @error("video_url.3") is-invalid @enderror" name="video_url[3]" id="video_url[3]" value="{{ $video->video_url_4 }}" placeholder="(Optional) Insert URL">
          </div>
          <div class="mb-3">
            <label for="video_url[4]" class="form-label">Mirror link 5:</label>
            <input class="form-control @error("video_url.4") is-invalid @enderror" name="video_url[4]" id="video_url[4]" value="{{ $video->video_url_5 }}" placeholder="(Optional) Insert URL">
          </div>
          <div class="mb-3 row">
            <div class="col-2 @if(!$video->thumbnail)
              d-none
            @endif">
            <input class="d-none" name="thumbnailPreview" value="{{ $video->thumbnail }}">
                <img type="text"
                src="/storage/{{ $video->thumbnail }}"
                class="img-fluid" alt="" id="thumbnailPreview">
              </div>
              <div class="col">
                  <label for="thumbnail" class="form-label">Upload Thumbnail</label>
                  <input class="form-control @error("thumbnail") is-invalid @enderror" type="file" name="thumbnail" id="thumbnail">
                  <button type="button" onclick="removeThumbnail()"
                  class="btn btn-outline-danger
                  @if (!$video->thumbnail)
                    d-none
                  @endif mt-1">
                  <i class="bi bi-trash"></i> Remove Uploaded Image</button>
              </div>
        </div>
          <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input class="form-control @error("title") is-invalid @enderror" name="title" id="title" placeholder="Insert title" value="{{ $video->title }}">
          </div>
          <div class="mb-3">
            <label for="tags" class="form-label">Tags
              @foreach (explode(",", $video->tags) as $tag)
			    <span class="badge bg-info text-light">{{ $tag }}</span>
              @endforeach
            </label>
            <textarea class="form-control" name="tags" id="tags" placeholder="Insert tags, separated by comma (',')">{{ $video->tags }}</textarea>
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description" placeholder="Insert Description">{{ $video->description }}</textarea>
          </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <h5>Clips</h5>
            <div>
           <button
            type="button"
            class="btn btn-warning position-relative me-3"
            id="resetViews"
            data-slug="{{ $video->slug }}"
            >
                <i class="bi bi-arrow-counterclockwise"></i> Reset Page Views
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="pageViews">
                    {{ $video->page_views }}
                    <span class="visually-hidden">Reset Page Views</span>
                </span>
                </button>
            </div>
        </div>
        <div>
          <table class="table table-striped table-sm mt-3">
            <thead>
              <tr>
                <th style="width: 5%; max-width: 130px" scope="col">No</th>
                <th style="width: 12%; max-width: 130px" scope="col">Start</th>
                <th style="width: 12%; max-width: 130px" scope="col">End</th>
                <th scope="col">Name</th>
                <th style="width:18%; max-width: 200px;" scope="col">Buy Here</th>
                <th style="width:12%; max-width: 130px;" scope="col">Action</th>
                <th style="width:12%; max-width: 130px;" scope="col">Button Clicks</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($video->chapters as $chapter)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td><input required pattern="\d{1,2}:\d{1,2}:\d{1,2}" class="form-control" name="start_pos[{{ $loop->index }}]" maxlength="8" value="{{ $chapter->start_pos }}"></td>
                <td><input required pattern="\d{1,2}:\d{1,2}:\d{1,2}" class="form-control" name="end_pos[{{ $loop->index }}]" maxlength="8" value="{{ $chapter->end_pos }}"></td>
                <td><textarea required name="chapter_name[{{ $loop->index }}]" class="form-control">{{ $chapter->chapter_name }}</textarea></td>
                <td>
                  <input pattern="http.+\..+" class="form-control" name="url[{{ $loop->index }}]" value="{{ $chapter->url }}"></td>
                </td>
                <td>
                  <a class="btn btn-outline-primary" onclick="insertRow(this)"> <i class="bi bi-plus"></i> </a>
                  <a class="btn btn-outline-danger ms-1" onclick="removeRow(this)"> <i class="bi bi-trash"></i> </a>
                </td>
                <td>
                    <div class="input-group">
                    <span class="form-control rounded-0 rounded-start bg-transparent" id="buttonClicks_{{ $loop->index }}">
                        {{ $chapter->button_clicks }}
                    </span>
                    <div>
                        <button
                        type="button"
                        class="btn btn-secondary rounded-0 rounded-end"
                        id="resetClicks_{{ $loop->index }}"
                        data-chapter-id="{{ $chapter->id }}"
                        >
                        Reset
                        </button>
                    </div>
                </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" class="text-center">
                        <a class="btn btn-outline-primary" onclick="insertRow()"> <i class="bi bi-plus"></i> Add Chapter</a>
                    </td>
                </tr>
            </tfoot>
          </table>
          </div>


        <div class="d-flex justify-content-end align-items-center">
          <button type="submit" class="btn ms-2 btn-primary">Submit</button>
        </div>
        </form>
        <div>

        </div>
      </div>

    <script src="/js/post.js"></script>
    <script src="/js/csv-handler.js"></script>
    @csrf
    <script>
        document.querySelectorAll('[id^=resetClicks]').forEach((resetClick, i) =>
        resetClick.onclick = () => {
            if (confirm("Are you sure to reset button Clicks?")) {
                fetch("/dashboard/reset-clicks/" + resetClick.dataset.chapterId,
                {
                    headers: {
                        "X-CSRF-Token": document.querySelector('[name=_token]').value
                    },
                    method: "put"
                })
                .then(() => document.querySelector(`#buttonClicks_${i}`).innerHTML = 0)
            }
        })
        document.querySelector('#resetViews').onclick = ({target}) => {
            if (confirm("Are you sure to reset page Views?")) {
                fetch("/dashboard/reset-views/" + target.dataset.slug,
                {
                    headers: {
                        "X-CSRF-Token": document.querySelector('[name=_token]').value
                    },
                    method: "put"
                })
                .then(() => document.querySelector('#pageViews').innerHTML = 0)
            }
        }
    </script>
@endsection
