@extends('layout.app-site')

@section('content')
    <x-site.component.page-title title="Search" :breadcrumbs="[['label' => 'Product', 'url' => route('product.index')], ['label' => 'Search']]" />

    <section class="flat-spacing page-search-inner pb-0 pt-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <form action="{{ url('product') }}" method="GET" class="form-search">
                        <fieldset class="text">
                            <input type="text" placeholder="Searching..." class="" name="q" tabindex="0"
                                value="{{ request('q') }}" aria-required="true">
                        </fieldset>
                        <button class="" type="submit">
                            <svg class="icon" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                    stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M21.35 21.0004L17 16.6504" stroke="#181818" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="flat-spacing pt-4">
        <div class="container">
            <div class="wrapper-control-shop">
                @if (request()->has('q') && request('q') !== '')
                    <div class="meta-filter-shop">
                        <div id="product-count-grid" class="count-text">
                            <span class="count">{{ $products->count() }}</span> Products Found
                        </div>
                        <a href="{{ url()->current() }}" id="remove-all" class="remove-all-filters text-btn-uppercase">
                            REMOVE '{{ request('q') }}'
                            <i class="icon icon-close"></i>
                        </a>
                    </div>
                @endif

                <div class="tf-grid-layout wrapper-shop tf-col-7" id="gridLayout">
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

    <style>
        .meta-filter-shop a {
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
            background-color: var(--main);
            color: var(--white);
            padding: 15px 32px;
            border-radius: 99px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            font-size: 16px;
            line-height: 26px;
            font-weight: 600;
            text-transform: capitalize;
        }

        a.text-btn-uppercase {
            font-size: 12px;
            line-height: 20px;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.1em;
        }
    </style>
@endsection
