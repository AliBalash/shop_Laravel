<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Cart;

class CartShopping extends Component
{

    public function destroy()
    {
        Cart::instance('cart')->destroy();
        session()->flash('message', 'All Item Removed In Cart');
        $this->emitTo('cart-count', 'refreshComponent');

    }

    public function increase($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId, ['qty' => $qty]);

        $this->emitTo('cart-count', 'refreshComponent');

    }

    public function decrease($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);

        $this->emitTo('cart-count', 'refreshComponent');

    }

    public function remove($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        session()->flash('message', 'Item Removed In Cart');
        $this->emitTo('cart-count', 'refreshComponent');

    }

//    checkout cart just members and auth
    public function checkout()
    {
        if (Auth::check()){
            return redirect()->route('checkout');
        }else{
            return redirect()->route('login');
        }
    }


    public function render()
    {
        return view('livewire.cart-shopping')->layout('layouts.base');
    }
}
