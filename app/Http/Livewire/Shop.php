<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Arr;
use Livewire\Component;
use Cart;
use Livewire\WithPagination;

class Shop extends Component
{

    public $sort;
    public $perPage;

    public $min_price;
    public $max_price;
    public $rowIds = array();

    public function mount()
    {
        $this->rowIds = [];
        $this->min_price = 1;
        $this->max_price = 1000;
        $this->sort = 'default';
        $this->perPage = '12';
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


    use WithPagination;

    public function render()
    {
        if ($this->sort === 'date') {

            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('created_at', 'DESC')->Paginate($this->perPage);

        } elseif ($this->sort === 'price') {
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('regular_price', 'ASC')->Paginate($this->perPage);

        } elseif ($this->sort === 'price-desc') {
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('regular_price', 'DESC')->Paginate($this->perPage);
        } else {
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->Paginate($this->perPage);

        }

//        Category
        $categories = Category::all();
        return view('livewire.shop', compact('products', 'categories'));
    }
}
