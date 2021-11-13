@extends('templates.dashboard')
@section('title')
    Edit a Video
@endsection
@section("dashboard-main")
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><span class="text-muted lead">Title: </span>{{ $video->title }}</h1>
      </div>

      <div class="table-responsive mt-3" id="csvTable">
        <form id="editForm" action="/dashboard/edit/{{ $video->slug }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("put")

        <div class="border-bottom mb-3">
          <div class="mb-3">
            <input id="video_label[0]" name="video_label[0]" class="form-label border-0 mb-1 outline-0" value="{{ str_replace("ifrome", "iframe", $video->mirrors[4]["video_label"] ?? "Mirror 1" ) }}"><label class="btn badge bg-secondary" for="video_label[0]">Edit label</label>
            <input class="form-control @error("video_url.0") is-invalid @enderror" name="video_url[0]" id="video_url[0]" value="{{ str_replace("ifrome", "iframe", $video->mirrors[0]["video_url"]) }}" placeholder="Insert URL" required>
          </div>
          <div class="mb-3">
            <input id="video_label[1]" name="video_label[1]" class="form-label border-0 mb-1 outline-0" value="{{ str_replace("ifrome", "iframe", $video->mirrors[4]["video_label"] ?? "Mirror 2" ) }}"><label class="btn badge bg-secondary" for="video_label[1]">Edit label</label>
            <input class="form-control @error("video_url.1") is-invalid @enderror" name="video_url[1]" id="video_url[1]" value="{{ str_replace("ifrome", "iframe", $video->mirrors[1]["video_url"]) }}" placeholder="(Optional) Insert URL">
          </div>
          <div class="mb-3">
            <input id="video_label[2]" name="video_label[2]" class="form-label border-0 mb-1 outline-0" value="{{ str_replace("ifrome", "iframe", $video->mirrors[4]["video_label"] ?? "Mirror 3" ) }}"><label class="btn badge bg-secondary" for="video_label[2]">Edit label</label>
            <input class="form-control @error("video_url.2") is-invalid @enderror" name="video_url[2]" id="video_url[2]" value="{{ str_replace("ifrome", "iframe", $video->mirrors[2]["video_url"]) }}" placeholder="(Optional) Insert URL">
          </div>
          <div class="mb-3">
            <input id="video_label[3]" name="video_label[3]" class="form-label border-0 mb-1 outline-0" value="{{ str_replace("ifrome", "iframe", $video->mirrors[4]["video_label"] ?? "Mirror 4" ) }}"><label class="btn badge bg-secondary" for="video_label[3]">Edit label</label>
            <input class="form-control @error("video_url.3") is-invalid @enderror" name="video_url[3]" id="video_url[3]" value="{{ str_replace("ifrome", "iframe", $video->mirrors[3]["video_url"] ?? "" ) }}" placeholder="(Optional) Insert URL">
          </div>
          <div class="mb-3">
            <input id="video_label[4]" name="video_label[4]" class="form-label border-0 mb-1 outline-0" value="{{ str_replace("ifrome", "iframe", $video->mirrors[4]["video_label"] ?? "Mirror 5" ) }}"><label class="btn badge bg-secondary" for="video_label[4]">Edit label</label>
            <input class="form-control @error("video_url.4") is-invalid @enderror" name="video_url[4]" id="video_url[4]" value="{{ str_replace("ifrome", "iframe", $video->mirrors[4]["video_url"] ?? "" ) }}" placeholder="(Optional) Insert URL">
          </div>
          <div class="mb-3">
            <input name="video_label[5]" id="video_label[5]" class="form-label border-0 mb-1 outline-0" value="{{ str_replace("ifrome", "iframe", $video->mirrors[4]["video_label"] ?? "Mirror 6" ) }}"><label class="btn badge bg-secondary" for="video_label[5]">Edit label</label>
            <input pattern=".*http.+\..+" class="form-control @error("video_url.5") is-invalid @enderror" name="video_url[5]" value="{{ str_replace("ifrome", "iframe", $video->mirrors[5]["video_url"] ?? "" ) }}" id="video_url[5]" placeholder="(Optional) Insert URL">
            @error("video_url.5")
          <p class="invalid-feedback">{{ $message }}</p>
            @enderror
          </div>
          <div class="mb-3">
            <input name="video_label[6]" id="video_label[6]" class="form-label border-0 mb-1 outline-0" value="{{ str_replace("ifrome", "iframe", $video->mirrors[4]["video_label"] ?? "Mirror 7" ) }}"><label class="btn badge bg-secondary" for="video_label[6]">Edit label</label>
            <input pattern=".*http.+\..+" class="form-control @error("video_url.6") is-invalid @enderror" name="video_url[6]" value="{{ str_replace("ifrome", "iframe", $video->mirrors[6]["video_url"] ?? "" ) }}" id="video_url[6]" placeholder="(Optional) Insert URL">
            @error("video_url.6")
          <p class="invalid-feedback">{{ $message }}</p>
            @enderror
          </div>
          <div class="mb-3">
            <input name="video_label[7]" id="video_label[7]" class="form-label border-0 mb-1 outline-0" value="{{ str_replace("ifrome", "iframe", $video->mirrors[4]["video_label"] ?? "Mirror 8" ) }}"><label class="btn badge bg-secondary" for="video_label[7]">Edit label</label>
            <input pattern=".*http.+\..+" class="form-control @error("video_url.7") is-invalid @enderror" name="video_url[7]" value="{{ str_replace("ifrome", "iframe", $video->mirrors[7]["video_url"] ?? "" ) }}" id="video_url[7]" placeholder="(Optional) Insert URL">
            @error("video_url.7")
          <p class="invalid-feedback">{{ $message }}</p>
            @enderror
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
document.querySelectorAll("[id^=resetClicks]").forEach(
  (resetClick, i) =>
    (resetClick.onclick = () => {
      if (confirm("Are you sure to reset button Clicks?")) {
        fetch("/dashboard/reset-clicks/" + resetClick.dataset.chapterId, {
          headers: {
            "X-CSRF-Token": document.querySelector("[name=_token]").value,
          },
          method: "put",
        }).then(
          () => (document.querySelector(`#buttonClicks_${i}`).innerHTML = 0)
        );
      }
    })
);
document.querySelector("#resetViews").onclick = ({ target }) => {
  if (confirm("Are you sure to reset page Views?")) {
    fetch("/dashboard/reset-views/" + target.dataset.slug, {
      headers: {
        "X-CSRF-Token": document.querySelector("[name=_token]").value,
      },
      method: "put",
    }).then(() => (document.querySelector("#pageViews").innerHTML = 0));
  }
};

document
  .querySelector("#editForm")
  .addEventListener("submit", ({ target }) =>
    target
      .querySelectorAll("input")
      .forEach(
        (input) => (input.value = input.value.replace(/iframe/g, "ifrome"))
      )
  );

    </script>
@endsection
