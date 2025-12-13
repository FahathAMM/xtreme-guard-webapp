@extends('layout.app')
@section('title', $title)
@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <div class="error-container" style="display:none;">
                <div class="alert alert-danger">
                    <h4>There were some problems with your input:</h4>
                    <ul class="error-list"></ul>
                </div>
            </div>

            <form id="solution-form" method="POST" action="{{ route('solution.update', ['solution' => $solution->id]) }}"
                autocomplete="off" class="needs-validation1" novalidate1 enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card mb-1">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <x-input.txt-group label="Solution Title" name="title"
                                                placeholder="Enter your Solution Title" value="{{ $solution->title }}" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card mb-1">
                            <div class="card-header align-items-center d-flex">
                                <h5 class="card-title mb-0 flex-grow-1">Banner Image</h5>
                                <button type="button" class="float-end add-more-img btn mb-2 fw-medium btn-soft-secondary">
                                    <i class="ri-add-fill me-1 align-bottom"></i>
                                    Add New
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="mt-3">
                                    <x-input.img-multiple name="banner_img" />
                                    {{-- <x-input.img name="banner_img" /> --}}
                                    <div class="invalid-feedbackd" id="img-valid"></div>
                                </div>
                                @if (!empty($solution->banner_img))
                                    <ul class="list-unstyled mb-0 mt-4" id="current-preview">
                                        @foreach ($solution->banner_img as $img)
                                            <li class="mt-2" id="current-preview-list">
                                                <div class="border rounded">
                                                    <div class="d-flex p-2">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatadr-sm bg-light rounded">
                                                                <img data-dz-thumbnail="" class="img-fluid rounded d-block"
                                                                    id="current-img-preview" alt="Product-Image"
                                                                    style="width: 125px;height: 50px;object-fit: contain;"
                                                                    src="{{ getImgUrl($img) }}">
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div class="pt-1"></div>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-3">
                                                            <a href="{{ url('admin/solution/delete-img/' . $img . '/' . $solution->id) }}"
                                                                id="removeImg" class="btn btn-sm btn-danger">
                                                                Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                            </div>
                        </div>

                        <div class="text-end mb-3">
                            <button type="button" onclick="store()" id="sbtBtn"
                                class="btn btn-success w-sm">Submit</button>
                        </div>
                    </div>

                    <div class="col-lg-4">

                        <div class="card mb-1">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Solution Type</h5>
                            </div>
                            <div class="card-body">
                                <div class="hstack gap-3 align-items-start">
                                    <div class="flex-grow-1">
                                        <x-input.select-group label="Solution Type" name="solution_type" itemText="name"
                                            itemValue="id" :items="$solutionTypes" value="{{ $solution->solution_type }}"
                                            data-choices-search-true />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-1">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Solution Tags</h5>
                            </div>
                            <div class="card-body">
                                <div class="hstack gap-3 align-items-start">
                                    <div class="flex-grow-1">
                                        <input class="form-control" name="tags" data-choices
                                            value="{{ implode(',', $solution->tags) }}" data-choices-multiple-remove="true"
                                            placeholder="Enter tags" type="text" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-1">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Product Short Description</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-2">Add short description for product</p>
                                <textarea class="form-control" name="desc" placeholder="Must enter minimum of a 100 characters" rows="10">{{ $solution->desc }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

        <script>
            $('document').ready(function() {});

            function store() {
                sLoading('sbtBtn')

                $('#new-content').html($('.ck-content').html());
                var form = document.getElementById('solution-form');
                var url = form.getAttribute('action');
                var method = form.getAttribute('method');
                var payload = new FormData(form);

                var profileImgInput = document.getElementById('selectImage');

                if (profileImgInput.files.length > 0) {
                    payload.append('img', profileImgInput.files[0]);
                }

                const options = {
                    // contentType: 'application/json',
                    contentType: 'multipart/form-data',
                    method: 'POST',
                    headers: {
                        dataType: "json",
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    }
                };
                sendData(
                    url,
                    payload,
                    options,
                    (response) => {
                        if (response.status) {
                            alertNotify(response.message, 'success')
                            // $("#product-form :input").val("");
                            associateErrors([], 'solution-form');
                            eLoading('sbtBtn')
                        } else {
                            associateErrors(response.errors, 'solution-form');
                            eLoading('sbtBtn')

                            // showErrorMsg(response);
                            console.log(response.errors['images']);
                        }
                    },
                    (error) => {
                        eLoading('sbtBtn')
                        console.error('Error:', error);
                    }
                );
            }

            function showErrorMsg(response) {
                // Clear previous errors
                $('.error-list').empty();

                // Loop through the errors and display them
                $.each(response.errors, function(key, messages) {
                    // Remove the trailing .0 from the key
                    let formattedKey = key.replace(/\.0$/, '');
                    formattedKey = formattedKey.replace('.', ' '); // Optional: Replace '.' with space

                    let errorHtml = `<li><strong>${formattedKey}:</strong><ul>`;
                    messages.forEach(function(message) {
                        errorHtml += `<li>${message}</li>`;
                    });
                    errorHtml += '</ul></li>';

                    $('.error-list').append(errorHtml);
                });

                // Show the error container (if hidden)
                $('.error-container').show();
            }
        </script>
    @endpush

    @push('styles')
        <style>
            .ck-editor__editable_inline {
                min-height: 500px !important;
                max-height: 500px !important;
                height: 500px !important;
                overflow-y: auto;
            }

            table.dataTable tr {
                border: 2px solid #dbdade;
            }

            table.dataTable {
                border-top: 1px solid #dbdade;
                border-right: 1px solid #dbdade;
                border-left: 1px solid #dbdade;
            }

            /* Style for the file input container */
            .file-input-container {
                position: relative;
                width: 200px;
                height: 100px;
                overflow: hidden;
                background-color: white;
                color: black;
                border-radius: 5px;
                cursor: pointer;
            }

            /* Style for the actual file input (opacity set to 0 to make it invisible) */
            .file-input-container input {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                opacity: 0;
                cursor: pointer;
            }

            /* Style for the text inside the file input container */
            .file-input-text {
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100%;
            }

            /* Style for the preview image */
            #preview {
                display: none;
                /* max-width: 100%; */
                /* height: auto; */
                border-radius: 5px;
                width: 100px;
                height: 50px;
            }

            .dropzone {
                min-height: 120px !important;
            }
        </style>
    @endpush
@endsection
