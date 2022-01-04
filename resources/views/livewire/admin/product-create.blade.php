@section('title') {{'Create Product'}} @endsection

<div wire:ignore.self class="modal fade" id="createProModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <form wire:submit.prevent="store()" enctype="multipart/form-data">

                    <div class="form-group">
                        Product name <input class="input-modal form-control" name="name" placeholder="product name"
                                            type="text"
                                            wire:model="name">
                        @error('name')
                        <p class="error">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        slug <input class="input-modal form-control" name="slug" placeholder="product url" type="text"
                                    readonly wire:model="slug">
                        @error('slug')
                        <p class="error">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        Category
                        <select style="width: -webkit-fill-available;height: 34px;" class="input-modal"
                                name="category_id" wire:model="category_id">
                            @foreach($cats as $cat)
                                <option selected hidden>choose category ...</option>
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>

                        @error('category_id')
                        <p class="error">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group" wire:ignore>
                        Short description <input class="input-modal form-control" id="short_description"
                                                 name="short_description" placeholder="short description" type="text"
                                                 wire:model="short_description">
                        @error('short_description')
                        <p class="error">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group" wire:ignore>
                        description <br>
                        <textarea class="input-modal" wire:model="description" id="description" cols="56"
                                  name="description" rows="10" placeholder="description"></textarea>
                        @error('description')
                        <p class="error">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        Price <input class="input-modal form-control" name="regular_price" type="text"
                                     placeholder="price for sell"
                                     wire:model="regular_price">
                        @error('regular_price')
                        <p class="error">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        SKU<input class="input-modal form-control" name="SKU" type="text" placeholder="code product"
                                  wire:model="SKU">
                        @error('SKU')
                        <p class="error">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        Quantity <input class="input-modal form-control" name="quantity" type="number"
                                        placeholder="quantity amount"
                                        wire:model="quantity">
                        @error('quantity')
                        <p class="error">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group input-modal">
                        Stock status <br>
                        <input type="radio" id="inStock" name="inStock" value="inStock" wire:model="stock_status"
                               checked="checked">
                        <label for="inStock">in Stock</label><br>
                        <input type="radio" id="outStock" name="outStock" value="outStock" wire:model="stock_status">
                        <label for="outStock">out Stock</label><br>
                        @error('stock_status')
                        <p class="error">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        image <input class="input-modal form-control" name="image" type="file"
                                     wire:model="image">
                        @if($image)
                            <img src="{{$image->temporaryUrl()}}" width="120">
                        @endif
                        @error('image')
                        <p class="error">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        Gallery <input class="input-modal form-control" name="images" type="file" multiple
                                      wire:model="images">
                        @if($images)
                            @foreach($images as $image)
                                <img src="{{$image->temporaryUrl()}}" width="120">
                            @endforeach
                        @endif
                        @error('images')
                        <p class="error">{{$message}}</p>
                        @enderror
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                wire:click.prevent="close()">Close
                        </button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@push('scripts')

    <script>
        $(function () {
            tinymce.init({
                selector: '#short_description',
                setup: function (editor) {
                    editor.on('Change', function (e) {
                        tinyMCE.triggerSave();
                        var sd_data = $('#short_description').val();
                    @this.set('short_description', sd_data);
                    });
                }
            });

            tinymce.init({
                selector: '#description',
                setup: function (editor) {
                    editor.on('Change', function (e) {
                        tinyMCE.triggerSave();
                        var d_data = $('#description').val();
                    @this.set('description', d_data);
                    });
                }
            });

        });

    </script>
@endpush
