<div class="wrap-search center-section">
    <div class="wrap-search-form">
        <form wire:submit.prevent="resultSearch">
            <input type="text" name="search" value="{{$search}}" placeholder="Search here..." wire:model="search">
            <button  ><i class="fa fa-search"
                                                            aria-hidden="true"></i></button>
        </form>
    </div>
</div>
