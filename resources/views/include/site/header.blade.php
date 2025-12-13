@php
    $menuItems = [
        ['name' => 'Home', 'url' => url('/'), 'pattern' => '/'],
        [
            'name' => 'Software',
            'url' => url('solution-by-type/' . 'software'),
            'pattern' => 'solution-by-type/software',
        ],
        ['name' => 'Download', 'url' => url('download'), 'pattern' => 'download*'],
        ['name' => 'Contact', 'url' => url('contact'), 'pattern' => 'contact'],
        ['name' => 'About', 'url' => url('aboutus'), 'pattern' => 'aboutus'],
    ];

    // getSolutionForHeader();

    $headerColor = getSetting('header_color');

@endphp

<header id="header" class="header-default" style="background: {{ $headerColor ?? '#474B4F' }} !important;">
    <div class="container">
        <div class="row wrapper-header align-items-center">
            <div class="col-md-4 col-3 d-xl-none">
                <a href="#mobileMenu" class="mobile-menu" data-bs-toggle="offcanvas" aria-controls="mobileMenu">
                    <i class="icon icon-categories"></i>
                </a>
            </div>
            <div class="col-xl-3 col-md-4 col-6">
                <a href="{{ url('/') }}" class="logo-header">
                    {{-- <img src="{{ asset('site/images/logo/3.png') }}" alt="logo" class="logo"> --}}
                    <img src="{{ asset('site/images/logo/4.png') }}" alt="logo" class="logo">
                </a>
            </div>
            <div class="col-xl-6 d-none d-xl-block">

                @php
                    $subCategoryIds = getCategoriesForHeader()->flatMap->subcategories->pluck('id')->toArray();
                @endphp
                <nav class="box-navigation text-center">
                    <ul class="box-nav-ul d-flex align-items-center justify-content-center">
                        @foreach ($menuItems as $key => $item)
                            @if ($loop->index == 1)
                                <li
                                    class="menu-item mx-3 {{ request()->is($item['pattern']) != 'solution-by-type/software' && request()->is('solution*') ? 'active' : '' }}">
                                    <div class="tf-list-categories">
                                        <a href="#" class="item-link">
                                            Solutions
                                            <i class="icon icon-arrow-down"></i>
                                        </a>
                                        <div class="list-categories-inner">
                                            <ul>
                                                @foreach (getSolutionForHeader() as $solution)
                                                    <li class="sub-categories2">
                                                        <a href="{{ url('solution-by-type/' . $solution['id']) }}"
                                                            class="categories-item">
                                                            <span class="inner-left">
                                                                {{ $solution['name'] }}
                                                            </span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            @endif

                            <li class="menu-item mx-3 {{ request()->is($item['pattern']) ? 'active' : '' }}"
                                {{ request()->is($item['pattern']) . $item['pattern'] }}>
                                <a href="{{ $item['url'] }}" class="item-link">
                                    {{ $item['name'] }}
                                    @if (!empty($item['sub']))
                                        <i class="icon icon-arrow-down"></i>
                                    @endif
                                </a>
                            </li>

                            @if ($loop->first)
                                <li
                                    class="menu-item mx-3 {{ request()->is('product-by-category*') || request()->is('product*') ? 'active' : '' }}">
                                    <div class="tf-list-categories">
                                        <a href="#" class="item-link">
                                            Product
                                            <i class="icon icon-arrow-down"></i>
                                        </a>
                                        <div class="list-categories-inner">
                                            <ul>
                                                @foreach (getCategoriesForHeader() as $category)
                                                    {{-- Skip categories that are already a subcategory --}}
                                                    @if (!in_array($category->id, $subCategoryIds))
                                                        <li class="sub-categories2">
                                                            <a href="{{ url('product-by-category/' . $category->slug) }}"
                                                                class="categories-item">
                                                                <span class="inner-left">
                                                                    {{ $category->name }}
                                                                </span>
                                                                @if ($category->subcategories->count())
                                                                    <i class="icon icon-arrRight"></i>
                                                                @endif
                                                            </a>

                                                            {{-- first child  --}}
                                                            @if ($category->subcategories->count())
                                                                <ul class="list-categories-inner ">
                                                                    @foreach ($category->subcategories as $subcategory)
                                                                        <li class="sub-categories3">
                                                                            <a href="
                                                                {{ url('product-by-category/' . $subcategory->slug) }}"
                                                                                class="categories-item">
                                                                                <span class="inner-left">
                                                                                    {{ $subcategory->name }}
                                                                                </span>
                                                                                @if ($subcategory->subcategories->count())
                                                                                    <i class="icon icon-arrRight"></i>
                                                                                @endif
                                                                            </a>

                                                                            {{-- third child --}}
                                                                            @if ($subcategory->subcategories->count())
                                                                                <ul
                                                                                    class="list-categories-inner child-category">
                                                                                    @foreach ($subcategory->subcategories as $subcategory1)
                                                                                        <li class="sub-categories3">
                                                                                            <a href="{{ url('product-by-category/' . $subcategory1->slug) }}"
                                                                                                class="categories-item">
                                                                                                <span
                                                                                                    class="inner-left">
                                                                                                    {{ $subcategory1->name }}
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            @endif
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </nav>
            </div>

            <div class="col-xl-3 col-md-4 col-3 top-header-menu">
                <div class="d-flex justify-content-end align-items-center gap-16 gap-xl-24">
                    {{-- <span class="br-line type-vertical d-none d-sm-block bg-line"></span> --}}
                    <form action="{{ url('product') }}" method="GET"
                        class="form-search d-xl-flex d-none position-relative">
                        <fieldset class="text w-100">
                            <input type="text" placeholder="Search Products" class="style-line-bottom" name="q"
                                tabindex="0" value="" aria-required="true" required=""
                                style="background:{{ $headerColor }};color: white;">
                        </fieldset>
                        <button class="" type="submit">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_19494_2214)">
                                    <path
                                        d="M10.5 18C14.6421 18 18 14.6421 18 10.5C18 6.35786 14.6421 3 10.5 3C6.35786 3 3 6.35786 3 10.5C3 14.6421 6.35786 18 10.5 18Z"
                                        stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path d="M15.8047 15.8037L21.0012 21.0003" stroke="#FFFFFF" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </g>
                                <defs>
                                    <clipPath id="clip0_19494_2214">
                                        <rect width="24" height="24" fill="white"></rect>
                                    </clipPath>
                                </defs>
                            </svg>

                        </button>
                    </form>
                    {{-- <ul class="nav-icon d-xl-none d-flex justify-content-end align-items-center">
                        <li class="nav-search">
                            <a href="#search" data-bs-toggle="modal" class="nav-icon-item">
                                <svg class="icon" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                        stroke="#ffffffff" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path d="M21.35 21.0004L17 16.6504" stroke="#ffffff" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
                        </li>
                    </ul> --}}

                </div>
            </div>

        </div>
    </div>
</header>

@if (request()->is('/'))
    <x-site.header.banner />
@endif


<!-- mobile menu -->


<x-site.header.mobile-sidebar />
<!-- /mobile menu -->


@push('scripts')
    <script>
        // $('document').ready(function() {



        // });

        function viewChild(param) {
            console.log(param);
        }
    </script>
@endpush

<style>
    /* header {
        background: #474B4F !important;
    } */

    .sub-categories3 {
        position: relative;
    }

    .child-category {
        display: none;
        position: absolute;
        top: 0;
        left: 100%;
        z-index: 999;
        padding: 0.5rem;
    }

    .sub-categories3:hover>.child-category {
        display: block;
    }


    #header .box-nav-ul .menu-item.active .item-link,
    #header .box-nav-ul .menu-item:hover .item-link {
        color: #00fc2d !important;
    }

    #header a {
        color: #ffffff !important
    }

    .tf-list-categories .list-categories-inner {
        background-color: {{ $headerColor }} !important;
    }

    .tf-list-categories .categories-item:hover .icon {
        color: #00fc2d !important;
    }

    .top-header-menu .form-search input {
        padding-right: 40px !important;
        padding-left: 14px !important;
    }

    .header-default .wrapper-header {
        min-height: 50px !important;
    }
</style>
