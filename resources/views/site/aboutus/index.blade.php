@extends('layout.app-site')
@section('title', 'About Us')

@section('content')
    @php
        $contactInfo = [
            ['title' => 'Phone', 'value' => '+971 52 482 0440'],
            ['title' => 'Email', 'value' => 'sales@akilsecurity.com'],
            ['title' => 'Address', 'value' => '26 Al Nahdha St - Bur dubai - Al Fahidi - Dubai'],
        ];

        $openTime = [
            ['day' => 'Mon - Sat', 'time' => '9:30am - 9:30pm'],
            ['day' => 'Sunday', 'time' => '9:00am - 5:00pm'],
        ];

        $tabs = [
            [
                'title' => 'Introduction',
                'content' => 'Akil Security and Alarm System L.L.C. is an independent privately owned company for all
                    your security solutions with international branches in UAE, KSA, Oman and India. <br>  <br>
                    Our team of highly trained and skilled professionals has a deep understanding of the latest
                    security technologies and trends, enabling us to offer tailor-made solutions that meet the
                    unique needs of our clients. We provide a wide range of security services, including
                    surveillance systems,access control, fire alarms, intrusion detection, and more.
                    ',
            ],
            [
                'title' => 'Our Mission',
                'content' => 'To generate value from safeguarding, from prevention to response.',
            ],
            [
                'title' => 'Our Vision',
                'content' => 'Together innovatingsecurity to make a safer world possible',
            ],
            [
                'title' => 'Our Goals',
                'content' =>
                    'Increase customer satisfaction <br> Enhance technological capabilities <br> Enhance operational efficiency',
            ],
        ];
    @endphp

    <div class="page-title" style="background-image: url(images/section/page-title.jpg);">
        <div class="container-full">
            <div class="row">
                <div class="col-12">
                    <h3 class="heading text-center">About Our Store</h3>
                    <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                        <li>
                            <a class="link" href="index.html">Homepage</a>
                        </li>
                        <li>
                            <i class="icon-arrRight"></i>
                        </li>
                        <li>
                            <a class="link" href="#">Pages</a>
                        </li>
                        <li>
                            <i class="icon-arrRight"></i>
                        </li>
                        <li>
                            About Our Store
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section class="flat-spacing about-us-main pb_0">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="about-us-features wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
                        <img class=" ls-is-cached lazyloaded" data-src="images/banner/about-us.jpg"
                            src="{{ asset('site/images/about/shop.png') }}" alt="image-team">

                        {{-- <img class=" ls-is-cached lazyloaded" data-src="images/banner/about-us.jpg"
                            src="https://lh3.googleusercontent.com/p/AF1QipN9ZHjtuTEsZnBhUlRwBsAEdNMa_A6CpDI_hTaY=s1360-w1360-h1020"
                            alt="image-team"> --}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-us-content">
                        <h3 class="title wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Akil Security
                            & Alarm System Dubai LLC</h3>


                        <div class="widget-tabs style-3">
                            {{-- Tab Titles --}}
                            <ul class="widget-menu-tab wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                                @foreach ($tabs as $index => $tab)
                                    <li class="item-title {{ $index === 0 ? 'active' : '' }}">
                                        <span class="inner text-button">{{ $tab['title'] }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            {{-- Tab Contents --}}
                            <div class="widget-content-tab wow fadeInUp"
                                style="visibility: visible; animation-name: fadeInUp;">
                                @foreach ($tabs as $index => $tab)
                                    <div class="widget-content-inner {{ $index === 0 ? 'active' : '' }}">
                                        <p>{!! $tab['content'] !!}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>


                        <a href="{{ asset('site/doc/profile.pdf') }}" target="blank" class="tf-btn btn-fill wow fadeInUp"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <span class="text text-button">
                                View Profile
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="flat-spacing">
        <div class="container">

            <div class="heading-section text-center wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                <h3 class="heading">Our Support</h3>
                <p class="subheading text-secondary">Reliable, responsive, and dedicated assistance whenever you need it.
                </p>
            </div>

            <div dir="ltr"
                class="swiper tf-sw-iconbox mt-3 swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden"
                data-preview="4" data-tablet="3" data-mobile-sm="2" data-mobile="1" data-space-lg="30" data-space-md="30"
                data-space="15" data-pagination="1" data-pagination-sm="2" data-pagination-md="3" data-pagination-lg="4">
                <div class="swiper-wrapper" id="swiper-wrapper-da313f61c10153c10" aria-live="polite">
                    <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 4"
                        style="width: 300px; margin-right: 30px;">
                        <div class="tf-icon-box">
                            <div class="icon-box"><span class="icon icon-return"></span></div>
                            <div class="content text-center">
                                <h6>Solutions &amp; Services</h6>
                                <p class="text-secondary">Comprehensive solutions tailored to meet your needs.</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide swiper-slide-next" role="group" aria-label="2 / 4"
                        style="width: 300px; margin-right: 30px;">
                        <div class="tf-icon-box">
                            <div class="icon-box"><span class="icon icon-headset"></span></div>
                            <div class="content text-center">
                                <h6>Online Support</h6>
                                <p class="text-secondary">Get expert assistance anytime, anywhere.</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide" role="group" aria-label="3 / 4" style="width: 300px; margin-right: 30px;">
                        <div class="tf-icon-box">
                            <div class="icon-box"><span class="icon icon-shipping"></span></div>
                            <div class="content text-center">
                                <h6>Product Training Videos</h6>
                                <p class="text-secondary">Learn with ease through step-by-step video guides</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide" role="group" aria-label="4 / 4" style="width: 300px; margin-right: 30px;">
                        <div class="tf-icon-box">
                            <div class="icon-box"><span class="icon icon-sealCheck"></span></div>
                            <div class="content text-center">
                                <h6>Download Center</h6>
                                <p class="text-secondary">Access the latest software, manuals, and updates instantly.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="sw-pagination-iconbox sw-dots type-circle justify-content-center swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal swiper-pagination-lock">
                    <span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button"
                        aria-label="Go to slide 1" aria-current="true"></span>
                </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
        </div>
    </section>

    {{-- <section class="flat-spacing">
        <div class="container">
            <div class="heading-section text-center wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                <h3 class="heading">Meet Our Teams</h3>
                <p class="subheading text-secondary-2">Discover exceptional experiences through testimonials from our
                    satisfied customers.</p>
            </div>
            <div dir="ltr"
                class="swiper tf-sw-latest swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden"
                data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="30" data-space="15"
                data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
                <div class="swiper-wrapper" id="swiper-wrapper-1e6a89b4cd531dab" aria-live="polite"
                    style="transform: translate3d(0px, 0px, 0px);">
                    <div class="swiper-slide swiper-slide-active" style="width: 300px; margin-right: 30px;"
                        role="group" aria-label="1 / 4">
                        <div class="team-item hover-image wow fadeInUp" data-wow-delay="0s"
                            style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">
                            <div class="image">
                                <img class=" ls-is-cached lazyloaded" data-src="images/team/team-1.jpg"
                                    src="images/team/team-1.jpg" alt="image-team">
                            </div>
                            <div class="content">
                                <div>
                                    <h6 class="name"><a class="link text-line-clamp-1" href="#">Annette Black</a>
                                    </h6>
                                    <div class="infor text-caption-1 text-secondary-2">Founder/CEO</div>
                                </div>
                                <ul class="tf-social-icon">
                                    <li><a href="#" class="social-facebook"><i class="icon icon-fb"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide swiper-slide-next" style="width: 300px; margin-right: 30px;" role="group"
                        aria-label="2 / 4">
                        <div class="team-item hover-image wow fadeInUp" data-wow-delay="0.1s"
                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                            <div class="image">
                                <img class=" ls-is-cached lazyloaded" data-src="images/team/team-2.jpg"
                                    src="images/team/team-2.jpg" alt="image-team">
                            </div>
                            <div class="content">
                                <div>
                                    <h6 class="name"><a class="link text-line-clamp-1" href="#">Jane Cooper</a>
                                    </h6>
                                    <div class="infor text-caption-1 text-secondary-2">Sales Director</div>
                                </div>
                                <ul class="tf-social-icon">
                                    <li><a href="#" class="social-facebook"><i class="icon icon-fb"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide" style="width: 300px; margin-right: 30px;" role="group"
                        aria-label="3 / 4">
                        <div class="team-item hover-image wow fadeInUp" data-wow-delay="0.2s"
                            style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                            <div class="image">
                                <img class=" ls-is-cached lazyloaded" data-src="images/team/team-3.jpg"
                                    src="images/team/team-3.jpg" alt="image-team">
                            </div>
                            <div class="content">
                                <div>
                                    <h6 class="name"><a class="link text-line-clamp-1" href="#">Brooklyn
                                            Simmons</a></h6>
                                    <div class="infor text-caption-1 text-secondary-2">Manager</div>
                                </div>
                                <ul class="tf-social-icon">
                                    <li><a href="#" class="social-facebook"><i class="icon icon-fb"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide" role="group" aria-label="4 / 4"
                        style="width: 300px; margin-right: 30px;">
                        <div class="team-item hover-image wow fadeInUp" data-wow-delay="0.3s"
                            style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                            <div class="image">
                                <img class=" ls-is-cached lazyloaded" data-src="images/team/team-4.jpg"
                                    src="images/team/team-4.jpg" alt="image-team">
                            </div>
                            <div class="content">
                                <div>
                                    <h6 class="name"><a class="link text-line-clamp-1" href="#">Theresa Webb</a>
                                    </h6>
                                    <div class="infor text-caption-1 text-secondary-2">Product Manager</div>
                                </div>
                                <ul class="tf-social-icon">
                                    <li><a href="#" class="social-facebook"><i class="icon icon-fb"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="sw-pagination-latest sw-dots type-circle justify-content-center swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal swiper-pagination-lock">
                    <span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button"
                        aria-label="Go to slide 1" aria-current="true"></span>
                </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
        </div>
    </section> --}}

    @push('scripts')
        <script src="{{ asset('assets/js/ajax.js') }}"></script>
        <script src="{{ asset('assets/js/custom-table.js') }}"></script>
        <script src="{{ asset('assets/js/helper.js') }}"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll(".load-btn").forEach(function(btn) {
                    btn.addEventListener("click", function() {
                        btn.classList.add("loading");

                        // Select the span containing the "Submit" text
                        let textSpan = btn.querySelector(".text.text-button > span");
                        if (textSpan) {
                            textSpan.classList.add("d-none"); // Hide the text
                        }

                        // setTimeout(() => {
                        //     btn.classList.remove("loading");
                        //     textSpan.classList.remove("d-none"); // Hide the text
                        // }, 3000); // 3 seconds
                    });
                });
            });

            function eLoadingSite(btnId = 'sbtBtn') {
                let btn = document.querySelector(`#${btnId}`);

                if (btn) {
                    setTimeout(() => {
                        btn.classList.remove("loading");
                        let textSpan = btn.querySelector(".text.text-button > span");
                        if (typeof textSpan !== 'undefined') {
                            textSpan.classList.remove("d-none");
                        }
                    }, 500);
                } else {
                    console.error('Button not found.');
                }
            }


            const formName = 'contact-form'

            function store() {
                // sLoadingSite('sbtBtn')
                // return;

                var form = document.getElementById(formName);
                var url = form.getAttribute('action');
                var method = form.getAttribute('method');
                var payload = new FormData(form);


                const options = {
                    // contentType: 'application/json',
                    contentType: 'multipart/form-data',
                    method: 'POST',
                    headers: {
                        dataType: "json",
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    }
                };
                sendData(
                    url,
                    payload,
                    options,
                    (response) => {
                        // console.log('Success:', response);
                        if (response.status) {
                            // $("#contact-form :input").not("#is_active").val("");
                            alertNotify(response.message, 'success')
                            associateErrors1([], 'contact-form');
                            eLoadingSite('btnLoader')
                        } else {
                            associateErrors1(response.errors, 'contact-form');

                            eLoadingSite('btnLoader')


                            // eLoading('sbtBtn')
                        }
                    },
                    (error) => {
                        console.error('Error:', error);
                    }
                );
            }

            function associateErrors1(errors, formId) {
                let $form = $(`#${formId}`);
                $form.find('fieldset .invalid-msg').text('');
                $form.find('fieldset .frm').removeClass('is-invalid');

                Object.keys(errors).forEach(function(fieldName) {

                    let $group = $form.find('[name="' + fieldName + '"]');
                    $group.addClass('is-invalid');
                    $group.closest('fieldset').find('.invalid-msg').text(errors[fieldName][0]);
                });
            }

            function alertNotify(msg, status) {

                let sts = status || 'success';

                const arr = {
                    success: 'bg-success',
                    error: 'bg-danger',
                    warning: 'bg-info',
                }
                console.log(arr[sts]);
                Toastify({
                    text: msg || '',
                    duration: 3000,
                    newWindow: true,
                    close: false,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    className: arr[sts],
                    // style: {
                    //     background: "linear-gradient(to right, #00b09b, #96c93d)",
                    // },
                    onClick: function() {} // Callback after click
                }).showToast();
            }
        </script>
    @endpush
@endsection
