<section class="tf-slideshow slider-style2 slider-effect-fade">
    <div dir="ltr" class="swiper tf-sw-slideshow" data-preview="1" data-tablet="1" data-mobile="1" data-centered="false"
        data-space="0" data-space-mb="0" data-loop="true" data-auto-play="true">
        <div class="swiper-wrapper">

            @php
                $imageFiles = [6, 4, 7, 8, 9];
                // $imageFiles = [6, 5, 2, 3, 4, 1];
            @endphp

            @foreach ($imageFiles as $i)
                @php
                    $isBlckBg = in_array($i, [4, 5, 6, 7, 8, 9]);
                @endphp

                <div class="swiper-slide">
                    <div class="wrap-slider">
                        <img src="{{ asset("site/images/slider/a$i.png") }}" alt="fashion-slideshow">
                        <div class="box-content d-none d-sm-none  d-md-block d-lg-block">
                            <div class="container">
                                <div class="content-slider">
                                    <div class="box-title-slider">
                                        <div @class([
                                            'fade-item fade-item-1 heading title-display',
                                            'text-white' => $isBlckBg,
                                        ])>
                                            {{-- Summer 2024 <br> Collection --}}
                                            Smart Security <br> Solutions & Systems
                                        </div>
                                        <p
                                            class="fade-item fade-item-2 {{ $isBlckBg ? 'text-white' : '' }} body-text-1">
                                            Advanced security with AI, automation, surveillance, and access control
                                            systems.
                                        </p>
                                    </div>
                                    <div class="fade-item fade-item-3 box-btn-slider">
                                        <a href="{{ url('product') }}" class="tf-btn btn-fill">
                                            <span class="text">Explore Products</span>
                                            <i class="icon icon-arrowUpRight"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="wrap-pagination">
        <div class="container">
            <div class="sw-dots sw-pagination-slider type-circle justify-content-center"></div>
        </div>
    </div>
</section>


{{-- <section class="tf-marquee">
    <div class="marquee-wrapper">
        <div class="initial-child-container">
            <div class="marquee-child-item">
                <p class="text-btn-uppercase">Free shipping on all orders over $20.00</p>
            </div>
            <div class="marquee-child-item">
                <span class="icon icon-lightning-line"></span>
            </div>
            <div class="marquee-child-item">
                <p class="text-btn-uppercase">Returns are free within 14 days</p>
            </div>
            <div class="marquee-child-item">
                <span class="icon icon-lightning-line"></span>
            </div>
            <!-- 2 -->
            <div class="marquee-child-item">
                <p class="text-btn-uppercase">Free shipping on all orders over $20.00</p>
            </div>
            <div class="marquee-child-item">
                <span class="icon icon-lightning-line"></span>
            </div>
            <div class="marquee-child-item">
                <p class="text-btn-uppercase">Returns are free within 14 days</p>
            </div>
            <div class="marquee-child-item">
                <span class="icon icon-lightning-line"></span>
            </div>
            <!-- 3 -->
            <div class="marquee-child-item">
                <p class="text-btn-uppercase">Free shipping on all orders over $20.00</p>
            </div>
            <div class="marquee-child-item">
                <span class="icon icon-lightning-line"></span>
            </div>
            <div class="marquee-child-item">
                <p class="text-btn-uppercase">Returns are free within 14 days</p>
            </div>
            <div class="marquee-child-item">
                <span class="icon icon-lightning-line"></span>
            </div>
            <!-- 4 -->
            <div class="marquee-child-item">
                <p class="text-btn-uppercase">Free shipping on all orders over $20.00</p>
            </div>
            <div class="marquee-child-item">
                <span class="icon icon-lightning-line"></span>
            </div>
            <div class="marquee-child-item">
                <p class="text-btn-uppercase">Returns are free within 14 days</p>
            </div>
            <div class="marquee-child-item">
                <span class="icon icon-lightning-line"></span>
            </div>
            <!-- 5 -->
            <div class="marquee-child-item">
                <p class="text-btn-uppercase">Free shipping on all orders over $20.00</p>
            </div>
            <div class="marquee-child-item">
                <span class="icon icon-lightning-line"></span>
            </div>
            <div class="marquee-child-item">
                <p class="text-btn-uppercase">Returns are free within 14 days</p>
            </div>
            <div class="marquee-child-item">
                <span class="icon icon-lightning-line"></span>
            </div>
            <!-- 6 -->
            <div class="marquee-child-item">
                <p class="text-btn-uppercase">Free shipping on all orders over $20.00</p>
            </div>
            <div class="marquee-child-item">
                <span class="icon icon-lightning-line"></span>
            </div>
            <div class="marquee-child-item">
                <p class="text-btn-uppercase">Returns are free within 14 days</p>
            </div>
            <div class="marquee-child-item">
                <span class="icon icon-lightning-line"></span>
            </div>
        </div>
    </div>
</section> --}}

<section class="tf-marquee d-none d-sm-none d-md-block d-lg-block">
    <div class="marquee-wrapper">
        <div class="initial-child-container"></div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const messages = [
            "Smart threat detection and automated responses",
            "HD cameras, motion sensors, and facial recognition",
            "Biometric entry and remote access control",
            "Seamless security with connected devices",
            "Instant alerts and remote system access",
        ];

        const container = document.querySelector(".initial-child-container");

        for (let i = 0; i < 2; i++) { // Adjust the number of repetitions as needed
            messages.forEach((msg, index) => {
                // Create text item
                const textItem = document.createElement("div");
                textItem.classList.add("marquee-child-item");
                textItem.innerHTML = `<p class="text-btn-uppercase">${msg}</p>`;
                container.appendChild(textItem);

                // Create icon item
                if (index < messages.length - 1 || i < 5) {
                    const iconItem = document.createElement("div");
                    iconItem.classList.add("marquee-child-item");
                    iconItem.innerHTML = `<span class="icon icon-lightning-line"></span>`;
                    container.appendChild(iconItem);
                }
            });
        }
    });
</script>

<style>
    @media (max-width: 576px) {
        /* sm */

        .tf-slideshow .wrap-slider {
            height: 150px;
        }
    }
</style>
