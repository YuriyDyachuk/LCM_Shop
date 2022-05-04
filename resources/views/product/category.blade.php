@extends('layouts.master')

@section('title') {{ $pageTitle }} @endsection

@section('content')

<div class="container">

    <ul class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
        <li class="breadcrumb " itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a href="{{ route('home.index') }}" class="breadcrumb-label" itemprop="item"><span
                    itemprop="name">Home</span></a>
            <meta itemprop="position" content="0" />
        </li>
        <li class="breadcrumb is-active" itemprop="itemListElement" itemscope
            itemtype="http://schema.org/ListItem">
            <a href="#" class="breadcrumb-label"
               itemprop="item"><span itemprop="name">{{ $pageTitle }}</span></a>
            <meta itemprop="position" content="1" />
        </li>
    </ul>
    <h1 class="page-heading">{{ $pageTitle }}</h1>

    <!-- snippet location categories -->
    <div class="page">

        <main class="page-content 12345" id="product-listing-container">

            <ul class="productGrid">
                @foreach($items as $item)
                <li class="product">
                    <article class="card ">
                        <figure class="card-figure">
                            <a href="{{ $item['url'] }}">
                                <div class="card-img-container">
                                    <img class="card-image lazyload" data-sizes="auto"
                                         src="{{ asset('assets/img/loading.svg') }}"
                                         style="width: 100%"
                                        @if (!empty($item['img']))
                                            data-src="{{ asset('uploads/products/'.$item['img'].'') }}"
                                        @else
                                            data-src="{{ asset('assets/img/products/500x659/StudentMembership__07999.1547237277.png') }}"
                                         @endif
                                         alt="{{ $item['name'] }}" title="{{ $item['name'] }}">
                                </div>
                            </a>
                        </figure>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="{{ $item['url'] }}">
                                    {{ $item['name'] }}
                                </a>
                            </h4>

                            <div class="card-text" data-test-info-type="price">
                                <div class="price-section price-section--withoutTax">
                                    <span class="price-label">

                                    </span>
                                    <span class="price-now-label" style="display: none;">
                                        Now:
                                    </span>
                                    <span data-product-price-without-tax
                                          class="price price--withoutTax">${{ $item['price'] }}</span>
                                </div>
                            </div>
                        </div>
                        <figcaption class="card-figcaption">
                            <div class="card-figcaption-body">
                                <a href="{{ $item['url'] }}" class="button button--small card-figcaption-button">View</a>
                                <a href="{{route('product.cart.qty', ['id' => $item['id'] ])}}" type="submit" class="button button--small card-figcaption-button">
                                    Add to Cart
                                </a>

                            </div>
                        </figcaption>
                    </article>
                </li>
                @endforeach

                @if(empty($items))
                    <li class="product">List is empty</li>
                @endif
            </ul>

            <div class="pagination">
                <ul class="pagination-list">

                </ul>
            </div>
        </main>
    </div>

</div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('assets/vendor/lazysizes/lazysizes.min.js') }}"></script>
@endsection
