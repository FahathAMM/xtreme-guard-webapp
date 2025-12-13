@extends('layout.app-site')
@section('title', 'Solution')

@section('content')

    @php
        $lable = str_replace('-', ' ', $solution->solution_type);
    @endphp

    <x-site.component.page-title title="Solution" :breadcrumbs="[['label' => 'Solution', 'url' => '#'], ['label' => $lable]]" />

    <section class="flat-spacing">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-lg-30">
                    <div class="blog-detail-wrap page-single-2">
                        <div class="inner">
                            <div class="heading">
                                <ul class="list-tags has-bg">
                                    <li>
                                        <a href="#" class="link">
                                            {{ str_replace('-', ' ', $solution->solution_type) }}
                                        </a>
                                    </li>
                                </ul>
                                <h3 class="fw-5">
                                    {{-- The Future of Fashion How Technology Transforms the Industry --}}
                                    {{ $solution->title ?? '' }}
                                </h3>
                                <div class="meta">
                                    <div class="meta-item gap-8">
                                        <div class="icon">
                                            <i class="icon-calendar"></i>
                                        </div>
                                        <p class="body-text-1">
                                            {{ date('d M Y', strtotime($solution->created_at)) }}
                                        </p>
                                    </div>
                                    <div class="meta-item gap-8">
                                        <div class="icon">
                                            <i class="icon-user"></i>
                                        </div>
                                        <p class="body-text-1">by <a class="link" href="#">
                                                {{ Str::limit(str_replace('-', ' ', $solution->solution_type), 50) }}
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="image">
                                {{-- <img class="lazyload" data-src="{{ asset('site/images/blog/blog-details-1.jpg') }}"
                                    src="{{ asset('site/images/blog/blog-details-1.jpg') }}" alt=""> --}}
                                <img class="lazyload border rounded" data-src="{{ $solution->banner_img }}"
                                    src="{{ $solution->banner_img }}" alt="">

                                {{-- Rendered size:	850 × 478 px
                                    Rendered aspect ratio:	425∶239
                                    Intrinsic size:	1275 × 717 px
                                    Intrinsic aspect ratio:	425∶239
                                    File size:	129 kB
                                    Current source:	https://themesflat.co/html/modave/images/blog/blog-details-2.jpg --}}

                            </div>

                            <div class="content content-display">
                                {!! $solution->content !!}
                            </div>

                            @if ($solution->file)
                                @foreach ($solution->file as $key => $file)
                                    <div class="bot d-flex justify-content-between gap-1 flex-wrap"
                                        style=" margin: 0; padding: 0; ">
                                        <ul class="list-tasgs hass-bg">
                                            <li>{{ $key }}:</li>
                                            <li>
                                                {{-- <a href="#" class="link">11</a> --}}

                                                <a href="{{ asset('storage/' . $file, []) }}" download
                                                    class="d-flex justify-content-end  link-danger link-offset-2 text-decoration-underline link-underline-opacity-25 link-underline-opacity-100-hover">
                                                    <i class="fas fa-download me-2"></i>
                                                    <span>Download</span>
                                                </a>


                                            </li>
                                        </ul>
                                    </div>
                                @endforeach
                            @endif


                            <div class="bot d-flex justify-content-between gap-10 flex-wrap">
                                <ul class="list-tags has-bg">
                                    <li>Tag:</li>

                                    @foreach ($solution->tags as $tag)
                                        <li>
                                            <a href="#" class="link">{{ $tag }}</a>
                                        </li>
                                    @endforeach

                                </ul>
                                <div class="d-flex align-items-center justify-content-between gap-16">
                                    <p>Share this post:</p>
                                    <ul class="tf-social-icon style-1">
                                        <li><a href="#" class="social-facebook"><i class="icon icon-fb"></i></a></li>
                                        <li><a href="#" class="social-twiter"><i class="icon icon-x"></i></a></li>
                                        <li><a href="#" class="social-pinterest"><i
                                                    class="icon icon-pinterest"></i></a></li>
                                        <li><a href="#" class="social-instagram"><i
                                                    class="icon icon-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>


                            <div class="related-post d-flex">
                                <div class="pre w-50">
                                    @if ($previous)
                                        <div class="text-btn-uppercase">
                                            <a href="{{ url('solution-by-type-show/' . $previous->id) }}">Previous</a>
                                        </div>
                                        <h6 class="fw-5">
                                            <a class="link" href="{{ url('solution-by-type-show/' . $previous->id) }}">
                                                {{ $previous->title }}
                                            </a>
                                        </h6>
                                    @endif
                                </div>
                                <div class="next w-50">
                                    @if ($next)
                                        <div class="text-btn-uppercase text-end">
                                            <a href="{{ url('solution-by-type-show/' . $next->id) }}">Next</a>
                                        </div>
                                        <h6 class="fw-5 text-end">
                                            <a class="link" href="{{ url('solution-by-type-show/' . $next->id) }}">
                                                {{ $next->title }}
                                            </a>
                                        </h6>
                                    @endif
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar maxw-360">
                        <div class="sidebar-item sidebar-relatest-post">
                            <h5 class="sidebar-heading">Relatest Post</h5>
                            <div>
                                {{-- <div class="relatest-post-item hover-image">
                                    <div class="image">
                                        <img class="lazyload" data-src="images/blog/sidebar-1.jpg"
                                            src="images/blog/sidebar-1.jpg" alt="">
                                    </div>
                                    <div class="content">
                                        <div class="meta">
                                            <div class="meta-item gap-8">
                                                <div class="icon">
                                                    <i class="icon-calendar"></i>
                                                </div>
                                                <p class="text-caption-1">February 28, 2024</p>
                                            </div>
                                            <div class="meta-item gap-8">
                                                <div class="icon">
                                                    <i class="icon-user"></i>
                                                </div>
                                                <p class="text-caption-1">by <a class="link"
                                                        href="#">Themesflat</a></p>
                                            </div>
                                        </div>
                                        <h6 class="title fw-5">
                                            <a class="link" href="blog-detail.html">The Ultimate Guide: Dressing
                                                Stylishly with Minimal Effort</a>
                                        </h6>
                                    </div>
                                </div> --}}

                                @foreach ($related as $item)
                                    <div class="relatest-post-item style-row hover-image">
                                        <div class="image" style="height: 85px;">
                                            <img class="lazyload" data-src="{{ $item->banner_img }}"
                                                src="{{ $item->banner_img }}" alt="">
                                        </div>
                                        <div class="content">
                                            <div class="meta">
                                                <div class="meta-item gap-8">
                                                    <p class="text-caption-1">February 28, 2024</p>
                                                </div>
                                                <div class="meta-item gap-8">
                                                    <p class="text-caption-1">by <a class="link" href="#">
                                                            {{ Str::limit(str_replace('-', ' ', $item->solution_type), 50) }}
                                                        </a></p>
                                                </div>
                                            </div>
                                            <div class="title text-title">
                                                <a class="link" href="blog-detail.html">
                                                    {{ $item->title }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

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
