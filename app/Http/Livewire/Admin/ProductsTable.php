<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Dotenv\Util\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductsTable extends Component
{

    public $cats = [];
    public $ids;
    public $name;
    public $slug;
    public $category_id;
    public $category_name;
    public $short_description;
    public $description;
    public $regular_price;
    public $sale_price;
    public $SKU;
    public $quantity;
    public $stock_status;
    public $update_image;
    public $new_image;
    public $image;
    public $images;

    use WithFileUploads;

    public function updatedName()
    {
        $this->slug = \Illuminate\Support\Str::slug($this->name);
    }

//  Reade for form
    public function reade()
    {
        $this->emptyField();

//        show category for create product
        $this->cats = Category::all();
    }

    public function edit($id)
    {
        $this->emptyField();

//        all category for show
        $this->cats = Category::all();

        $product = Product::find($id);
        $cat_id = $product->category_id;
        $cat = Category::find($cat_id);

        $this->category_name = $cat->name;
        $this->ids = $id;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->category_id = $product->category_id;
        $this->short_description = $product->short_description;
        $this->description = $product->description;
        $this->regular_price = $product->regular_price;
        $this->sale_price = $product->sale_price;
        $this->SKU = $product->SKU;
        $this->quantity = $product->quantity;
        $this->stock_status = $product->stock_status;
        $this->update_image = $product->image;
    }


    public function update()
    {

        $product = Product::find($this->ids);

        if (empty($this->new_image)) {
            $this->validate([
                'name' => 'required|',
                'category_id' => 'required|exists:categories,id',
                'short_description' => 'required|',
                'description' => 'required|min:200|',
                'regular_price' => 'required|numeric',
                'stock_status' => 'required|',
                'quantity' => 'required|integer',
            ]);

            $product->update([
                'name' => $this->name,
                'slug' => $this->slug,
                'short_description' => $this->short_description,
                'description' => $this->description,
                'regular_price' => $this->regular_price,
                'sale_price' => $this->sale_price,
                'SKU' => $this->SKU,
                'stock_status' => $this->stock_status,
                'quantity' => $this->quantity,
                'image' => $this->update_image,
                'category_id' => $this->category_id,
            ]);
        } else {


            $this->validate([
                'name' => 'required|',
                'category_id' => 'required|exists:categories,id',
                'short_description' => 'required|',
                'description' => 'required|min:200|',
                'regular_price' => 'required|numeric',
                'stock_status' => 'required|',
                'quantity' => 'required|integer',
                'image' => 'image'
            ]);
            $image_name = Carbon::now()->timestamp . '.' . $this->new_image->extension();
            $this->new_image->storeAs('products', $image_name);

            $product->update([
                'name' => $this->name,
                'slug' => $this->slug,
                'short_description' => $this->short_description,
                'description' => $this->description,
                'regular_price' => $this->regular_price,
                'sale_price' => $this->sale_price,
                'SKU' => $this->SKU,
                'stock_status' => $this->stock_status,
                'quantity' => $this->quantity,
                'image' => $image_name,
                'category_id' => $this->category_id,
            ]);

        }
        session()->flash('message', 'Product Updated Seccessfully');
        $this->emptyField();
        $this->emit('updateProduct');
    }

//    Store New product
    public function store()
    {

        $this->validate([
            'name' => 'required|unique:products',
            'category_id' => 'required|exists:categories,id',
            'short_description' => 'required|',
            'description' => 'required|min:200|',
            'regular_price' => 'required|numeric',
            'stock_status' => 'required|',
            'quantity' => 'required|integer',
            'image' => 'image',
        ]);
        $image_name = Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('products', $image_name);


//        Product::create([
//            'name' => $this->name,
//            'slug' => $this->slug,
//            'short_description' => $this->short_description,
//            'description' => $this->description,
//            'regular_price' => $this->regular_price,
//            'SKU' => $this->SKU,
//            'stock_status' => $this->stock_status,
//            'quantity' => $this->quantity,
//            'image' => $image_name,
//            'category_id' => $this->category_id,
//        ]);
        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        $product->SKU = $this->SKU;
        $product->stock_status = $this->stock_status;
        $product->quantity = $this->quantity;
        $product->image = $image_name;
        $product->category_id = $this->category_id;
        if ($this->images) {

            $images_name = '';

            foreach ($this->images as $key => $image) {
                $img_name = Carbon::now()->timestamp . $key . '.' . $image->extension();
                $image->storeAs('products', $img_name);
                $images_name .= $img_name . ',';
            }
            $product->images = $images_name;
        }
        $product->save();
        session()->flash('message', 'Product Created Successfully !');
        $this->emptyField();
        $this->emit('createModal');
    }

//    Delete product
    public function delete($id)
    {
        $product = Product::find($id);
        if ($product->image) {
            unlink('assets/images/products' . '/' . $product->image);
            if ($product->images) {
                $images = explode(',', $product->images);
                foreach ($images as $image) {
                    if (!empty($image)) {

                        unlink('assets/images/products' . '/' . $image);

                    }else{

                    }

                }
            }
        }
        $product->delete();
        session()->flash('message', 'Item Deleted Successfully !');

    }


    public function emptyField()
    {
        $this->ids = '';
        $this->name = '';
        $this->slug = '';
        $this->category_id = '';
        $this->category_name = '';
        $this->short_description = '';
        $this->description = '';
        $this->regular_price = '';
        $this->SKU = '';
        $this->quantity = '';
        $this->stock_status = '';
        $this->update_image = '';
        $this->new_image = '';
        $this->image = '';
    }

    public function close()
    {
        $this->emptyField();
    }

    public function render()
    {

//        product all
        $products = Product::all();
        return view('livewire.admin.products-table', compact('products'));
    }
}
