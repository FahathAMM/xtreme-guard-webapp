@extends('layout.app-site')

@section('content')
    <style>
        .content-display ol li {
            list-style-type: decimal !important;
            margin-left: 20px !important;
        }

        .content-display ul li {
            list-style-type: disc !important;
            margin-left: 20px !important;
        }

        ol,
        ul {
            list-style: initial;
            /* Ensures default bullet/number styling */
            padding-left: 20px;
            /* Adds proper spacing for lists */
        }

        ol {
            list-style-type: decimal;
            /* Forces numbers */
        }

        ul {
            list-style-type: disc;
            /* Forces bullets */
        }

        ul,
        .content-display li {
            list-style: auto;
        }

        @media (min-width: 992px) {
            .tf-table-page-cart td {
                padding: 5px 20px;
            }
        }
    </style>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('assets/css/icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icons5.min.css') }}">

    @php
        $breadcrumbs = [
            ['label' => 'Product', 'url' => 'index.html'],
            ['label' => $product->category->name, 'url' => url('product-by-category/' . $product->category->slug)],
            ['label' => $product->name, 'url' => '#', 'is_current' => true], // Mark the current page
        ];
    @endphp

    <!-- breadcrumb -->
    <div class="tf-breadcrumb">
        <div class="container">
            <div class="tf-breadcrumb-wrap">
                <div class="tf-breadcrumb-list">
                    @foreach ($breadcrumbs as $breadcrumb)
                        @if (isset($breadcrumb['is_current']) && $breadcrumb['is_current'])
                            <span class="text text-caption-1">{{ $breadcrumb['label'] }}</span>
                        @else
                            <a href="{{ $breadcrumb['url'] }}" class="text text-caption-1">{{ $breadcrumb['label'] }}</a>
                            <i class="icon icon-arrRight"></i>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->

    <!-- tf-add-cart-success -->
    <div class="tf-add-cart-success">
        <div class="tf-add-cart-heading">
            <h5>Shopping Cart</h5>
            <i class="icon icon-close tf-add-cart-close"></i>
        </div>
        <div class="tf-add-cart-product">
            <div class="image">
                <img class=" ls-is-cached lazyloaded" data-src="{{ asset('site/images/products/womens/women-3.jpg') }}"
                    alt="" src="{{ asset('site/images/products/womens/women-3.jpg') }}">
            </div>
            <div class="content">
                <div class="text-title">
                    <a class="link" href="product-detail.html">Biker-style leggings</a>
                </div>
                <div class="text-caption-1 text-secondary-2">Green, XS, Cotton</div>
                <div class="text-title">$68.00</div>
            </div>
        </div>
        <a href="shopping-cart.html" class="tf-btn w-100 btn-fill radius-4"><span class="text text-btn-uppercase">View
                cart</span></a>
    </div>
    <!-- /tf-add-cart-success -->

    <!-- Product_Main -->
    <section class="flat-spacing">
        <div class="tf-main-product section-image-zoom">
            <div class="container">

                <div class="row">
                    <!-- Product default -->
                    <div class="col-md-6">
                        <div class="tf-product-media-wrap sticky-top">
                            <div class="thumbs-slider">
                                <div dir="ltr" class="swiper tf-product-media-thumbs other-image-zoom"
                                    data-direction="vertical">
                                    <div class="swiper-wrapper stagger-wrap">

                                        @foreach ($product->gallery as $img)
                                            <div class="swiper-slide stagger-item" data-color="gray">
                                                <div class="item">
                                                    <img class="lazyload" data-src="{{ $img->image }}"
                                                        src="{{ $img->image }}" alt="">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div dir="ltr" class="swiper tf-product-media-main" id="gallery-swiper-started"
                                    style="background:#FAFAFA;border-radius: 10px;">
                                    <div class="swiper-wrapper">
                                        @foreach ($product->gallery as $img)
                                            <div class="swiper-slide" data-color="gray">
                                                <a href="{{ $img->image }}" target="_blank" class="item"
                                                    data-pswp-width="600px" data-pswp-height="800px">
                                                    <img class="tf-image-zoom lazyload" data-zoom="{{ $img->image }}"
                                                        data-src="{{ $img->image }}" src="{{ $img->image }}"
                                                        alt="">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="tf-product-info-wrap position-relative">
                            <div class="tf-zoom-main"></div>
                            <div class="tf-product-info-list other-image-zoom">
                                <div class="tf-product-info-heading">
                                    <div class="tf-product-info-name">
                                        <div class="text text-btn-uppercase">{{ $product->category->name ?? '' }}</div>
                                        <h3 class="name">{{ $product->name ?? '' }}</h3>

                                    </div>
                                    <div class="tf-product-info-desc content-display">
                                        <p>
                                            {!! $product->description ?? '' !!}
                                        </p>

                                        <p>
                                            {!! $product->description ?? '' !!}
                                        </p>

                                    </div>
                                </div>
                                <div class="tf-product-info-choose-option">


                                    {{-- <div class="tf-product-info-help">

                                    </div>
                                    <ul class="tf-product-info-sku">
                                        <li>
                                            <p class="text-caption-1">Name:</p>
                                            <p class="text-caption-1 text-1">{{ $product->name }}</p>
                                        </li>
                                        <li>
                                            <p class="text-caption-1">Vendor:</p>
                                            <p class="text-caption-1 text-1">Modave</p>
                                        </li>
                                        <li>
                                            <p class="text-caption-1">Available:</p>
                                            <p class="text-caption-1 text-1">Instock</p>
                                        </li>
                                        <li>
                                            <p class="text-caption-1">Categories:</p>
                                            <p class="text-caption-1">
                                                <a href="#" class="text-1 link">
                                                    {{ $product->category->name ?? '' }}
                                                </a>,
                                            </p>
                                        </li>
                                    </ul> --}}
                                    <div>
                                        <div class="tf-product-info-by-btn mb_10">
                                        </div>
                                        <a href="#" class="btn-style-3 text-btn-uppercase">inquiry now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /tf-product-info-list -->
                </div>
            </div>
        </div>
    </section>
    <!-- /Product_Main -->

    <!-- Product_Description_Tabs -->
    <section class="mb-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="widget-tabs style-1">
                        <ul class="widget-menu-tab">
                            <li class="item-title active">
                                <span class="inner">Description</span>
                            </li>
                            <li class="item-title">
                                <span class="inner">Specifications</span>
                            </li>
                            <li class="item-title">
                                <span class="inner">Download</span>
                            </li>
                            {{-- <li class="item-title">
                                <span class="inner">Return Policies</span>
                            </li> --}}
                        </ul>
                        <div class="widget-content-tab">
                            <div class="widget-content-inner active">
                                <div class="tab-description">
                                    {!! $product->short_desc ?? '' !!}
                                </div>
                            </div>
                            <div class="widget-content-inner">
                                <div class="tab-reviews write-cancel-review-wrap">
                                    <div class="widwget-content-inner">
                                        <table class="tab-sizeguide-table table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Attribute</th>
                                                    <th>Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($product->attributes as $item)
                                                    <tr>
                                                        <td width="250">{{ $item->key }}</td>
                                                        <td width="750">{{ $item->value }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="widget-content-inner d-flex justify-content-center">
                                <div class="tab-shipping" style="width: 65% !important;">
                                    <table class="tf-table-page-cart">
                                        <tbody>
                                            @foreach ([1, 2, 3, 4] as $item)
                                                <tr class="tf-cart-item1 file-delete">
                                                    <td class="tf-cart-item_product">
                                                        <i class="fas fa-file-pdf me-2 fs-2 text-danger"></i>
                                                        AHEB Datesheet 20240709
                                                    </td>

                                                    <td class="remove-cart text-end">
                                                        <span class="fs-12">{{ now()->format('d M Y') }}</span>
                                                        <a class="d-flex justify-content-end">
                                                            <i class="fas fa-download me-2"></i>
                                                            <span>Download</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- <div class="widget-content-inner">
                                <div class="tab-policies">
                                    <div class="text-btn-uppercase mb_12">Return Policies</div>
                                    <p class="mb_12 text-secondary">At Modave, we stand behind the quality of our
                                        products. If you're not completely satisfied with your purchase, we offer
                                        hassle-free returns within 30 days of delivery.</p>
                                    <div class="text-btn-uppercase mb_12">Easy Exchanges or Refunds</div>
                                    <ul class="list-text type-disc mb_12 gap-6">
                                        <li class="text-secondary font-2">Exchange your item for a different size,
                                            color, or style, or receive a full refund.</li>
                                        <li class="text-secondary font-2">All returned items must be unworn, in
                                            their original packaging, and with tags attached.</li>
                                    </ul>
                                    <div class="text-btn-uppercase mb_12">Simple Process</div>
                                    <ul class="list-text type-number">
                                        <li class="text-secondary font-2">Initiate your return online or contact our
                                            customer service team for assistance.</li>
                                        <li class="text-secondary font-2">Pack your item securely and include the
                                            original packing slip.</li>
                                        <li class="text-secondary font-2">Ship your return back to us using our
                                            prepaid shipping label.</li>
                                        <li class="text-secondary font-2">Once received, your refund will be
                                            processed promptly.</li>
                                    </ul>
                                    <p class="text-secondary font-2">For any questions or concerns regarding
                                        returns, don't hesitate to reach out to our dedicated customer service team.
                                        Your satisfaction is our priority.</p>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
