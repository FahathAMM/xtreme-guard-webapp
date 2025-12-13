@extends('layout.app-site')
@section('title', 'Solution')

@section('content')

    @php
        $lable = str_replace('-', ' ', $solution->solution_type);
    @endphp

    <div>
        <img src="{{ asset('storage/solution_banner/sb4.png') }}" alt="">
    </div>

    <section class="flat-spacing pt-3">
        <div class="mx-3">
            <div class="row">
                <div class="col-lg-12 mb-lg-30">
                    <div class="blog-detail-wrap page-single-2">
                        <div class="inner">

                            @if (!empty($solution->banner_img))
                                @foreach ($solution->banner_img as $img)
                                    <div class="image pt-1">
                                        <img class="lazyload rounded" data-src="{{ getImgUrl($img) }}"
                                            src="{{ getImgUrl($img) }}" alt="">
                                    </div>
                                @endforeach
                            @endif

                            @if ($solution->file)
                                @foreach ($solution->file as $key => $file)
                                    <div class="bot d-flex justify-content-between gap-1 flex-wrap"
                                        style=" margin: 0; padding: 0; ">
                                        <ul class="list-tasgs hass-bg">
                                            <li>{{ $key }}:</li>
                                            <li>
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
                            {{-- <h5 class="sidebar-heading">Relatest Post</h5> --}}
                            <div>
                                @foreach ($related as $item)
                                    <div class="relatest-post-item style-row hover-image">
                                        <div class="image" style="height: 85px;">
                                            <img class="lazyload" data-src="{{ getImgUrl($item->banner_img[0]) }}"
                                                src="{{ getImgUrl($item->banner_img[0]) }}" alt="">
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


{{-- @php
    function getImgUrl($path): Returntype
    {
        return asset('storage/' . $path);
    }
@endphp --}}
