@extends('layout.app-site')
@section('title', 'Product')

@section('content')

    @php
        $lable = ucwords(str_replace('-', ' ', request()->route('type')));
        $categoryName = $lable == 'Software' ? 'Software' : 'Solution';
    @endphp

    <x-site.component.page-title title="Solution" :breadcrumbs="[['label' => $categoryName, 'url' => '#'], ['label' => $lable]]" />

    <div class="main-content-page">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tf-grid-layout md-col-4">
                        @foreach ($solutions as $sol)
                            @php
                                if (isset($sol) && !empty($sol->contents[0])) {
                                    $thumpImg = asset('storage/' . $sol->contents[0]->content) ?? '';
                                } else {
                                    $thumpImg = null;
                                }
                                // $thumpImg = asset('storage/' . $sol->contents[0]->content) ?? '';
                            @endphp
                            <div class="wg-blog style-1 hover-image">
                                <a href="{{ url('solution-by-type-show/' . $sol->id) }}">
                                    <div class="image border rounded">
                                        <img class="lazyload" data-src="{{ $thumpImg }}" src="{{ $thumpImg }}"
                                            alt="">
                                    </div>
                                </a>

                                <div class="content">
                                    <div class="meta">
                                        <div class="meta-item gap-8">
                                            <div class="icon">
                                                <i class="icon-calendar"></i>
                                            </div>
                                            <p class="text-caption-1">
                                                {{ date('d M Y', strtotime($sol->created_at)) }}
                                            </p>
                                        </div>
                                        <div class="meta-item gap-8">
                                            <div class="icon">
                                                <i class="icon-user"></i>
                                            </div>
                                            <p class="text-caption-1">
                                                <a class="link" href="{{ url('solution-by-type-show/' . $sol->id) }}">
                                                    {{ Str::limit(str_replace('-', ' ', $sol->solution_type), 15) }}
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="title fw-5">
                                            <a class="link" href="{{ url('solution-by-type-show/' . $sol->id) }}">
                                                {{-- How Technology is Transforming the Industry --}}
                                                {{ $sol->title }}
                                            </a>
                                        </h6>
                                    </div>
                                </div>

                            </div>
                        @endforeach

                        {{-- <ul class="wg-pagination justify-content-center">
                            <li><a href="#" class="pagination-item text-button">1</a></li>
                            <li class="active">
                                <div class="pagination-item text-button">2</div>
                            </li>
                            <li><a href="#" class="pagination-item text-button">3</a></li>
                            <li><a href="#" class="pagination-item text-button"><i class="icon-arrRight"></i></a>
                            </li>
                        </ul> --}}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
