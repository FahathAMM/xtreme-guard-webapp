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

            {{-- <x-breadcrumb title="products" parent="Page" /> --}}

            <form id="product-form" method="POST" action="{{ route('products.update', ['product' => $product->id]) }}"
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
                                            <x-input.txt-group label="Product Name" name="name"
                                                placeholder="Enter your Product name" value="{{ $product->name ?? '' }}" />
                                        </div>
                                    </div>

                                    <div>
                                        <x-input.ckeditor id="new-content" name="description"
                                            value="{{ $product->description ?? '' }}" />
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card mb-1">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Product Image</h5>
                            </div>
                            <div class="card-body">
                                <div class="mt-3">
                                    <x-input.img-multiple name="images" />
                                    <div class="invalid-feedbackd" id="img-valid"></div>
                                </div>

                                @if ($product->images)
                                    <ul class="list-unstyled mb-0 mt-4" id="current-preview">
                                        @foreach ($product->images as $img)
                                            <li class="mt-2" id="current-preview-list">
                                                <div class="border rounded">
                                                    <div class="d-flex p-2">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-sm bg-light rounded">
                                                                <img data-dz-thumbnail="" class="img-fluid rounded d-block"
                                                                    id="current-img-preview" alt="Product-Image"
                                                                    style="display: block;" src="{{ $img->image }}">
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div class="pt-1">

                                                            </div>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-3">
                                                            <a href="{{ url('admin/product/delete-img/' . $img->id) }}"
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

                        <div class="card mb-1">
                            <div class="card-header">
                                <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#addproduct-general-info"
                                            role="tab" aria-selected="true">
                                            Product Attributes
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#addproduct-metadata" role="tab"
                                            aria-selected="false" tabindex="-1">
                                            Product Attachment
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#addproduct-video" role="tab"
                                            aria-selected="false" tabindex="-1">
                                            Product Video
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active show" id="addproduct-general-info" role="tabpanel">
                                        <div class="table-responsivew">
                                            <p class="text-muted">
                                                <button type="button" id="newRow"
                                                    class="float-end add-row btn mb-2 fw-medium btn-soft-secondary">
                                                    <i class="ri-add-fill me-1 align-bottom"></i>
                                                    Add New
                                                </button>
                                            </p>
                                            <table class="invoice-table table table-borderless table-nowrap mb-0">
                                                <tbody id="newlink">
                                                    @foreach ($product->attributes as $attr)
                                                        <tr id="1" class="product">
                                                            <td class="text-start py-0 w-50">
                                                                <div class="mb-0">
                                                                    <x-input.txt-group name="attribute[]"
                                                                        placeholder="Enter your  attribute value"
                                                                        :value="$attr->key" />

                                                                </div>
                                                            </td>
                                                            <td class="py-0">
                                                                <div>
                                                                    <x-input.txt-group name="value[]"
                                                                        placeholder="Enter your  attribute value"
                                                                        :value="$attr->value" />
                                                                </div>
                                                            </td>
                                                            <td class="product-removal py-0">
                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-danger remove-row">
                                                                    <i class="ri-delete-bin-5-line"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="addproduct-metadata" role="tabpanel">
                                        <div class="table-responsivew">
                                            <p class="text-muted">
                                                <button type="button" id="attachednewRow"
                                                    class="float-end add-attachment-row btn mb-2 fw-medium btn-soft-secondary">
                                                    <i class="ri-add-fill me-1 align-bottom"></i>
                                                    Add New
                                                </button>
                                            </p>

                                            <table class="invoice-table table table-borderless table-nowrap mb-0">
                                                <tbody id="attached-area">
                                                    @foreach ($product->files as $file)
                                                        <tr class="tf-cart-item1 file-delete">
                                                            <td class="tf-cart-item_product">
                                                                <i class="fas fa-file-pdf me-2 fs-2 text-danger"></i>
                                                                {{ $file->file_name }}
                                                            </td>

                                                            <td class="remove-cart text-end">
                                                                {{-- <span class="fs-12">
                                                                    {{ date('d M y', strtotime($file->created_at)) }}
                                                                </span> --}}
                                                                <a href="{{ url('download-file/' . $file->id) }}"
                                                                    class="d-flex justify-content-end  link-danger link-offset-2 text-decoration-underline link-underline-opacity-25 link-underline-opacity-100-hover">
                                                                    <i class="fas fa-download me-2"></i>
                                                                    <span>Download</span>
                                                                </a>
                                                            </td>

                                                            <td class="remove-cart text-end">
                                                                <a href="{{ url('admin/product/delete-file/' . $file->id) }}"
                                                                    class="d-flex justify-content-end  link-danger link-offset-2 text-decoration-underline link-underline-opacity-25 link-underline-opacity-100-hover">
                                                                    <i class="fas fa-trash me-2"></i>
                                                                    <span>Remove</span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="addproduct-video" role="tabpanel">
                                        <div class="table-responsivew">
                                            <p class="text-muted">
                                                <button type="button"
                                                    class="float-end add-video-row btn mb-2 fw-medium btn-soft-secondary">
                                                    <i class="ri-add-fill me-1 align-bottom"></i>
                                                    Add New
                                                </button>
                                            </p>
                                            <table class="invoice-table table table-borderless table-nowrap mb-0">
                                                <tbody id="video-area">
                                                    @foreach ($product->videos as $video)
                                                        <tr id="1" class="product">
                                                            <td class="text-start py-0 w-50">
                                                                <div class="mb-0">
                                                                    <x-input.txt-group name="video_name[]"
                                                                        placeholder="Enter video name" :value="$video->file_name" />
                                                                </div>
                                                            </td>
                                                            <td class="py-0">
                                                                <div>
                                                                    <x-input.txt-group name="video_link[]"
                                                                        placeholder="Enter your  attribute value"
                                                                        :value="$video->link" />
                                                                </div>
                                                            </td>
                                                            <td class="product-removal py-0">
                                                                <a href="{{ $video->link }}" target="_blank"
                                                                    class="btn btn-primary">
                                                                    <i class="ri-eye-line"></i>
                                                                </a>
                                                            </td>
                                                            <td class="product-removal py-0">
                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-danger remove-row">
                                                                    <i class="ri-delete-bin-5-line"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
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
                                <h5 class="card-title mb-0">Publish</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <x-input.select-group label="Status" name="status" itemText="name"
                                        itemValue="value" :items="[
                                            ['name' => 'Active', 'value' => 'active'],
                                            ['name' => 'Deactive', 'value' => 'deactive'],
                                        ]" data-choices-search-false
                                        value="{{ $product->status ?? '' }}" />
                                </div>
                                <div>
                                    <x-input.select-group label="File Category" name="file_category" itemText="name"
                                        itemValue="value" :items="[
                                            ['name' => 'Software', 'value' => 'software'],
                                            ['name' => 'Data Sheet', 'value' => 'data-sheet'],
                                            ['name' => 'Quick Start Guide', 'value' => 'quick-start-guide'],
                                            ['name' => 'Installation Guide', 'value' => 'installation-guide'],
                                        ]" data-choices-search-false
                                        value="{{ $product->file_category }}" />
                                </div>
                            </div>
                        </div>
                        <div class="card mb-1">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Product Category</h5>
                            </div>
                            <div class="card-body">
                                <x-input.select-group label="Categories" name="category_id" itemText="slug"
                                    itemValue="id" :items="$categories" data-choices-search-true
                                    value="{{ $product->category_id ?? '' }}" />
                            </div>
                        </div>

                        <div class="card mb-1">
                            <div class="card-header">
                                <div class="px-0 py-0  align-items-center d-flex">
                                    <h5 class="card-title mb-0 flex-grow-1">Product Colors</h5>
                                    <div>
                                        <a id="add_color" class="btn btn-soft-secondary btn-sm">
                                            <i class="ri-add-fill me-1 align-bottom"></i>
                                            Add Color
                                        </a>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="hstack gap-3 align-items-start">
                                    <div class="flex-grow-1">
                                        <div id="color_area">
                                            @foreach ($product?->colors ?? [] as $color)
                                                <div class="d-flex p-2 color-row">
                                                    <input type="color" name="colors[]"
                                                        placeholder="select product color" value="{{ $color }}"
                                                        class="form-control form-control-sm mx-2" autocomplete="off">
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-danger btn-sm color-remove-row">
                                                        <i class="ri-delete-bin-5-line"></i>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-1">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Product Tags</h5>
                            </div>
                            <div class="card-body">
                                <div class="hstack gap-3 align-items-start">
                                    <div class="flex-grow-1">
                                        <input class="form-control" name="tags[]" data-choices
                                            data-choices-multiple-remove="true" placeholder="Enter tags" type="text"
                                            value="{{ implode(',', $product->tags) }}" />
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
                                <textarea class="form-control" name="short_desc" placeholder="Must enter minimum of a 100 characters"
                                    rows="10">{{ $product->short_desc ?? '' }}</textarea>
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
            $('document').ready(function() {

                let i = 1;

                $(document).on('click', '.add-row', function() {
                    var newRow = `
                    <tr class="product">
                        <td class="text-start py-0 w-50">
                            <div class="mb-0">
                                <x-input.txt-group id="attribute" name="attribute[]"                                             placeholder="Enter attribute" />

                            </div>
                        </td>
                        <td class="py-0">
                            <div>
                                <x-input.txt-group name="value[]"
                                    placeholder="Enter your attribute value" />
                            </div>
                        </td>
                        <td class="product-removal py-0">
                            <a href="javascript:void(0)" class="btn btn-danger remove-row">
                                <i class="ri-delete-bin-5-line"></i>
                            </a>
                        </td>
                    </tr>`;

                    $('#newlink').append(newRow);

                    i++;
                });

                $(document).on('click', '.add-attachment-row', function() {
                    var newRow = `
                    <tr class="product">
                        <td class="text-start py-0 w-50">
                            <div class="mb-0">
                                <x-input.txt-group id="attribute" name="attachment_attribute[]" placeholder="Enter attribute" />
                            </div>
                        </td>
                        <td class="py-0">
                            <div>
                                <input type="file" class="form-control" name="attachment_value[]">
                            </div>
                        </td>
                        <td class="product-removal py-0">
                            <a href="javascript:void(0)" class="btn btn-danger remove-row">
                                <i class="ri-delete-bin-5-line"></i>
                            </a>
                        </td>
                    </tr>`;

                    $('#attached-area').append(newRow);

                    i++;
                });


                $(document).on('click', '#add_color', function() {
                    var videoRow =
                        `<input type="color" name="colors[]" id="colors" placeholder="select product color" value="#474b4f" class="form-control form-control-sm" autocomplete="off"> `;

                    $('#color_area').append(videoRow);

                });
                $(document).on('click', '.color-remove-row', function() {
                    $(this).closest('.color-row').remove();
                });

                $(document).on('click', '.add-video-row', function() {

                    var videoRow = `
                    <tr class="product">
                        <td class="text-start py-0 w-50">
                            <div class="mb-0">
                                <x-input.txt-group id="attribute" name="video_name[]"                                             placeholder="Enter video name" />

                            </div>
                        </td>
                        <td class="py-0">
                            <div>
                                <x-input.txt-group name="video_link[]"
                                    placeholder="Enter video link" class="video-link"/>
                            </div>
                        </td>
                        <td class="product-removal py-0">
                            <a href="javascript:void(0)" class="btn btn-danger remove-row">
                                <i class="ri-delete-bin-5-line"></i>
                            </a>
                        </td>
                    </tr>`;

                    $('#video-area').append(videoRow);

                    i++;
                });


                $(document).on('click', '.remove-row', function() {
                    var rowCount = $('.invoice-table tr').length;
                    if (rowCount == 1) {
                        alertNotify('At least two rows are required. You cannot delete the last remaining row.',
                            'error');
                    } else {
                        $(this).closest('tr').remove();
                    }
                });

                var ckClassicEditor = document.querySelectorAll("#new-content")
                ckClassicEditor.forEach(function() {
                    ClassicEditor
                        .create(document.querySelector('#new-content'))
                        .then(function(editor) {
                            editor.ui.view.editable.element.style.height = '200px';
                        })
                        .catch(function(error) {
                            console.error(error);
                        });
                });

            });

            function isValidURL(url) {
                const pattern = /^(https?:\/\/)?([\da-z.-]+)\.([a-z.]{2,6})([/\w .-]*)*\/?$/;
                return pattern.test(url);
            }

            function store() {
                sLoading('sbtBtn')

                let isValid = true;

                if ($('.is_video_value').val() != '') {
                    $('.video-link').each(function() {
                        const videoLink = $(this).val();
                        try {
                            new URL(videoLink);
                        } catch (error) {
                            alertNotify('Please enter valid URLs for all video links', 'error')
                            // alertNotify(`Please enter valid URLs for video number ${j++} links`, 'error')
                            console.log('1');
                            isValid = false;
                        }
                    });
                }
                if (!isValid) {
                    console.log('not valid');
                    return;
                }

                console.log('valid');


                $('#new-content').html($('.ck-content').html());
                var form = document.getElementById('product-form');
                var url = form.getAttribute('action');
                var method = form.getAttribute('method');
                var payload = new FormData(form);

                var profileImgInput = document.getElementById('selectImage');

                if (profileImgInput.files.length > 0) {
                    payload.append('img', profileImgInput.files[0]);
                }

                const options = {
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
                            associateErrors([], 'product-form');
                            eLoading('sbtBtn')
                        } else {
                            associateErrors(response.errors, 'product-form');

                            eLoading('sbtBtn')
                            showErrorMsg(response);
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

            #current-img-preview {
                width: 100px;
                height: 50px;
            }
        </style>
    @endpush
@endsection
