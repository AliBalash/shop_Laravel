@section('title') {{'Detail'}} @endsection
<div>
    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="#" class="link">home</a></li>
            <li class="item-link"><span>detail</span></li>
        </ul>
    </div>
    <div class="row">

        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area" wire:ignore.self>
            <div class="wrap-product-detail">
                <div class="detail-media">
                    <div class="product-gallery" wire:ignore>
                        <ul class="slides">

                            <li data-thumb="{{asset('assets/images/products').'/'.$product->image}}">
                                <img src="{{asset('assets/images/products').'/'.$product->image}}"
                                     alt="{{$product->name}}"/>
                            </li>

                            @if($product->images)
                                @php
                                $images = explode(',',$product->images);
                                @endphp
                                @foreach($images as $image)
                                    @if($image)
                                    <li data-thumb="{{asset('assets/images/products').'/'.$image}}">
                                        <img src="{{asset('assets/images/products').'/'.$image}}"
                                             alt="{{$product->name}}"/>
                                    </li>
                                    @endif
                                @endforeach
{{----}}
                            @endif

                        </ul>
                    </div>
                </div>
                <div class="detail-info">
                    <div class="product-rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <a href="#" class="count-review">(05 review)</a>
                    </div>
                    <h2 class="product-name">{{$product->name}}</h2>
                    <div class="short-desc">
                        {!!$product->short_description!!}
                    </div>
                    <div class="wrap-social">
                        <a class="link-socail" href="#"><img src="{{asset('assets/images/social-list.png')}}"
                                                             alt=""></a>
                    </div>
                    @if($product->sale_price)
                        <div class="wrap-price">
                            <ins><p class="product-price">${{$product->sale_price}}</p></ins>
                            <del><p class="product-price">${{$product->regular_price}}</p></del>
                        </div>
                    @else
                        <div class="wrap-price">
                            <p class="product-price">${{$product->regular_price}}</p>
                        </div>
                    @endif
                    <div class="stock-info in-stock">
                        <p class="availability">Availability: <b>{{$product->stock_status}}</b></p>
                    </div>
                    <div class="quantity">
                        <span>Quantity:</span>
                        <div class="quantity-input">
                            <input type="text" name="product-quatity" wire:model="qty"
                                   pattern="[0-9]*">

                            <a class="btn btn-reduce" wire:click.prevent="decreaseQty()" href="#"></a>
                            <a class="btn btn-increase" wire:click.prevent="increaseQty()" href="#"></a>
                        </div>
                    </div>
                    <div class="wrap-butons">
                        <a href="#" class="btn add-to-cart"
                           wire:click.prevent="store({{$product->id}},'{{$product->name}}',{{$product->regular_price}})">Add
                            to Cart</a>
                        <div class="wrap-btn">
                            <a href="#" class="btn btn-compare">Add Compare</a>
                            <a href="#" class="btn btn-wishlist">Add Wishlist</a>
                        </div>
                    </div>
                </div>
                <div class="advance-info">
                    <div class="tab-control normal">
                        <a href="#description" class="tab-control-item active">description</a>

                        <a href="#add_infomation" class="tab-control-item">Addtional Infomation</a>
                        <a href="#" class="tab-control-item" data-toggle="modal" data-target="#reviewModal">Comment and
                            Rating
                        </a>
                    </div>
                    <div class="tab-contents ">
                        <div class="tab-content-item active" id="description">
                            <p>{!!$product->description!!}</p>
                        </div>
                        <div class="tab-content-item " id="add_infomation">
                            <table class="shop_attributes">
                                <tbody>
                                <tr>
                                    <th>Weight</th>
                                    <td class="product_weight">1 kg</td>
                                </tr>
                                <tr>
                                    <th>Dimensions</th>
                                    <td class="product_dimensions">12 x 15 x 23 cm</td>
                                </tr>
                                <tr>
                                    <th>Color</th>
                                    <td><p>Black, Blue, Grey, Violet, Yellow</p></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            @if($productsRevs->reviews->count() > 0)
                <div class="review">
                    <h1 class="R-title">Comments</h1>
                    <div class="rating-row">
                        <ul>
                            @for($i=1;$i<=$avrage;$i++)
                                <li class=""><i class="fa fa-star"></i></li>
                            @endfor
                            <h3>of <span>5<i class="fa fa-star-o"></i></span></h3>
                        </ul>
                    </div>
                    @foreach($productsRevs->reviews as $rev)
                        <div class="comment-section">

                            <div class="media media-review">
                                <div class="media-user mb-6"><img src="{{asset('assets/images/effects/person.png')}}"
                                                                  alt=""></div>
                                <div class="media-body">
                                    <div class="M-flex">
                                        <h2 class="title">{{$rev->created_at}}</h2>
                                        <div class="rating-row">
                                            <ul>
                                                @for($i=1;$i<=$rev->rate;$i++)
                                                    <li class=""><i class="fa fa-star"></i></li>
                                                @endfor
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="description ">
                                        {{$rev->comment}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div><!--end main products area-->

        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
            <div class="widget widget-our-services ">
                <div class="widget-content">
                    <ul class="our-services">

                        <li class="service">
                            <a class="link-to-service" href="#">
                                <i class="fa fa-truck" aria-hidden="true"></i>
                                <div class="right-content">
                                    <b class="title">Free Shipping</b>
                                    <span class="subtitle">On Oder Over $99</span>
                                    <p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
                                </div>
                            </a>
                        </li>

                        <li class="service">
                            <a class="link-to-service" href="#">
                                <i class="fa fa-gift" aria-hidden="true"></i>
                                <div class="right-content">
                                    <b class="title">Special Offer</b>
                                    <span class="subtitle">Get a gift!</span>
                                    <p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
                                </div>
                            </a>
                        </li>

                        <li class="service">
                            <a class="link-to-service" href="#">
                                <i class="fa fa-reply" aria-hidden="true"></i>
                                <div class="right-content">
                                    <b class="title">Order Return</b>
                                    <span class="subtitle">Return within 7 days</span>
                                    <p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div><!-- Categories widget-->

            <div class="widget mercado-widget widget-product">
                <h2 class="widget-title">Popular Products</h2>
                <div class="widget-content" wire:ignore>
                    <ul class="products">
                        @foreach($populars as $popular)

                            <li class="product-item">
                                <div class="product product-widget-style">
                                    <div class="thumbnnail">
                                        <a href="{{route('detail',$popular->slug)}}" title="{{$popular->name}}">
                                            <figure><img
                                                    src="{{asset('assets/images/products').'/'.$popular->image}}"
                                                    alt="{{$popular->name}}"></figure>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="{{route('detail',$popular->slug)}}"
                                           class="product-name"><span>{{$popular->name}}</span></a>

                                        <div class="wrap-price"><span
                                                class="product-price">{{$popular->regular_price}}</span></div>
                                    </div>
                                </div>
                            </li>

                        @endforeach

                    </ul>
                </div>
            </div>

        </div>

        @include('livewire.review-product')

    </div>
</div>

@push('scripts')
    <script>
        $(".btn-increase").click(function () {
            $(".owl-carousel").addClass("owl-drag");
        });
    </script>
@endpush


<div class="single-advance-box col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="wrap-show-advance-info-box style-1 box-in-site">
        <h3 class="title-box">Related Products</h3>
        <div class="wrap-products">


            <div class="products slide-carousel owl-carousel style-nav-1 equal-container owl-loaded owl-drag"
                 data-items="5"
                 data-loop="false" data-nav="true" data-dots="false"
                 data-responsive="{&quot;0&quot;:{&quot;items&quot;:&quot;1&quot;},&quot;480&quot;:{&quot;items&quot;:&quot;2&quot;},&quot;768&quot;:{&quot;items&quot;:&quot;3&quot;},&quot;992&quot;:{&quot;items&quot;:&quot;3&quot;},&quot;1200&quot;:{&quot;items&quot;:&quot;5&quot;}}">


                <div class="owl-stage-outer">
                    <div class="owl-stage"
                         style="transform: translate3d(-233px, 0px, 0px); transition: all 0.25s ease 0s; width: 2332px;">
                        @foreach($similars as $similar)


                            <div class="owl-item active" style="width: 233.2px;">
                                <div class="product product-style-2 equal-elem" style="height: 298px;">
                                    <div class="product-thumnail">
                                        <a href="{{route('detail',$similar->slug)}}" title="aut ipsam illum">
                                            <figure><img src="{{asset('assets/images/products')}}/{{$similar->image}}"
                                                         width="214" height="214" alt="aut ipsam illum">
                                            </figure>
                                        </a>
                                        <div class="group-flash">
                                            <span class="flash-item bestseller-label">New</span>
                                        </div>
                                        <div class="wrap-btn">
                                            <a href="#" class="function-link">quick view</a>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="product-name"><span>{{$similar->name}}</span></a>
                                        <div class="wrap-price"><span
                                                class="product-price">{{$similar->regular_price}}</span></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="owl-nav">
    <button type="button" role="presentation" class="owl-prev"><i class="fa fa-angle-left"
                                                                  aria-hidden="true"></i>
    </button>
    <button type="button" role="presentation" class="owl-next"><i class="fa fa-angle-right"
                                                                  aria-hidden="true"></i>
    </button>
</div>
<div class="owl-dots disabled"></div>
</div>
