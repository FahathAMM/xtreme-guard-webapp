@extends('layout.app-site')

@section('content')
    {{-- <section class="flat-spacing">
        <div class="container">
            <div class="tf-grid-layout tf-col-2 lg-col-5">
                @foreach ($categories as $category)
                    <div class="collection-position-2 radius-lg style-3 hover-img">
                        <a class="img-style" style=" background: #ECEFF2;">
                            <img class="lazyload" data-src="{{ $category->img }}" src="{{ $category->img }}" alt="banner-cls">
                        </a>
                        <div class="content">
                            <a href="#" class="cls-btn cls-btn d-flex justify-content-center">
                                <b class="text fs-13">{{ $category->name }}</b>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
    </section> --}}

    <x-site.home.cat-banner />

    {{-- <x-site.home.testimonial /> --}}

    <x-site.home.popular-category :categories="$categories" />


    <x-site.home.display-product :products="$products" />

    {{-- <x-site.home.explore /> --}}


    <x-site.home.iconbox />

    {{-- <x-site.home.special-banner /> --}}
@endsection
