<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class HeaderSearch extends Component
{

    public $search;

    public function mount()
    {
        $this->fill(request()->only('search','product_cat','product_cat_id'));
    }

    public function resultSearch()
    {

        if ($this->search){
            $rsearch = Product::where('name', 'LIKE', "%".$this->search."%")->get();
            if ($rsearch->count() > 0){

                return redirect()->route('search', $this->search);

            }else{
                dd($rsearch->count());
            }
        }

    }

    public function render()
    {
//        Categories
        return view('livewire.header-search');
    }
}
