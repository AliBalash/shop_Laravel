@section('title') {{'Checkout'}} @endsection

<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link"></a></li>
                <li class="item-link"><span>Checkout</span></li>
            </ul>
        </div>
        <div class=" main-content-area">
            <form wire:submit.prevent="placeOrder()">
                <div class="wrap-address-billing">
                    <h3 class="box-title">Billing Address</h3>
                    <div class="billing-address">
                        <p class="row-in-form">
                            <label for="fname">first name<span>*</span></label>
                            <input type="text" name="firstname" placeholder="Your name" wire:model="firstname">
                            @error('firstname')
                            <span class="error">{{$message}}</span>
                            @enderror
                        </p>

                        <p class="row-in-form">
                            <label for="lname">last name<span>*</span></label>
                            <input type="text" name="lastname" placeholder="Your last name" wire:model="lastname">
                            @error('lastname')
                            <span class="error">{{$message}}</span>
                            @enderror
                        </p>
                        <p class="row-in-form">
                            <label for="email">Email Addreess:</label>
                            <input type="email" name="email" placeholder="Type your email" wire:model="email">
                            @error('email')
                            <span class="error">{{$message}}</span>
                            @enderror
                        </p>
                        <p class="row-in-form">
                            <label for="mobile">mobile number<span>*</span></label>
                            <input type="number" name="mobile" placeholder="10 digits format" wire:model="mobile">
                            @error('mobile')
                            <span class="error">{{$message}}</span>
                            @enderror
                        </p>
                        <p class="row-in-form">
                            <label for="country">Country<span>*</span></label>
                            <input type="text" name="country" placeholder="United States" wire:model="country">
                            @error('country')
                            <span class="error">{{$message}}</span>
                            @enderror
                        </p>
                        <p class="row-in-form">
                            <label for="city">Town / City<span>*</span></label>
                            <input type="text" name="city" placeholder="City name" wire:model="city">
                            @error('city')
                            <span class="error">{{$message}}</span>
                            @enderror
                        </p>
                        <p class="row-in-form">
                            <label for="add">Address: <span>*</span></label>
                            <input type="text" name="address" placeholder="Street at apartment number"
                                   wire:model="address">
                            @error('address')
                            <span class="error">{{$message}}</span>
                            @enderror
                        </p>
                    </div>
                    <p class="row-in-form fill-wife">
                        <label class="checkbox-field">
                            <input value="1" wire:model="is_shipping_difference" type="checkbox">
                            <span>Ship to a different address?</span>
                        </label>
                    </p>
                    @if($is_shipping_difference)

                        <div class="billing-address">
                            <p class="row-in-form">
                                <label for="fname">first name<span>*</span></label>
                                <input type="text" name="s_firstname" placeholder="Your name" wire:model="s_firstname">
                                @error('s_firstname')
                                <span class="error">{{$message}}</span>
                                @enderror

                            </p>
                            <p class="row-in-form">
                                <label for="lname">last name<span>*</span></label>
                                <input type="text" name="s_lastname" placeholder="Your last name"
                                       wire:model="s_lastname">
                                @error('s_lastname')
                                <span class="error">{{$message}}</span>
                                @enderror
                            </p>
                            <p class="row-in-form">
                                <label for="email">Email Addreess:</label>
                                <input type="email" name="s_email" placeholder="Type your email" wire:model="s_email">
                                @error('s_email')
                                <span class="error">{{$message}}</span>
                                @enderror
                            </p>
                            <p class="row-in-form">
                                <label for="mobile">mobile number<span>*</span></label>
                                <input type="number" name="s_mobile" placeholder="10 digits format"
                                       wire:model="s_mobile">
                                @error('s_mobile')
                                <span class="error">{{$message}}</span>
                                @enderror
                            </p>
                            <p class="row-in-form">
                                <label for="country">Country<span>*</span></label>
                                <input type="text" name="s_country" placeholder="United States" wire:model="s_country">
                                @error('s_country')
                                <span class="error">{{$message}}</span>
                                @enderror
                            </p>
                            <p class="row-in-form">
                                <label for="city">Town / City<span>*</span></label>
                                <input type="text" name="s_city" placeholder="City name" wire:model="s_city">
                                @error('s_city')
                                <span class="error">{{$message}}</span>
                                @enderror
                            </p>
                            <p class="row-in-form">
                                <label for="add">Address: <span>*</span></label>
                                <input type="text" name="s_address" placeholder="Street at apartment number"
                                       wire:model="s_address">
                                @error('s_address')
                                <span class="error">{{$message}}</span>
                                @enderror
                            </p>
                        </div>

                    @endif
                </div>
                <div class="summary summary-checkout">
                    <div class="summary-item payment-method">
                        <h4 class="title-box">Payment Method</h4>
                        <p class="summary-info"><span class="title">Check / Money order</span></p>
                        <p class="summary-info"><span class="title">Credit Cart (saved)</span></p>
                        <div class="choose-payment-methods">
                            <label class="payment-method">
                                <input name="payment-method" id="payment-method-bank" value="cod" type="radio"
                                       wire:model="paymentMode">
                                <span>Cash on delivery</span>
                                <span class="payment-desc">Order Now Pay on Delivery</span>
                            </label>
                            <label class="payment-method">
                                <input name="payment-method" id="payment-method-visa" value="cart" type="radio"
                                       wire:model="paymentMode">
                                <span>Debit/Credit Cart</span>
                                <span
                                    class="payment-desc">There are many variations of passages of Lorem Ipsum available</span>
                            </label>
                            <label class="payment-method">
                                <input name="payment-method" id="payment-method-paypal" value="paypal" type="radio"
                                       wire:model="paymentMode">
                                <span>Paypal</span>
                                <span class="payment-desc">Use Paypal cart For Checkout</span>

                            </label>
                            @error('paymentMode')
                            <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <p class="summary-info grand-total"><span>Grand Total</span> <span
                                class="grand-total-price">${{Cart::instance('cart')->total()}}</span></p>
                        <button type="submit" class="btn btn-medium">Place order now</button>
                    </div>
                    <div class="summary-item shipping-method">
                        <h4 class="title-box f-title">Shipping method</h4>
                        <p class="summary-info"><span class="title">Flat Rate</span></p>
                        <p class="summary-info"><span class="title">Fixed $0</span></p>

                    </div>
                </div>
            </form>
        </div><!--end main content area-->
    </div><!--end container-->

</main>
