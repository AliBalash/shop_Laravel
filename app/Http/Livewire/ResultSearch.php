<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Cart;

class ResultSearch extends Component
{



    public $sort;
    public $perPage;

    public $rowIds = array();

    public $search;
    public function mount($search)
    {
        $this->rowIds = [];
        $this->sort = 'default';
        $this->perPage = '12';
        $this->search = $search;
    }


    public function store($product_id, $product_name, $product_price)
    {
        $cartItem = Cart::instance('cart')->add($product_id, $product_name, 1, $product_price);
        $this->emitTo('cart-count','refreshComponent');

// Next we associate a model with the item.
        $cartItem->associate('App\Models\Product');

        session()->flash('message', 'Item Added in Cart');
//        auto refresh Cart

//        return redirect()->route('cart');
    }

    public function addToWishlist($product_id, $product_name, $product_price)
    {
        $wishItem = Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price);

//        Next we associate a model with the item.
        $wishItem->associate('App\Models\Product');
//        auto refresh Wishlist
        $this->emitTo('wishlist-count','refreshComponent');

    }

    public function removeWishlist($ids)
    {
        $wishlist = Cart::instance('wishlist')->content();

        foreach ($wishlist as $item) {
            $this->rowIds[] = $item->rowId;
        }

        foreach ($this->rowIds as $rowId) {
            $wishes[] = Cart::instance('wishlist')->get($rowId);
        }
        foreach ($wishes as $wish) {
            if ($wish->id == $ids) {
                Cart::instance('wishlist')->remove($wish->rowId);
            }
        }
        $this->emitTo('wishlist-count','refreshComponent');
        $this->rowIds = [];
    }

    public function render()
    {

        if ($this->sort === 'date') {

            $search_results = Product::where('name', 'LIKE', "%$this->search%")->orderBy('created_at', 'DESC')->get();

        } elseif ($this->sort === 'price') {
            $search_results = Product::where('name', 'LIKE', "%$this->search%")->orderBy('regular_price', 'ASC')->get();

        } elseif ($this->sort === 'price-desc') {
            $search_results = Product::where('name', 'LIKE', "%$this->search%")->orderBy('regular_price', 'DESC')->get();
        } else
            $search_results = Product::where('name', 'LIKE', "%$this->search%")->get();

        return view('livewire.result-search',['results'=>$search_results]);
    }
}
