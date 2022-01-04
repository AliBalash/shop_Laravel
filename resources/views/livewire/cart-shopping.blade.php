@section('title') {{'Cart Shoping'}} @endsection

<main wire:ignore.self id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">home</a></li>
                <li class="item-link"><span>Cart</span></li>
            </ul>
        </div>
        <div class=" main-content-area">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    <strong>Success {{\Illuminate\Support\Facades\Session::get('message')}}</strong></div>
            @endif
            @if(Cart::instance('cart')->count() >0)
                <div class="wrap-iten-in-cart">
                    <h3 class="box-title">Products Name</h3>
                    <ul class="products-cart">

                        @foreach(Cart::instance('cart')->content() as $item)
                            <li class="pr-cart-item">

                                <div class="product-image">
                                    <figure><img src="{{asset('assets/images/products').'/'.$item->model->image}}"
                                                 alt="{{$item->model->name}}"></figure>
                                </div>
                                <div class="product-name">
                                    <a class="link-to-product"
                                       href="{{route('detail',['slug'=>$item->model->slug])}}">{{$item->model->name}}</a>
                                </div>
                                <div class="price-field produtc-price"><p
                                        class="price">{{$item->model->regular_price}}</p>
                                </div>
                                <div class="quantity">
                                    <div class="quantity-input">
                                        <input type="text" name="product-quatity" value="{{$item->qty}}" data-max="120"
                                               pattern="[0-9]*">
                                        <a class="btn btn-increase" wire:ignore.self href="#"
                                           wire:click.prevent="increase('{{$item->rowId}}')"></a>
                                        <a class="btn btn-reduce" wire:ignore.self href="#"
                                           wire:click.prevent="decrease('{{$item->rowId}}')"></a>
                                    </div>
                                </div>
                                <div class="price-field sub-total"><p class="price">{{$item->subtotal()}}</p></div>
                                <div class="delete">
                                    <a href="#" class="btn btn-delete" wire:click.prevent="remove('{{$item->rowId}}')">
                                        <span>Delete from your cart</span>
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="summary">
                    <div class="order-summary">
                        <h4 class="title-box">Order Summary</h4>
                        <p class="summary-info"><span class="title">Subtotal</span><b
                                class="index">{{Cart::instance('cart')->subtotal()}}</b></p>
                        <p class="summary-info"><span class="title">Tax</span><b
                                class="index">{{Cart::instance('cart')->tax()}}</b></p>
                        <p class="summary-info"><span class="title">Shipping</span><b class="index">Free Shipping</b>
                        </p>
                        <p class="summary-info total-info "><span class="title">Total</span><b
                                class="index">{{Cart::instance('cart')->total()}}</b></p>
                    </div>
                    <div class="checkout-info">
                        <label class="checkbox-field">
                            <input class="frm-input " name="have-code" id="have-code" value="" type="checkbox"><span>I have promo code</span>
                        </label>
                        <a class="btn btn-checkout" href="#" wire:click.prevent="checkout()">Check out</a>
                        <a class="link-to-shop" href="">Continue Shopping<i class="fa fa-arrow-circle-right"
                                                                            aria-hidden="true"></i></a>
                    </div>
                    <div class="update-clear">
                        <a class="btn btn-clear" href="#" wire:click.prevent="destroy()">Clear Shopping Cart</a>
                    </div>
                </div>
            @else
                <div class="center">
                    <div>
                        <h2>Your cart is empty !</h2>
                        <p>Add Item to cart now <i class="fa fa-shopping-basket"></i></p>
                    </div>
                    <div>
                        <a href="{{route('shop')}}" class="btn btn-success">Continue Shop <i
                                class="fa fa-shopping-bag"></i></a>
                    </div>
                </div>
            @endif
        </div><!--end container-->
    </div>

</main>
