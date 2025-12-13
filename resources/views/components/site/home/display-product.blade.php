@props([
    'products' => $products,
])

<section class="flat-spacing-4">
    <div class="container">

        <div class="heading-section text-center wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
            <h3 class="heading">Explore our latest products</h3>
            <p class="subheading text-secondary">
                Discover innovative and high-quality products designed to meet your needs.
            </p>
        </div>

        <div class="grid-card-product tf-grid-layout lg-col-3 md-col-2">
            @foreach ($products as $item)
                <div class="column-card-product">
                    <div class="list-card-product">
                        <div class="card-product list-st-2 wow fadeInUp">
                            <div class="card-product-wrapper" style="background-color:#F7F7F7;border: 1px solid #ddd;">
                                <a href="{{ url('product/' . $item->id) }}" class="product-img">
                                    <img class="lazyload img-product" data-src="{{ $item->mainImage->image }}"
                                        src="{{ $item->mainImage->image }}" alt="image-product">

                                    <img class="lazyload img-hover" data-src="{{ $item->mainImage->image }}"
                                        src="{{ $item->mainImage->image }}" alt="image-product">

                                    {{-- <img class="lazyload img-product"
                                        data-src="{{ asset('site/images/products/electronic/electronic-21.jpg') }}"
                                        src="{{ asset('site/images/products/electronic/electronic-21.jpg') }}"
                                        alt="image-product">
                                    <img class="lazyload img-hover"
                                        data-src="{{ asset('site/images/products/electronic/electronic-22.jpg') }}"
                                        src="{{ asset('site/images/products/electronic/electronic-22.jpg') }}"
                                        alt="image-product"> --}}

                                </a>
                                <div class="on-sale-wrap"><span class="on-sale-item">new</span></div>
                            </div>
                            <div class="card-product-info">
                                <a href="{{ url('product/' . $item->id) }}" class="title link">
                                    {{ $item->name ?? '' }}
                                </a>
                                <div class="bottom">
                                    <div class="inner-left">
                                        <div class="box-rating">
                                            <span class="text-caption-1 text-secondary">
                                                {{ Str::limit($item->short_desc ?? defualtProductDesc(), 80, '...') }}
                                            </span>
                                        </div>
                                        <span class="price py-4">
                                            {{ $item->category?->name ?? 'Biometric' }}
                                        </span>
                                    </div>
                                    <a href="{{ url('product/' . $item->id) }}" class="box-icon">
                                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1.5 12C3.83333 6.66667 7.83333 3 12.5 3C17.1667 3 21.1667 6.66667 23.5 12C21.1667 17.3333 17.1667 21 12.5 21C7.83333 21 3.83333 17.3333 1.5 12Z"
                                                stroke="#181818" stroke-width="1.6" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M12.5 15C14.433 15 16 13.433 16 11.5C16 9.567 14.433 8 12.5 8C10.567 8 9 9.567 9 11.5C9 13.433 10.567 15 12.5 15Z"
                                                stroke="#181818" stroke-width="1.6" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>

                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
