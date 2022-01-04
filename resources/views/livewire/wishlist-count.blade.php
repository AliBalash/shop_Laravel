<div class="wrap-icon-section wishlist minicart">
    <a href="{{route('wishlist')}}" class="link-direction">
        <i class="fa fa-heart" aria-hidden="true"></i>
        <div class="left-info">
            @if(Cart::instance('wishlist')->count() >0)
                <span class="index">{{Cart::instance('wishlist')->count()}} item</span>
                <span class="title">Wishlist</span>
                @else
                <span class="index">0 Item</span>
                <span class="title">Wishlist</span>
            @endif
        </div>
    </a>
</div>
