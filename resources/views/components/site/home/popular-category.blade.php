@props([
    'categories' => $categories,
])

<section class="flat-spacing-4">
    <div class="container">
        <div class="heading-section text-center wow fadeInUp">
            <h3 class="heading">Popular Categories</h3>
        </div>
        <div class="flat-collection-circle wow fadeInUp" data-wow-delay="0.1s">
            <div dir="ltr" class="swiper tf-sw-categories" data-preview="5" data-tablet="4" data-mobile-sm="2"
                data-mobile="2" data-space-lg="30" data-space-md="20" data-space="100" data-pagination="2"
                data-pagination-md="4" data-pagination-lg="1">
                <div class="swiper-wrapper">

                    @foreach ($categories as $item)
                        <div class="swiper-slide">
                            <div class="collection-circle1 hover-img">
                                <a href="{{ url('product-by-category/' . $item->slug) }}" class="img-style">
                                    <div class="image-container">
                                        <img data-src="{{ $item->img ?? '' }}" src="{{ $item->img ?? '' }}"
                                            alt="collection-img">
                                    </div>
                                </a>
                                <div class="collection-content text-center">
                                    <div>
                                        <a href="{{ url('product-by-category/' . $item->slug) }}" class="cls-title">
                                            <h6 class="text">{{ $item->name ?? '' }}</h6>
                                            <i class="icon icon-arrowUpRight"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex d-lg-none sw-pagination-categories sw-dots type-circle justify-content-center">
                </div>

            </div>
            <div class="nav-prev-categories d-none d-lg-flex nav-sw style-line nav-sw-left"><i
                    class="icon icon-arrLeft"></i></div>
            <div class="nav-next-categories d-none d-lg-flex nav-sw style-line nav-sw-right"><i
                    class="icon icon-arrRight"></i></div>
        </div>
    </div>
</section>

<style>
    .image-container {
        width: 220px;
        /* Set the required size */
        height: 220px;
        /* Same as width to make it a perfect square */
        /* border-radius: 50%; */
        border-radius: 5%;
        /* Makes the container circular */
        overflow: hidden;
        /* Ensures the image does not overflow */
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #ddd;
        border: 1px solid #ddd;
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;

        transition: opacity 0.5s ease, transform 2s cubic-bezier(0, 0, 0.44, 1.18);
        /* Ensures the image covers the whole area without distortion */
    }

    .hover-img:hover .img-style .image-container>img {
        transform: scale(1.06);
    }
</style>
