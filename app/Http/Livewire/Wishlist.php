<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class Wishlist extends Component
{
    public $wishlists;
    public function mount()
    {
    }

    public function remove($rowId)
    {
        Cart::instance('wishlist')->remove($rowId);
        $this->emitTo('wishlist-count','refreshComponent');

    }

    public function store($product_id, $product_name, $product_price,$rowId)
    {
        $cartItem = Cart::instance('cart')->add($product_id, $product_name, 1, $product_price);

// Next we associate a model with the item.
        $cartItem->associate('App\Models\Product');

        session()->flash('message', 'Item Added in Cart');
        $this->emitTo('cart-count','refreshComponent');

        Cart::instance('wishlist')->remove($rowId);
//        return redirect()->route('cart');
        $this->emitTo('wishlist-count','refreshComponent');
        $this->emitTo('cart-count','refreshComponent');


    }

    public function render()
    {
        $this->wishlists = Cart::instance('wishlist')->content();

        return view('livewire.wishlist');
    }
}
