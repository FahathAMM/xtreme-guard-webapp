@extends('layout.app')
@section('title', $title)
@section('content')
    @push('styles')
    @endpush
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xxl-7 col-xl-7 col-lg-9 col-md-10">
                    <div class="card">
                        <div class="bg-danger-subtle position-relative">
                            <div class="card-body p-5">
                                <div class="text-center">
                                    <h3>{{ ucwords($contact->name) ?? '' }}</h3>
                                    <p class="mb-0 text-muted">
                                        Created at:
                                        {{ date('d M, Y', strtotime($contact->created_at)) ?? '' }}
                                    </p>
                                    <p class="mb-0 text-muted">
                                        Mobile:
                                        {{ $contact->phone ?? '' }}
                                    </p>
                                    <p class="mb-0 text-muted">
                                        Email:
                                        {{ ucwords($contact->email) ?? '' }}
                                    </p>

                                    <p class="mb-0 badge {{ true ? 'bg-success' : 'bg-danger' }}"
                                        style=" font-family: 'Poppins'; ">
                                        {{ true ? 'New Inquiry' : 'Issue Not Resolved' }}
                                    </p>

                                </div>
                            </div>
                            <div class="shape">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"
                                    width="1440" height="60" preserveAspectRatio="none" viewBox="0 0 1440 60">
                                    <g mask="url(&quot;#SvgjsMask1001&quot;)" fill="none">
                                        <path d="M 0,4 C 144,13 432,48 720,49 C 1008,50 1296,17 1440,9L1440 60L0 60z"
                                            style="fill: var(--vz-secondary-bg);"></path>
                                    </g>
                                    <defs>
                                        <mask id="SvgjsMask1001">
                                            <rect width="1440" height="60" fill="#ffffff"></rect>
                                        </mask>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div>
                                <h5>{{ ucwords($contact->subject) ?? '' }}!</h5>
                                <p class="language-markup p-3 error-area">
                                    {{ trim($contact->message) ?? '' }}
                                </p>
                            </div>

                            {{-- <div class="text-end hstack gap-2 justify-content-end">
                                @if (!$contact->is_fixed)
                                    <a href="{{ url('development/cron-failed-fixed/' . $CronFailure->id) }}"
                                        class="btn btn-outline-success">Resolved</a>
                                @endif
                                <a href="{{ url('development/cron-failed-fixed-list') }}" class="btn btn-outline-danger">
                                    <i class="mdi mdi-arrow-left align-bottom me-1"></i>
                                    Back
                                </a>
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php

    @endphp
    <style>
        .error-area {
            color: #878a99;
            text-shadow: none;
            background: #f3f6f9 !important;
            /* font-family: "Consolas", "Monaco", "Andale Mono", "Ubuntu Mono", monospace; */
            border-radius: 17px
        }
    </style>
@endsection
