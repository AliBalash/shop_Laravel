<div wire:ignore.self class="modal fade" id="createSliderModal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <form wire:submit.prevent="store()" enctype="multipart/form-data">
                    <div class="form-group">
                        Title <input class="input-modal form-control" name="title" placeholder="title Slide"
                                     type="text" wire:model="title">
                        @error('title')
                        <p class="error">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        Link <input class="input-modal form-control" name="link" placeholder="link slide" type="text"
                                    readonly wire:model="link">
                        @error('link')
                        <p class="error">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        Subtitle <input class="input-modal form-control" name="subtitle"
                                        placeholder="subtitle slide ..." type="text"
                                        wire:model="subtitle">
                        @error('subtitle')
                        <p class="error">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        Price <input class="input-modal form-control" name="price" type="text"
                                     placeholder="price"
                                     wire:model="price">
                        @error('price')
                        <p class="error">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        status <div class="form-group">
                            <div class="switch-field">
                                <input type="radio" id="radio-one" value="1"  checked wire:model="status"/>
                                <label for="radio-one">Activate</label>
                                <input type="radio" id="radio-two" value="0" wire:model="status"/>
                                <label for="radio-two">Deactivate</label>
                            </div>
                            @error('status')
                            <p class="error">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        image <input class="input-modal form-control" name="update_image" type="file"
                                     wire:model="image">
                        @if($image)
                            <img src="{{$image->temporaryUrl()}}" width="120">
                        @endif
                        @error('image')
                        <p class="error">{{$message}}</p>
                        @enderror
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        >Close
                        </button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
