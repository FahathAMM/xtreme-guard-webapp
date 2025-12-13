@extends('layout.app-site')
@section('title', 'Download')
@section('content')
    @php

        $first = true;
    @endphp

    <x-site.component.page-title :title="$modelName" :breadcrumbs="[['label' => 'Home', 'url' => url('/')], ['label' => $modelName]]" />

    {{-- @dd($attachments) --}}

    <link rel="stylesheet" href="{{ asset('assets/css/icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icons5.min.css') }}">

    <section class="flat-spacing page-search-inner pb-0 pt-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <form action="{{ url('download') }}" method="GET" class="form-search">
                        <fieldset class="text">
                            <input type="text" placeholder="Search product name..." class="" name="q"
                                tabindex="0" value="{{ request('q') }}" aria-required="true">
                        </fieldset>
                        <button class="" type="submit">
                            <svg class="icon" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                    stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M21.35 21.0004L17 16.6504" stroke="#181818" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                </path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="flat-spacing pt-4">
        <div class="container">
            <div class="heading-section-4 wow fadeInUp">
                <div class="heading-left">
                    {{-- <h3 class="heading font-5 fw-bold">Best Sellers</h3> --}}
                    <ul class="tab-product style-2 justify-content-sm-center mb-0" role="tablist">
                        @foreach ($attachments as $key => $name)
                            <li class="nav-tab-item" role="presentation">
                                <a href="#{{ $key }}" class="{{ $first ? 'active' : '' }}" data-bs-toggle="tab">
                                    {{ $key }}
                                </a>
                            </li>
                            @php $first = false; @endphp

                            @if (!$loop->last)
                                <li class="text-line d-none d-sm-block">/</li>
                            @endif
                        @endforeach
                    </ul>

                </div>
                {{-- <a href="shop-collection.html" class="btn-line">View All Products</a> --}}
            </div>
            <div class="flat-animate-tab">
                <div class="tab-content">

                    @foreach ($attachments as $key => $products)
                        <div class="tab-pane {{ $loop->first ? 'active show' : '' }}" id="{{ $key }}"
                            role="tabpanel">

                            <div class="widget-content-inner d-flex justify-content-start active">
                                <div class="w-100">
                                    <div class="w-100 ">
                                        <div>
                                            <table class="tf-table-page-cart">
                                                <tbody>
                                                    @foreach ($products as $product)
                                                        {{-- <pre>
                                                        {{ $product['files'] }}
                                                    </pre> --}}
                                                        @foreach ($product['files'] as $file)
                                                            <tr class="tf-cart-item1 file-delete">
                                                                <td class="tf-cart-item_product">
                                                                    {{-- <i class="fas fa-file-pdf me-2 fs-2 text-danger"></i> --}}

                                                                    <img src="{{ getFileIcon($file->path) }}"
                                                                        alt="File Icon" width="32">
                                                                    {{ $product->name }} - {{ $file->file_name }}
                                                                </td>

                                                                <td>
                                                                    <span class="fs-12">
                                                                        <small style=" font-size: 12px; ">
                                                                            File size:
                                                                        </small>
                                                                        <strong>{{ formatFileSize($file->size) }}</strong>
                                                                    </span>
                                                                </td>

                                                                <td>
                                                                    <span class="fs-12">
                                                                        <small style=" font-size: 12px; ">Last
                                                                            updated:</small>
                                                                        {{ date('d M Y', strtotime($file->created_at)) }}
                                                                    </span>
                                                                </td>

                                                                <td class="remove-cart text-end">
                                                                    {{-- <span class="fs-12">
                                                                        <small style=" font-size: 10px; ">Last
                                                                            updated:</small>
                                                                        {{ date('d M Y', strtotime($file->created_at)) }}
                                                                    </span> --}}

                                                                    {{--
                                                                    <a href="{{ asset('storage/' . $file->path, []) }}"
                                                                        download="{{ $product->name }}"
                                                                        class="d-flex justify-content-end  link-danger link-offset-2 text-decoration-underline link-underline-opacity-25 link-underline-opacity-100-hover">
                                                                        <i class="fas fa-download me-2"></i>
                                                                        <span>Download</span>
                                                                    </a> --}}


                                                                    <a href="{{ url('download-file/' . $file->id) }}"
                                                                        class="d-flex justify-content-end link-danger link-offset-2 text-decoration-underline link-underline-opacity-25 link-underline-opacity-100-hover">
                                                                        <i class="fas fa-download me-2"></i>
                                                                        <span>Download</span>
                                                                    </a>


                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endforeach


                                                    {{-- <tr class="tf-cart-item1 file-delete">
                                                        <td class="tf-cart-item_product">
                                                            <i class="fas fa-file-pdf me-2 fs-2 text-danger"></i>
                                                            Doc1
                                                        </td>

                                                        <td class="remove-cart text-end">
                                                            <span class="fs-12">
                                                                <small style=" font-size: 10px; ">Last updated:</small>
                                                                13 Mar 2025
                                                            </span>
                                                            <a href="http://143.244.130.129/storage/attachment/64UIBq902XiZUFlPiJp9Qqa7MvDDFo41wfELHMwd.pdf"
                                                                download=""
                                                                class="d-flex justify-content-end  link-danger link-offset-2 text-decoration-underline link-underline-opacity-25 link-underline-opacity-100-hover">
                                                                <i class="fas fa-download me-2"></i>
                                                                <span>Download</span>
                                                            </a>
                                                        </td>
                                                    </tr> --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    @endforeach

                </div>
    </section>














    {{-- <section class="flat-spacing">
        <div class="container">
            <div class="heading-section-4 wow fadeInUp">
                <div class="heading-left">
                    <ul class="tab-product style-2 justify-content-sm-center mb-0" role="tablist">

                        @foreach ($categories as $id => $name)
                            <li class="nav-tab-item" role="presentation">
                                <a href="#{{ $id }}" class="{{ $first ? 'active' : '' }}"
                                    data-bs-toggle="tab">{{ $name }}</a>
                            </li>
                            @php $first = false; @endphp

                            @if (!$loop->last)
                                <li class="text-line d-none d-sm-block">/</li>
                            @endif
                        @endforeach
                    </ul>

                </div>
            </div>
            <div class="flat-animate-tab">
                <div class="tab-content">
                    <div class="tab-pane active show" id="headphone" role="tabpanel">

                        <div class="widget-content-inner d-flex justify-content-start active">
                            <div class="w-100">
                                <div class="w-100 w-sm-100 w-md-75 w-lg-100 w-xl-50 w-xxl-50">
                                <div>
                                    <table class="tf-table-page-cart">
                                        <tbody>
                                            <tr class="tf-cart-item1 file-delete">
                                                <td class="tf-cart-item_product">
                                                    <i class="fas fa-file-pdf me-2 fs-2 text-danger"></i>
                                                    Doc1
                                                </td>

                                                <td class="remove-cart text-end">
                                                    <span class="fs-12">
                                                        <small style=" font-size: 10px; ">Last updated:</small>
                                                        13 Mar 2025
                                                    </span>
                                                    <a href="http://143.244.130.129/storage/attachment/64UIBq902XiZUFlPiJp9Qqa7MvDDFo41wfELHMwd.pdf"
                                                        download=""
                                                        class="d-flex justify-content-end  link-danger link-offset-2 text-decoration-underline link-underline-opacity-25 link-underline-opacity-100-hover">
                                                        <i class="fas fa-download me-2"></i>
                                                        <span>Download</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="tab-pane" id="mouse" role="tabpanel">
                        mouse
                    </div>
                    <div class="tab-pane" id="keyboard" role="tabpanel">
                        keyboard
                    </div>
                    <div class="tab-pane" id="mousepad" role="tabpanel">
                        mousepad
                    </div>
                    <div class="tab-pane" id="cable" role="tabpanel">
                        cable
                    </div>
                    <div class="tab-pane" id="networking" role="tabpanel">
                        networking
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection
