@extends('templates.dashboard')
@section('title')
    Post a Video
@endsection
@section('dashboard-main')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 step-1">Step 1: Create Chapters</h1>
        <h1 class="h2 step-2 d-none">Step 2: Create Video Detail</h1>
    </div>

    <div class="step-1">
        <h5>Upload CSV File</h5>
        <form id="uploadCsv" class="d-flex">
            <input type="file" class="form-control rounded-0" id="csvFile">
            <button type="submit" class="btn rounded-0 rounded-end btn-primary">Upload</button>
        </form>
        {{-- <p class="text-muted mt-1">Don't have CSV File? <a href="">Download Template</a></p> --}}
    </div>

    <div class="table-responsive mt-3">
        <form action="/dashboard/post" method="post" enctype="multipart/form-data" id="postForm">
            @csrf

            <div class="step-1">
                <table class="table table-striped table-sm" id="csvTable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th style="width: 12%; max-width: 130px" scope="col">Start</th>
                            <th style="width: 12%; max-width: 130px" scope="col">End</th>
                            <th scope="col">Name</th>
                            <th style="width:18%; max-width: 200px;" scope="col">Buy Here</th>
                            <th style="width:18%; max-width: 200px;" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" class="text-center">
                                <a class="btn btn-outline-primary" onclick="insertRow()"> <i class="bi bi-plus"></i> Add
                                    Chapter</a>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="step-2 d-none">
                <div class="mb-3">
                    <input name="video_label[0]" id="video_label[0]" class="form-label border-0 mb-1 outline-0"
                        value="Mirror 1"><label class="btn badge bg-secondary" for="video_label[0]">Edit label</label>
                    <input data-required pattern=".*http.+\..+"
                        class="form-control @error('video_url.0') is-invalid @enderror" name="video_url[0]"
                        value="{{ old('video_url.0') }}" id="video_url[0]" placeholder="Insert URL">
                    @error('video_url.0')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <input name="video_label[1]" id="video_label[1]" class="form-label border-0 mb-1 outline-0"
                        value="Mirror 2"><label class="btn badge bg-secondary" for="video_label[1]">Edit label</label>
                    <input pattern=".*http.+\..+" class="form-control @error('video_url.1') is-invalid @enderror"
                        name="video_url[1]" value="{{ old('video_url.1') }}" id="video_url[1]"
                        placeholder="(Optional) Insert URL">
                    @error('video_url.1')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <input name="video_label[2]" id="video_label[2]" class="form-label border-0 mb-1 outline-0"
                        value="Mirror 3"><label class="btn badge bg-secondary" for="video_label[2]">Edit label</label>
                    <input pattern=".*http.+\..+" class="form-control @error('video_url.2') is-invalid @enderror"
                        name="video_url[2]" value="{{ old('video_url.2') }}" id="video_url[2]"
                        placeholder="(Optional) Insert URL">
                    @error('video_url.2')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <input name="video_label[3]" id="video_label[3]" class="form-label border-0 mb-1 outline-0"
                        value="Mirror 4"><label class="btn badge bg-secondary" for="video_label[3]">Edit label</label>
                    <input pattern=".*http.+\..+" class="form-control @error('video_url.3') is-invalid @enderror"
                        name="video_url[3]" value="{{ old('video_url.3') }}" id="video_url[3]"
                        placeholder="(Optional) Insert URL">
                    @error('video_url.3')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <input name="video_label[4]" id="video_label[4]" class="form-label border-0 mb-1 outline-0"
                        value="Mirror 5"><label class="btn badge bg-secondary" for="video_label[4]">Edit label</label>
                    <input pattern=".*http.+\..+" class="form-control @error('video_url.4') is-invalid @enderror"
                        name="video_url[4]" value="{{ old('video_url.4') }}" id="video_url[4]"
                        placeholder="(Optional) Insert URL">
                    @error('video_url.4')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <input name="video_label[5]" id="video_label[5]" class="form-label border-0 mb-1 outline-0"
                        value="Mirror 6"><label class="btn badge bg-secondary" for="video_label[5]">Edit label</label>
                    <input pattern=".*http.+\..+" class="form-control @error('video_url.5') is-invalid @enderror"
                        name="video_url[5]" value="{{ old('video_url.5') }}" id="video_url[5]"
                        placeholder="(Optional) Insert URL">
                    @error('video_url.5')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <input name="video_label[6]" id="video_label[6]" class="form-label border-0 mb-1 outline-0"
                        value="Mirror 7"><label class="btn badge bg-secondary" for="video_label[6]">Edit label</label>
                    <input pattern=".*http.+\..+" class="form-control @error('video_url.6') is-invalid @enderror"
                        name="video_url[6]" value="{{ old('video_url.6') }}" id="video_url[6]"
                        placeholder="(Optional) Insert URL">
                    @error('video_url.6')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <input name="video_label[7]" id="video_label[7]" class="form-label border-0 mb-1 outline-0"
                        value="Mirror 8"><label class="btn badge bg-secondary" for="video_label[7]">Edit label</label>
                    <input pattern=".*http.+\..+" class="form-control @error('video_url.7') is-invalid @enderror"
                        name="video_url[7]" value="{{ old('video_url.7') }}" id="video_url[7]"
                        placeholder="(Optional) Insert URL">
                    @error('video_url.7')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3 row">
                    <div class="col-2 d-none">
                        <img src="" class="img-fluid" alt="" id="thumbnailPreview">
                    </div>
                    <div class="col">
                        <label for="thumbnail" class="form-label">Upload Thumbnail</label>
                        <input class="form-control  @error('thumbnail') is-invalid @enderror" type="file" name="thumbnail"
                            id="thumbnail">
                        @error('thumbnail')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                        <button type="button" onclick="removeThumbnail()" class="btn btn-outline-danger d-none mt-1"><i
                                class="bi bi-trash"></i> Remove Uploaded Image</button>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input data-required class="form-control @error('title') is-invalid @enderror" name="title"
                        value="{{ old('title') }}" id="title" placeholder="Insert title">
                    @error('title')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tags" class="form-label">Tags</label>
                    <textarea class="form-control @error('tags') is-invalid @enderror" name="tags"
                        value="{{ old('tags') }}" id="tags"
                        placeholder="Insert tags, separated by comma (',')"></textarea>
                    @error('tags')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                        id="description" placeholder="Insert Description">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end align-items-center">
                <a href="" id="stepSwitcher">Continue</a>
                <button type="submit" class="step-2 btn ms-2 btn-primary d-none">Submit</button>
            </div>
        </form>
        <div>

        </div>
    </div>

    <script src="/js/dashboard.js"></script>
    <script src="/js/csv-handler.js"></script>
    <script src="/js/post.js"></script>

    <script>
        document
            .querySelector("#postForm")
            .addEventListener("submit", ({
                target
            }) => {
                target.querySelectorAll("input").forEach(input => input.value = input.value.replace(/iframe/g,
                    "ifrome"))
            });
    </script>
@endsection
