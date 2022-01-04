@section('title') Order Detail @endsection
<div>
    <div class="container" style="padding:30px 0 ">

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">

                            <div class="col-lg-10">
                                Order Items
                            </div>

                            <div class="col-lg-2">
                                <a href="{{route('admin.orders')}}" class="btn btn-info">My Orders</a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">

                        <div class="wrap-iten-in-cart">
                            <h3 class="box-title">Products Name</h3>
                            <ul class="products-cart">

                                @foreach($order->orderItem as $item)
                                    <li class="pr-cart-item">
                                        <div class="product-image">
                                            <figure><img
                                                    src="{{asset('assets/images/products').'/'.$item->product->image}}"
                                                    alt="{{$item->product->name}}"></figure>
                                        </div>
                                        <div class="product-name">
                                            <a class="link-to-product"
                                               href="{{route('detail',['slug'=>$item->product->slug])}}">{{$item->product->name}}</a>
                                        </div>
                                        <div class="price-field produtc-price"><p
                                                class="price">{{$item->price}}</p>
                                        </div>

                                        <div class="price-field produtc-price"><p
                                                class="price">{{$item->quantity}}</p>
                                        </div>

                                        <div class="price-field sub-total"><p class="price">
                                                ${{$item->price * $item->quantity}}</p>
                                        </div>


                                    </li>
                                @endforeach
                                <div class="order-summary">

                                    <p class="summary-info">
                                        <spanp class="title ">Subtotal:</spanp>
                                        <b class="index">${{$order->subtotal}}</b>
                                    </p>
                                    <hr>

                                    <p class="summary-info">
                                        <spanp class="title ">tax:</spanp>
                                        <b class="index">${{$order->tax}}</b>
                                    </p>
                                    <hr>
                                    <p class="summary-info">
                                        <spanp class="title ">Total:</spanp>
                                        <b class="index">${{$order->total}}</b>
                                    </p>

                                </div>


                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Billing Detail
                    </div>
                    <div class="panel-body">


                        <table class="table table-striped">
                            <tr>
                                <th>First Name</th>
                                <td>{{$order->firstname}}</td>
                                <th>Last Name</th>
                                <td>{{$order->lastname}}</td>
                                <th>Mobile</th>
                                <td>{{$order->mobile}}</td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td>{{$order->country}}</td>
                                <th>City</th>
                                <td>{{$order->address}}</td>
                                <th>Address</th>
                                <td>{{$order->address}}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{$order->email}}</td>
                                <th>status</th>
                                <td>{{$order->status}}</td>
                                <th>Date Order</th>
                                <td>{{$order->created_at}}</td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if($order->is_shipping_difference)
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            Shipping Detail
                        </div>
                        <div class="panel-body">

                            <table class="table table-striped">
                                <tr>
                                    <th>First Name</th>
                                    <td>{{$order->shipping->firstname}}</td>
                                    <th>Last Name</th>
                                    <td>{{$order->shipping->lastname}}</td>
                                    <th>Mobile</th>
                                    <td>{{$order->shipping->mobile}}</td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td>{{$order->shipping->country}}</td>
                                    <th>City</th>
                                    <td>{{$order->shipping->address}}</td>
                                    <th>Address</th>
                                    <td>{{$order->shipping->address}}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{$order->shipping->email}}</td>
                                    <th>status</th>
                                    <td>{{$order->shipping->status}}</td>
                                    <th>Date Order</th>
                                    <td>{{$order->shipping->created_at}}</td>
                                </tr>
                                <tr>

                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        Transaction
                    </div>
                    <div class="panel-body">

                        <table class="table table-striped">
                            <tr>
                                <th>Mode</th>
                                <td>peypal</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{$order->transaction->mode}}</td>
                            </tr>
                            <tr>
                                <th>Transaction Data</th>
                                <td>{{$order->transaction->created_at}}</td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
