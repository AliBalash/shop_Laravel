<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Livewire\Component;

class Home extends Component
{

    public function mount()
    {
        $this->titlePage = 'Home';

    }
    public function render()
    {

        $sliders = Slider::all();
        $last_product = Product::orderBy('created_at', 'DESC')->take(10)->get();
        $sale = Product::where('sale_price', '>', 0)->inRandomOrder()->take(8)->get();
        return view('livewire.home',['sliders'=>$sliders,'lProducts'=>$last_product,'sale'=>$sale]);
    }
}
