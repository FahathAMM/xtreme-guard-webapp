@extends('layout.app-site')

@section('content')
    <x-site.component.page-title :title="$category->name" :breadcrumbs="[['label' => 'Product', 'url' => route('product.index')], ['label' => $category->name]]" />

    <section class="flat-spacing">
        <div class="container">

            <div class="tf-shop-control">
                <div class="tf-control-filter">
                    <a href="#filterShop" data-bs-toggle="offcanvas" aria-controls="filterShop" class="tf-btn-filter"><span
                            class="icon icon-filter"></span><span class="text">Filters</span></a>
                    <div class="d-none d-lg-flex shop-sale-text">
                        <i class="icon icon-checkCircle"></i>
                        <p class="text-caption-1">Shop sale items only</p>
                    </div>
                </div>
                <ul class="tf-control-layout">
                </ul>
                <div class="tf-control-sorting">
                    <p class="d-none d-lg-block text-caption-1">Sort by:</p>
                    <div class="tf-dropdown-sort" data-bs-toggle="dropdown">
                        <div class="btn-select">
                            <span class="text-sort-value">Best selling</span>
                            <span class="icon icon-arrow-down"></span>
                        </div>
                        <div class="dropdown-menu">
                            <div class="select-item" data-sort-value="best-selling">
                                <span class="text-value-item">Best selling</span>
                            </div>
                            <div class="select-item" data-sort-value="a-z">
                                <span class="text-value-item">Alphabetically, A-Z</span>
                            </div>
                            <div class="select-item" data-sort-value="z-a">
                                <span class="text-value-item">Alphabetically, Z-A</span>
                            </div>
                            <div class="select-item" data-sort-value="price-low-high">
                                <span class="text-value-item">Price, low to high</span>
                            </div>
                            <div class="select-item" data-sort-value="price-high-low">
                                <span class="text-value-item">Price, high to low</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="wrapper-control-shop">
                <div class="meta-filter-shop">
                    <div id="product-count-grid" class="count-text"></div>
                    <div id="product-count-list" class="count-text"></div>
                    <div id="applied-filters"></div>
                    <button id="remove-all" class="remove-all-filters text-btn-uppercase" style="display: none;">REMOVE
                        ALL <i class="icon icon-close"></i></button>
                </div>

                <div class="tf-grid-layout wrapper-shop tf-col-6" id="gridLayout">


                    @foreach ($products as $prodduct)
                        <x-site.component.product-card :products="$prodduct" />
                    @endforeach


                    <!-- pagination -->
                    <ul class="wg-pagination justify-content-center">
                        <li><a href="#" class="pagination-item text-button">1</a></li>
                        <li class="active">
                            <div class="pagination-item text-button">2</div>
                        </li>
                        <li><a href="#" class="pagination-item text-button">3</a></li>
                        <li><a href="#" class="pagination-item text-button"><i class="icon-arrRight"></i></a>
                        </li>
                    </ul>
                </div>
            </div>


        </div>
    </section>
@endsection
