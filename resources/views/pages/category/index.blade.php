@extends('layout.app')
@section('title', $title)
@section('content')
    @push('styles')
    @endpush
    <div class="page-content">
        <div class="container-fluid">

            {{-- <x-input.select-group label="Categories"
             name="category_id" itemText="name" itemValue="id" :items="$categories->toArray()"
                data-choices-search-true /> --}}

            <div class="row" id="category-card-area">
                @foreach ($categories as $category)
                    <div class="col-xxl-3 col-md-4">
                        <x-card.card-category :categoryName="$category->name" :categoryId="$category->id" :item="$category" color="warning"
                            per="administration-category-edit" perDelete="administration-category-delete" />
                    </div>
                @endforeach
                <div class="col-xxl-3 col-md-4">
                    {{-- @can('administration-role-create') --}}
                    <x-card.card-add-category color="success" funName="CategoryModal" />
                    {{-- @endcan --}}
                </div>
            </div>

            {{-- add Category  modal --}}
            <x-modal.common titleName="Add Category" idName="CategoryModal" size="modal-lg">
                <form action="{{ route('category.store') }}" method="POST" id="category-form" class="tablelist-form"
                    autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="is_edit" id="is_edit">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <x-input.txt-group label="Category Name" name="name"
                                    placeholder="Enter your Category Name" />
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <x-input.select-group-js name="is_active" label="Status" itemText="name" itemValue="value"
                                    :items="[
                                        ['name' => 'Active', 'value' => '1'],
                                        ['name' => 'Inactive', 'value' => '0'],
                                    ]" />
                            </div>

                            {{-- @dd($categories) --}}
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <x-input.select-group-js label="Categories" name="parent_id" itemText="name" itemValue="id"
                                    :items="$categories" data-choices-search-true />
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <x-input.img name="img1" />
                                {{-- <x-input.img-size name="img1" /> --}}

                                <ul class="list-unstyled mb-0 mt-4" id="current-preview" style="display:none;">
                                    <li class="mt-2" id="current-preview-list">
                                        <div class="border rounded">
                                            <div class="d-flex p-2">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-sm bg-light rounded">
                                                        <img data-dz-thumbnail="" class="img-fluid rounded d-block"
                                                            id="current-img-preview" alt="Product-Image"
                                                            style="display: block;"
                                                            src="http://localhost/akil/public/storage/category/yvhpYSUGZAXqsOAW.png">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="pt-1">

                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0 ms-3">
                                                    <button type="button" id="removeImg"
                                                        class="btn btn-sm btn-danger">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>


                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <x-input.txtarea-group label="Description" name="description"
                                    placeholder="Enter your description" />
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" id="close-modal" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-success sbtBtn1" onclick="submitBtn()" id="submit-btn">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </x-modal.common>
        </div>
    </div>

    @push('scripts')
        <script>
            $(function() {
                const element = document.querySelector('.dataTables_length label select');
                if (element) {
                    const choices = new Choices(element, {
                        searchEnabled: false
                    });
                }
            });

            let formIdName = 'category-form';

            function CategoryModal(isEdit, data = null) {
                console.log('ff');

                const form = $(`#${formIdName}`);
                const submitButton = $('#submit-btn');
                const CategoryModalLabel = $('#CategoryModalLabel');

                // Helper function to set the form action and method
                const setFormActionAndMethod = (actionUrl, method) => {
                    form.attr('action', actionUrl);
                    if (method) {
                        form.append(`<input type="hidden" name="_method" value="${method}">`);
                    } else {
                        form.find('input[name="_method"]').remove();
                    }
                };



                // Helper function to update button text
                const updateSubmitButtonText = (text) => {
                    submitButton.text(text);
                    CategoryModalLabel.text(text);
                };

                // Update the form fields
                const updateFormFields = (data) => {
                    console.log(data);

                    let parent_category_id = data?.parent_categories?.id || '';

                    setValueByName('is_edit', isEdit ? 1 : 0);
                    setValueByName('name', data?.name || '');
                    setValueByName('description', data?.description || '');
                    updateSelectedValue('parent_id', parent_category_id)
                    updateSelectedValue('is_active', data?.is_active ? 1 : 0)
                    $('#current-img-preview').attr('src', data.img);

                };

                if (isEdit && data) {
                    setFormActionAndMethod(`{{ url('admin/category') }}/${data.id}`, 'PUT');
                    updateSubmitButtonText('Update category');
                    updateFormFields(data);
                    $('#current-preview').show()
                } else {
                    setFormActionAndMethod('{{ route('category.store') }}');
                    updateSubmitButtonText('Add category');
                    // clearForm(formIdName); // Clear form fields for a fresh entry
                }

                // Show the modal
                $('#CategoryModal').modal('show');
            }

            function submitBtn() {
                if (getValue('is_edit')) {
                    update();
                } else {
                    store();
                }
            }

            function store() {
                sLoading('sbtBtn')
                var form = document.getElementById(formIdName);
                var url = form.getAttribute('action');
                var method = form.getAttribute('method');
                var payload = new FormData(form);

                var profileImgInput = document.getElementById('selectImage');

                // if (profileImgInput.files.length > 0) {
                //     payload.append('img1', profileImgInput.files[0]);
                // }

                const options = {
                    // contentType: 'application/json',
                    contentType: 'multipart/form-data',

                    // 'Content-Type': 'multipart/form-data',
                    method: method || 'POST',
                    headers: {
                        dataType: "json",
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    }
                };

                console.log(payload);
                console.log(profileImgInput);
                console.log(profileImgInput.files[0]);

                // return;

                sendData(
                    url,
                    payload,
                    options,
                    (response) => {
                        console.log('Success:', response.status);
                        if (response.status) {
                            $("#role-form :input").val("");
                            // redirectTo('{{ route('user.index') }}');
                            refreshContent('{{ url('admin/category') }}', 'category-card-area');
                            eLoading('sbtBtn')
                            refreshContent('{{ url('administration/role') }}', 'role-card-area');
                            closeModal('addRoleModal');
                            alertNotify(response.message, 'success')
                        } else {
                            associateErrors(response.errors, formIdName);
                            eLoading('sbtBtn')
                        }
                    },
                    (error) => {
                        console.error('Error:', error);
                    }
                );
            }

            function update() {
                // sLoading('sbtBtn')
                var form = document.getElementById(formIdName);
                var url = form.getAttribute('action');
                var method = form.getAttribute('method');
                var payload = new FormData(form);

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
                            refreshContent('{{ url('admin/category') }}', 'category-card-area');
                            closeModal('RoomModal');
                            alertNotify(response.message, 'success')
                            eLoading('sbtBtn')
                        } else {
                            associateErrors(response.errors, formIdName);
                            eLoading('sbtBtn')
                        }
                    },
                    (error) => {
                        console.error('Error:', error);
                    }
                );
            }

            function closeModal(modalId) {
                $(`#${modalId}`).modal('hide');
            }

            // ========form submit============
        </script>
    @endpush

    <style>
        #current-img-preview {
            width: 100px;
            height: 50px;
        }
    </style>
@endsection
