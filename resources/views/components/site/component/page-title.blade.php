{{-- <div class="page-title" style="background: #eceff2;;">
    <div class="container-full">
        <div class="row">
            <div class="col-12">
                <h3 class="heading text-center">{{ $category->name }}</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li>
                        <a class="link" href="#">Product</a>
                    </li>
                    <li>
                        <i class="icon-arrRight"></i>
                    </li>
                    <li>
                        {{ $category->name }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div> --}}


<div class="page-title" style="background: #eceff2;">
    <div class="container-full">
        <div class="row">
            <div class="col-12">
                <h3 class="heading text-center">{{ $title }}</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    @foreach ($breadcrumbs as $breadcrumb)
                        <li>
                            @if (isset($breadcrumb['url']))
                                <a class="link" href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a>
                            @else
                                {{ $breadcrumb['label'] }}
                            @endif
                        </li>
                        @if (!$loop->last)
                            <li>
                                <i class="icon-arrRight"></i>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>


<style>
    @media (min-width: 992px) {
        .page-title {
            padding: 20px 0 20px;
        }
    }
</style>
