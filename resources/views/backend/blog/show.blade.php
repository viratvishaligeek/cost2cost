@extends('backend.include.layout')
@section('content')
    <h2 class="mb-4">{{ $pageName }}</h2>
    <div class="row mb-3">
        <div class="col-xl-9">
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-floating">
                        <input class="form-control" disabled required value="{{ $data->name }}" type="text"
                            placeholder="Name" />
                        <label>Name</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class=" border-2">
                        {!! $data->description !!}
                    </div>
                </div>
                <style>
                    .tag-container {
                        display: flex;
                        flex-wrap: wrap;
                        border: 1px solid #ccc;
                        padding: 5px;
                        width: 300px;
                    }

                    .tag {
                        background: #007bff;
                        color: white;
                        padding: 5px 10px;
                        margin: 3px;
                        border-radius: 15px;
                        display: flex;
                        align-items: center;
                    }

                    .tag span {
                        margin-left: 8px;
                        cursor: pointer;
                    }

                    input {
                        border: none;
                        outline: none;
                        flex: 1;
                        padding: 5px;
                    }
                </style>
                <div class="col-12">
                    <div class="form-floating">
                        <div class="form-control d-flex flex-wrap gap-2" id="tagBox" style="min-height: 65px">
                            <p id="tagInput"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-floating">
                        <input type="date" class="form-control" disabled required
                            value="{{ $data->publish_date ?? date('Y-m-d') }}" />
                        <label>Publish Date</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" disabled value="{{ $data->category->name }}">
                        <label>Category</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" disabled value="{{ $data->author->name }}">
                        <label>Author</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" disabled value="{{ $data->publisher->name }}">
                        <label>Publisher</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" disabled value="{{ $data->status }}">
                        <label>Status</label>
                    </div>
                </div>
                <div class="col-12" id="featured_holder">
                    <a href="{{ $data->featured_image }}" target="_blank">
                        <img src="{{ $data->featured_image }}" width="100%" alt="">
                    </a>
                </div>
                <div class="col-12 text-end">
                    <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </div>
    @endsection
    @section('script')
        <script>
            $(document).ready(function() {
                let oldTags = "{{ $data->tags }}";
                let tags = oldTags ? oldTags.split(',') : [];

                function renderTags() {
                    $("#tagBox .badge").remove();
                    tags.forEach(function(value) {
                        let tag = $(`
                <span class="badge bg-primary d-flex align-items-center" style="padding:6px 10px;">
                ${value}
                </span>
            `);
                        $("#tagInput").before(tag);
                    });
                    updateHidden();
                }
                renderTags();

                function updateHidden() {
                    $("#hiddenTags").val(tags.join(","));
                }
            });
        </script>
    @endsection
