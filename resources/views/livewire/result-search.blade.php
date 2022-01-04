<main id="main" class="main-site left-sidebar">

    <div class="container">



        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">home</a></li>
                <li class="item-link"><span>Digital & Electronics</span></li>
            </ul>
        </div>
        @if(session()->has('message'))
            <div class="alert alert-warning">
                <strong>Success {{\Illuminate\Support\Facades\Session::get('message')}}</strong>
            </div>
        @endif
        <div class="row">

            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">

                <div class="banner-shop">
                    <a href="#" class="banner-link">
                        <figure><img src="assets/images/shop-banner.jpg" alt=""></figure>
                    </a>
                </div>

                <div class="wrap-shop-control">

                    <h1 class="shop-title">Digital & Electronics</h1>

                    <div class="wrap-right">

                        <div class="sort-item orderby mr-6">
                            <select name="orderby" class="use-chosen" wire:model="sort">
                                <option value="default">Default</option>
                                <option value="date">Sort by newness</option>
                                <option value="price">Sort by price: low to high</option>
                                <option value="price-desc">Sort by price: high to low</option>
                            </select>
                        </div>



                        <div class="change-display-mode">
                            <a href="#" class="grid-mode display-mode active"><i class="fa fa-th"></i>Grid</a>
                            <a href="list.html" class="list-mode display-mode"><i class="fa fa-th-list"></i>List</a>
                        </div>

                    </div>

                </div><!--end wrap shop control-->

                <div class="row">
                    <style>
                        .product-wish {
                            position: absolute;
                            top: 10%;
                            left: 0;
                            z-index: 99;
                            right: 30px;
                            text-align: right;
                            padding-top: 0;
                        }

                        .product-wish .fa {
                            font-size: 32px;
                            color: #cbcbcb;
                        }

                        .product-wish .fa:hover {
                            color: #f24747;
                        }

                        .fill-heart {
                            color: #f24747 !important;
                        }
                    </style>
                    <ul class="product-list grid-products equal-container">
                        @php
                            $wishItems = Cart::instance('wishlist')->content()->pluck('id');
                        @endphp
                        @foreach($results as $product)

                            <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                                <div class="product product-style-3 equal-elem ">
                                    <div class="product-thumnail">
                                        <a href="{{route('detail',$product->slug)}}">
                                            <figure class="imgShop"><img
                                                    src="{{asset('assets/images/products/'.$product->image)}}"
                                                    alt="{{$product->name}}"></figure>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="{{route('detail',$product->slug)}}"
                                           class="product-name"><strong>{{$product->name}}</strong></a>
                                        <div class="wrap-price"><span
                                                class="product-price">{{$product->regular_price}}</span></div>
                                        <a href="#" class="btn add-to-cart"
                                           wire:click.prevent="store({{$product->id}},'{{$product->name}}',{{$product->regular_price}})">Add
                                            To Cart</a>
                                        <div class="product-wish">
                                            @if($wishItems->contains($product->id))
                                                <a href="#" wire:click.prevent="removeWishlist({{$product->id}})"><i
                                                        class="fa fa-heart fill-heart"></i></a>
                                            @else
                                                <a href="#"
                                                   wire:click.prevent="addToWishlist({{$product->id}},'{{$product->name}}',{{$product->regular_price}})"><i
                                                        class="fa fa-heart "></i></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                </div>

                <div class="wrap-pagination-info">
                    {{--                    {{$products->links()}}--}}
                </div>
            </div><!--end main products area-->



        </div><!--end row-->
    </div><!--end container-->

</main>
