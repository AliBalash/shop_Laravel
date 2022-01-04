@section('title') {{'Whishlist'}} @endsection

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
        .fill-heart{
            color: #f24747 !important;
        }
    </style>
    <ul class="product-list grid-products equal-container">
        @php
            $wishItems = Cart::instance('wishlist')->content()->pluck('id');
        @endphp
        @foreach($wishlists as $wishlist)

            <li class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ">
                <div class="product product-style-3 equal-elem ">
                    <div class="product-thumnail">

                            <figure class="imgShop"><img
                                    src="{{asset('assets/images/products/'.$wishlist->model->image)}}"
                                    alt="{{$wishlist->model->name}}"></figure>
                        </a>
                    </div>
                    <div class="product-info">
                          <strong>{{$wishlist->model->name}}</strong>
                        <div class="wrap-price"><span
                                class="product-price">{{$wishlist->model->regular_price}}</span></div>
                        <a href="#" class="btn add-to-cart"
                           wire:click.prevent="store({{$wishlist->model->id}},'{{$wishlist->model->name}}',{{$wishlist->model->regular_price}},'{{$wishlist->rowId}}')">Add
                            To Cart</a>
                        <div class="product-wish">
                            @if($wishItems->contains($wishlist->model->id))
                                <a href="#" wire:click.prevent="remove('{{$wishlist->rowId}}')"><i class="fa fa-heart fill-heart"></i></a>
                            @else
                                <a href="#" wire:click.prevent="addToWishlist({{$wishlist->model->id}},'{{$wishlist->model->name}}',{{$wishlist->model->regular_price}})"><i class="fa fa-heart "></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

</div>
