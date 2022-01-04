@section('title') {{'Orders'}} @endsection

<div style="margin: 30px;padding: 20px 0" class="container">
    <div class="row">
        @if(session()->has('message'))
            <div class="alert alert-success">
                <p><strong>success</strong> {{\Illuminate\Support\Facades\Session::get('message')}}</p>
            </div>
        @endif

        <div class="col-xs-12">

            <table class=" table table-bordered table-striped dt-responsive">
                <thead>
                <tr>
                    <th>Order Id</th>
                    <th>Subtotal</th>
                    <th>Total</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td class="">{{$order->id}}</td>
                        <td class="">{{$order->subtotal}}</td>
                        <td class="">{{$order->total}}</td>
                        <td class="">{{$order->firstname}}</td>
                        <td class="">{{$order->lastname}}</td>
                        <td class="">{{$order->mobile}}</td>
                        <td class="">{{$order->email}}</td>
                        <td class="">{{$order->country}}</td>
                        <td class="">{{$order->city}}</td>
                        <td class="">{{$order->status}}</td>
                        <td class="">{{$order->created_at}}</td>

                        <td class=""><a class="btn btn-info" href="{{route('admin.order.detail',$order->id)}}">Detail</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
