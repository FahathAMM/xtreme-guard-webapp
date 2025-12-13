@extends('layout.app')

@section('title', $title)

@section('content')
    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    @endpush

    <div class="page-content">
        <div class="container-fluid">

            <div class="card" id="contactList">
                <div class="card-header py-2">
                    <div class="row align-items-center g-3">
                        <div class="col-md-3">
                            <h5 class="card-title mb-0">{{ $title ?? 'Contact Messages' }}</h5>
                        </div>

                        <div class="col-md-auto ms-auto">
                            <div class="d-flex gap-2">
                                <div class="search-box">
                                    <input type="text" class="form-control search" placeholder="Search contacts..."
                                        id="custom-search-input">
                                    <i class="ri-search-line search-icon"> </i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table id="datatable-crud" class="display table-sm table stripe dt-responsive table-bordered"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                {{-- <th>Phone</th> --}}
                                <th>Subject</th>
                                {{-- <th>Company</th> --}}
                                {{-- <th>Country</th> --}}
                                <th>Message</th>
                                <th>Created at</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>

        <script>
            $(function() {
                loadTable();
            });

            function loadTable() {
                var table = $('#datatable-crud').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: true,
                    // stateSave: true,
                    scrollY: "50vh",
                    pageLength: 50, // Default rows per page
                    lengthMenu: [
                        [10, 25, 50, 100],
                        [10, 25, 50, 100]
                    ], // Options in dropdown
                    ajax: {
                        url: '{{ url('admin/contacts') }}', // Change API endpoint for contact messages
                    },
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        // {
                        //     data: 'phone',
                        //     name: 'phone'
                        // },
                        {
                            data: 'subject',
                            name: 'subject',
                            render: function(data, type, row) {
                                return data.length > 20 ? data.substr(0, 20) + '...' : data;
                            }
                        },
                        // {
                        //     data: 'company',
                        //     name: 'company'
                        // },
                        // {
                        //     data: 'country',
                        //     name: 'country'
                        // },
                        {
                            data: 'message',
                            name: 'message',
                            render: function(data, type, row) {
                                return data.length > 50 ? data.substr(0, 50) + '...' : data;
                            }
                        },
                        {
                            data: 'created_at',
                            name: 'created_at',
                            render: function(data, type, row) {
                                if (!data) return '';
                                return dayjs(data).format('DD-MMMM YYYY HH:mm:ss');
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                    order: [
                        [0, 'desc']
                    ],
                });

                $('#custom-search-input').keyup(function() {
                    table.search($(this).val()).draw();
                });

                let searchValue = $('#datatable_filter label input').val();
                $('#custom-search-input').val(searchValue);
            }
        </script>
    @endpush
@endsection
