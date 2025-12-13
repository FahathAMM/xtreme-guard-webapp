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

            <form id="product-form" method="POST" action="{{ route('products.store') }}" autocomplete="off"
                class="needs-validation1" novalidate1 enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card mb-1">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <x-input.txt-group label="Product Name" name="name"
                                                placeholder="Enter your Product name" />
                                        </div>
                                    </div>

                                    <div>
                                        <x-input.ckeditor id="new-content" name="description" />
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
                                                    <tr id="1" class="product">
                                                        <td class="text-start py-0 w-50">
                                                            <div class="mb-0">
                                                                <x-input.txt-group name="attribute[]"
                                                                    placeholder="Enter attribute" />
                                                            </div>
                                                        </td>
                                                        <td class="py-0">
                                                            <div>
                                                                <x-input.txt-group name="value[]"
                                                                    placeholder="Enter your  attribute value" />
                                                            </div>
                                                        </td>
                                                        <td class="product-removal py-0">
                                                            <a href="javascript:void(0)" class="btn btn-danger remove-row">
                                                                <i class="ri-delete-bin-5-line"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
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
                                                    <tr id="1" class="product">
                                                        <td class="text-start py-0 w-50">
                                                            <div class="mb-0">
                                                                <x-input.txt-group name="attachment_attribute[]"
                                                                    placeholder="Enter attachement name" />
                                                            </div>
                                                        </td>
                                                        <td class="py-0">
                                                            <div>
                                                                <input type="file" class="form-control"
                                                                    name="attachment_value[]">
                                                            </div>
                                                        </td>
                                                        <td class="product-removal py-0">
                                                            <a href="javascript:void(0)"
                                                                class="btn btn-danger remove-row">
                                                                <i class="ri-delete-bin-5-line"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
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
                                                    <tr id="1" class="product">
                                                        <td class="text-start py-0 w-50">
                                                            <div class="mb-0">
                                                                <x-input.txt-group name="video_name[]"
                                                                    placeholder="Enter video name"
                                                                    class="is_video_value" />
                                                            </div>
                                                        </td>
                                                        <td class="py-0">
                                                            <div>
                                                                <x-input.txt-group name="video_link[]"
                                                                    placeholder="Enter video link" class="video-link" />
                                                            </div>
                                                        </td>
                                                        <td class="product-removal py-0">
                                                            <a href="javascript:void(0)"
                                                                class="btn btn-danger remove-row">
                                                                <i class="ri-delete-bin-5-line"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
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
                                    <x-input.select-group label="Status" name="is_active" itemText="name"
                                        itemValue="value" :items="[
                                            ['name' => 'Active', 'value' => '1'],
                                            ['name' => 'Deactive', 'value' => '0'],
                                        ]" data-choices-search-false value="1" />
                                </div>
                                <div>
                                    <x-input.select-group label="File Category" name="file_category" itemText="name"
                                        itemValue="value" :items="[
                                            ['name' => 'Software', 'value' => 'software'],
                                            ['name' => 'Data Sheet', 'value' => 'data-sheet'],
                                            ['name' => 'Quick Start Guide', 'value' => 'quick-start-guide'],
                                            ['name' => 'Installation Guide', 'value' => 'installation-guide'],
                                        ]" data-choices-search-false />
                                </div>
                            </div>
                        </div>
                        <div class="card mb-1">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Product Category</h5>
                            </div>
                            <div class="card-body">
                                <x-input.select-group label="Categories" name="category_id" itemText="slug"
                                    itemValue="id" :items="$categories" data-choices-search-true />
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
                                            data-choices-multiple-remove="true" placeholder="Enter tags"
                                            type="text" />
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
                                    rows="10"></textarea>
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
                if ($('.is_video_value').val() != '') {
                    $('.video-link').each(function() {
                        const videoLink = $(this).val();
                        try {
                            new URL(videoLink);
                        } catch (error) {
                            alertNotify('Please enter valid URLs for all video links', 'error')
                            // alertNotify(`Please enter valid URLs for video number ${j++} links`, 'error')
                        }
                    });
                }

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
                            associateErrors([], 'product-form');
                            eLoading('sbtBtn')
                        } else {
                            associateErrors(response.errors, 'product-form');
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
