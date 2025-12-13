@props([
    'products' => [],
])

<section>
    <div class="container">
        <div class="flat-img-with-text">
            <div class="banner banner-left wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
                <img src="{{ asset('site/images/slider/a3.png') }}" alt="banner"
                    style="transform: scaleX(-1);width:475px;height:475px">
                {{-- <img src="{{ asset('site/images/banner/banner-w-text1.jpg') }}" alt="banner"> --}}
            </div>
            <div class="banner-content">
                <div class="content-text wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <h3 class="title text-center fw-5">Special Offer! <br> This Week Only</h3>
                    <p class="desc">Reserved for special occasions</p>
                </div>
                <a href="shop-default-grid.html" class="tf-btn btn-fill wow fadeInUp"
                    style="visibility: visible; animation-name: fadeInUp;"><span class="text">Explore
                        Collection</span><i class="icon icon-arrowUpRight"></i></a>
            </div>
            <div class="banner banner-right wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                <img src="{{ asset('site/images/slider/a1.png') }}" alt="banner">
            </div>
        </div>
    </div>
</section>
