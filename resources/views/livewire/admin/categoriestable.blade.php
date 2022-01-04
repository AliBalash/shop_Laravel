@section('title') {{'Category'}} @endsection

<div style="margin: 30px;padding: 20px 0" class="container">
    @include('livewire/admin/update-category')
    @include('livewire/admin/create-category')
    <div class="row">
        @if(session()->has('message'))
            <div class="alert alert-success">
                <p><strong>success</strong> {{\Illuminate\Support\Facades\Session::get('message')}}</p>
            </div>
        @endif
        <div class="col-xs-12">
            <div style="margin: 10px 0px">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createCatModal"
                        wire:click.prevent="">New category
                </button>
            </div>
            <table class="bold table table-bordered table-hover dt-responsive">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name Category</th>
                    <th>Slug</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td class="col-xs-3">{{$category->id}}</td>
                        <td class="col-xs-3">{{$category->name}}</td>
                        <td class="col-xs-3">{{$category->slug}}</td>
                        <td class="col-xs-2">

                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#updateCatModal"
                                    wire:click.prevent="edit({{$category->id}})">Update
                            </button>

                            <button class="btn btn-danger" wire:click.prevent="delete({{$category->id}})">Delete</button>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @if(session()->has('message'))

                <script>
                    toastr.success('{!! session()->get('message') !!}');

                    swal({
                        title: "{!! session()->get('message') !!}",
                        text: "You clicked the button!",
                        icon: "success",
                        button: "Aww yiss!",
                    });
                </script>



            @endif
        </div>
    </div>
</div>

