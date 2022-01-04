@section('title') {{'Create Category'}} @endsection

<div wire:ignore.self class="modal fade" id="createCatModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <form wire:submit.prevent="store()">
                    <div class="form-group">
                        Category name <input class="input-modal form-control" name="name" type="text" wire:model="name">
                        @error('name')
                        <p class="error">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        slug <input class="input-modal form-control" name="slug" type="text" readonly wire:model="slug">
                        @error('slug')
                        <p class="error">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" >Create</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


