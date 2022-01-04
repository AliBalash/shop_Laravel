<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Review;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use function Symfony\Component\String\s;

class Detail extends Component
{
    public $slug;
    public $qty;

    public $rate;
    public $comment;
    public $avrage;

    protected $listeners = ['refreshDetailComponent' => '$refresh'];

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->qty = 1;
    }

    public function store($product_id, $product_name, $product_price)
    {
        $cartItem = Cart::instance('cart')->add($product_id, $product_name, $this->qty, $product_price);

        $cartItem->associate('App\Models\Product');

        session()->flash('message', 'Item Added in Cart');

        return redirect()->route('cart');
    }

    public function increaseQty()
    {
        $this->qty++;

    }

    public function decreaseQty()
    {
        $this->qty--;

    }

    public function review($product_id)
    {
        $this->validate([
            'rate' => 'required',
            'comment' => 'required',
        ]);
        $review = Review::create([
            'product_id' => $product_id,
            'rate' => $this->rate,
            'comment' => $this->comment,
        ]);
        $this->empty();
        $this->emit('detail');
        $this->emit('closeReview');

    }

    public function render()
    {
        $sum = 0;
        $productsRevs = Product::where('slug', $this->slug)->first();
        foreach ($productsRevs->reviews as $item) {

            $sum = $sum + $item->rate;
            $this->avrage = round($sum / $productsRevs->reviews->count());
        }

        $product = Product::where('slug', $this->slug)->first();
        $popular_products = Product::inRandomOrder()->limit(4)->get();
        $similar_product = Product::where("category_id", $product->category_id)->inRandomOrder()->limit(10)->get();
        return view('livewire.detail', ['product' => $product, 'populars' => $popular_products, 'similars' => $similar_product, 'productsRevs' => $productsRevs]);
    }

    public function empty()
    {
        $this->rate = '';
        $this->comment = '';
    }
}
