@section('title') {{'Products'}} @endsection

<div style="margin: 30px;padding: 20px 0" class="container">
    @include('livewire/admin/update-category')
    @include('livewire/admin/create-category')
    @include('livewire/admin/product-create')
    @include('livewire/admin/product-update')
    <div class="row">
        @if(session()->has('message'))
            <div class="alert alert-success">
                <p><strong>success</strong> {{\Illuminate\Support\Facades\Session::get('message')}}</p>
            </div>
        @endif
        <div class="col-xs-12">
            <div style="margin: 10px 0px">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createProModal"
                        wire:click.prevent="reade()">New Product
                </button>
            </div>
            <table class="bold table table-bordered table-hover dt-responsive">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Name Products</th>
                    <th>Category</th>
                    <th>Short description</th>
                    <th>Regular price</th>
                    <th>sale price</th>
                    <th>SKU</th>
                    <th>Stock status</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td class="">{{$product->id}}</td>
                        <td class="col-xs-1"><img src="{{asset('assets/images/products').'/'.$product->image}}" alt="">
                        </td>
                        <td class="">{{$product->name}}</td>
                        <td class="">{{$product->category->name}}</td>
                        <td class="">{{substr($product->short_description,0,30)}}...</td>
                        <td class="">{{$product->regular_price}}</td>
                        <td class="">{{$product->sale_price}}</td>
                        <td class="">{{$product->SKU}}</td>
                        <td class="">{{$product->stock_status}}</td>
                        <td class="">{{$product->quantity}}</td>
                        <td class="">{{$product->created_at}}</td>
                        <td class="col-xs-2">

                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#updateProModal"
                                    wire:click.prevent="edit({{$product->id}})">Update
                            </button>

                            <button class="btn btn-danger" onclick="confirm('Are you sure delete product ?') || event.stopImmediatePropagation()" wire:click.prevent="delete({{$product->id}})"> Delete
                            </button>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
