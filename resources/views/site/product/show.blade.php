@extends('layout.app-site')
@section('title', 'Product')

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

        figure .ck-widget__type-around {
            /* figure .ck .ck-reset_all .ck-widget__type-around { */
            display: none !important;
        }
    </style>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('assets/css/icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icons5.min.css') }}">

    @php
        $breadcrumbs = [
            ['label' => 'Product', 'url' => url('product')],
            [
                'label' => $product?->category?->name ?? '',
                'url' => url('product-by-category/' . $product?->category?->slug ?? ''),
            ],
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

    <x-site.component.inquiry />

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
                                    style="background:#FAFAFA;border-radius: 10px;border: 1px solid #ddd;">
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
                                        <h4 class="name">{{ $product->name ?? '' }}</h4>

                                    </div>
                                    <div class="tf-product-info-desc content-display">
                                        <p>
                                            {!! $product->description ?? '' !!}
                                        </p>

                                        {{-- <p>
                                            {!! $product->description ?? '' !!}
                                        </p> --}}

                                    </div>
                                </div>
                                <div class="tf-product-info-choose-option">

                                    <div class="variant-picker-item">
                                        {{-- <div class="variant-picker-label mb_12">
                                            Colors:<span
                                                class="text-title variant-picker-label-value value-currentColor">gray</span>
                                        </div> --}}
                                        <div class="variant-picker-values1">
                                            {{-- <input id="values-beige" type="radio" name="color1">
                                            <label class="hover-tooltip tooltip-bot radius-60 color-btn" for="values-beige"
                                                data-value="Beige" data-color="beige">
                                                <span class="btn-checkbox bg-color-beige1"></span>
                                                <span class="tooltip">Beige</span>
                                            </label> --}}

                                            <h5>Available Colors</h5>

                                            @if (!empty($product->colors))
                                                @foreach ($product->colors as $color)
                                                    <div
                                                        style="background-color: {{ $color }};
                                                    width: 30px;
                                                    height: 30px;
                                                    margin: 10px 2px 10px 2px;
                                                    display: inline-block;
                                                    border: 2px solid #ccc;
                                                    border-radius: 50%;">
                                                    </div>
                                                @endforeach
                                            @endif

                                        </div>
                                    </div>

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
                                        <a href="#" class="btn-style-3 text-btn-uppercase"
                                            onclick="{{ 'openInquiryModal' }}({{ $product }})">inquiry now</a>
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
                            <li class="item-title">
                                <span class="inner">Videos</span>
                            </li>
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
                                <div class="w-100 w-sm-100 w-md-75 w-lg-100 w-xl-75 w-xxl-75">
                                    <x-site.show.download :product="$product" />
                                </div>
                            </div>

                            <div class="widget-content-inner">
                                <x-site.show.videos :videos="$product->videos" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
