@php
    $subCategoryIds = getCategoriesForHeader()->flatMap->subcategories->pluck('id')->toArray();

    $menuItems = [
        ['name' => 'Home', 'url' => url('/'), 'pattern' => '/'],
        ['name' => 'Software', 'url' => url('solution-by-type/' . 'software'), 'pattern' => 'software'],
        ['name' => 'Download', 'url' => url('download'), 'pattern' => 'download*'],
        ['name' => 'Contact Us', 'url' => url('contact'), 'pattern' => 'contact'],
        ['name' => 'About Us', 'url' => url('aboutus'), 'pattern' => 'aboutus'],
    ];
@endphp

<div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu">
    <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
    <div class="mb-canvas-content">
        <div class="mb-body">
            <div class="mb-content-top">
                <form action="{{ url('product') }}" class="form-search">
                    <fieldset class="text">
                        <input type="text" placeholder="What are you looking for?" class="" name="q"
                            tabindex="0" value="" aria-required="true" required="">
                    </fieldset>
                    <button class="" type="submit">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                stroke="#181818" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M20.9984 20.9999L16.6484 16.6499" stroke="#181818" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>
                </form>
                <ul class="nav-ul-mb" id="wrapper-menu-navigation">
                    @foreach ($menuItems as $key => $item)

                        @if ($loop->index == 1)
                            <li class="nav-mb-item">
                                <a href="#dropdown-menu-four" class="mb-menu-link collapsed" data-bs-toggle="collapse"
                                    aria-expanded="false" aria-controls="dropdown-menu-four">
                                    <span>Solutions</span>
                                    <span class="btn-open-sub"></span>
                                </a>
                                <div id="dropdown-menu-four" class="collapse" style="">
                                    <ul class="sub-nav-menu">

                                        @foreach (getSolutionForHeader() as $solution)
                                            <li><a href="{{ url('solution-by-type/' . $solution['id']) }}"
                                                    class="sub-nav-link">
                                                    {{ $solution['name'] }}
                                                </a>
                                            </li>
                                        @endforeach

                                        {{--
                                        <li><a href="blog-default.html" class="sub-nav-link">Blog Default</a></li>
                                        <li><a href="blog-list.html" class="sub-nav-link">Blog List</a></li>
                                        <li><a href="blog-grid.html" class="sub-nav-link">Blog Grid</a></li>
                                        <li><a href="blog-detail.html" class="sub-nav-link">Blog Detail 1</a></li>
                                        <li><a href="blog-detail-02.html" class="sub-nav-link">Blog Detail 2</a></li> --}}
                                    </ul>
                                </div>

                            </li>
                        @endif

                        <li class="nav-mb-item active">
                            <a href="{{ $item['url'] }}" class="  mb-menu-link" aria-controls="dropdown-menu-one">
                                <span>{{ $item['name'] }}</span>
                            </a>
                        </li>
                        @if ($loop->first)
                            <li class="nav-mb-item">
                                <a href="#dropdown-menu-two" class="collapsed mb-menu-link" data-bs-toggle="collapse"
                                    aria-expanded="true" aria-controls="dropdown-menu-two">
                                    <span>Product</span>
                                    <span class="btn-open-sub"></span>
                                </a>
                                <div id="dropdown-menu-two" class="collapse">
                                    <ul class="sub-nav-menu">
                                        @foreach (getCategoriesForHeader() as $category)
                                            @if (!in_array($category->id, $subCategoryIds))
                                                <li>
                                                    <a href="#sub-cat-one-{{ $category->id }}"
                                                        class="sub-nav-link collapsed" data-bs-toggle="collapse"
                                                        aria-expanded="true"
                                                        aria-controls="sub-cat-one-{{ $category->id }}">
                                                        <span>{{ $category->name }}</span>
                                                        @if ($category->subcategories->count())
                                                            <span class="btn-open-sub"></span>
                                                        @endif
                                                    </a>
                                                    <div id="sub-cat-one-{{ $category->id }}" class="collapse">
                                                        @if ($category->subcategories->count())
                                                            <ul class="sub-nav-menu sub-menu-level-2">
                                                                @foreach ($category->subcategories as $subcategory)
                                                                    <li>
                                                                        <a href="{{ url('product-by-category/' . $subcategory->slug) }}"
                                                                            class="sub-nav-link">
                                                                            {{ $subcategory->name }}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="mb-other-content">
                <div class="mb-notice">
                    <a href="contact.html" class="text-need">Need Help?</a>
                </div>
                <div class="mb-contact">
                    <p class="text-caption-1">26 Al Nahdha St - Bur dubai - Al Fahidi - Dubai</p>
                </div>
                <ul class="mb-info">
                    <li>
                        <i class="icon icon-mail"></i>
                        <p>sales@akilsecurity.com</p>
                    </li>
                    <li>
                        <i class="icon icon-phone"></i>
                        <p>+971 52 482 0440</p>
                    </li>
                </ul>
            </div>
        </div>
        {{-- <div class="mb-bottom">
            <div class="bottom-bar-language">
                <div class="tf-currencies">
                    <select class="image-select center style-default type-currencies">
                        <option selected data-thumbnail="images/country/us.svg">USD</option>
                        <option data-thumbnail="images/country/vn.svg">VND</option>
                    </select>
                </div>
                <div class="tf-languages">
                    <select class="image-select center style-default type-languages">
                        <option>English</option>
                        <option>Vietnam</option>
                    </select>
                </div>
            </div>
        </div> --}}
    </div>
</div>

<style>
    .offcanvas {
        background: #34444C;
        color: #fff;
    }

    .offcanvas ul li a span {
        color: #fff !important;
    }

    .text-need {
        color: #fff !important;
    }

    .sub-nav-link {
        color: #fff !important;

    }

    .nav-ul-mb .btn-open-sub:after,
    .nav-ul-mb .btn-open-sub::before {
        background-color: #fff !important;
    }
</style>
