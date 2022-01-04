<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Categories;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;

class Categoriestable extends Component
{

    public $ids;
    public $name;
    public $slug;

    public function edit($id)
    {
        $this->ids = $id;
        $category = Category::where('id', $this->ids)->first();
        $this->name = $category->name;
        $this->slug = Str::slug($this->name);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:categories',
            'slug' => 'required|unique:categories',
        ]);
        $this->slug = Str::slug($this->name);

    }

    public function update()
    {
        $cat = Category::where('id', $this->ids)->first();
        $cat->update([
            'name' => $this->name,
            'slug' => $this->slug,
        ]);
        session()->flash('message', 'Category Updated');
        $this->emit('modal');
        $this->emptyFields();
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.categoriestable', compact('categories'));
    }

//    Delete Category
    public function delete($id)
    {
        $cat = Category::find($id);
        session()->flash('message', 'Category Deleted');
        $cat->delete();

    }

//  Store Category
    public function store()
    {
        Category::create([
            'name'=>$this->name,
            'slug'=>Str::slug($this->name),
        ]
        );
        session()->flash('message', 'Naw Category Added');
        $this->emit('catAdded');
        $this->emptyFields();
    }


//    Empty All fields
    public function emptyFields()
    {
        $this->ids = '';
        $this->name = '';
        $this->slug = '';
    }
}
