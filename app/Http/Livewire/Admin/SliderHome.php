<?php

namespace App\Http\Livewire\Admin;

use App\Models\Slider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use Livewire\WithFileUploads;
use Psy\Util\Str;

class SliderHome extends Component
{
    use WithFileUploads;

    public $ids;
    public $title;
    public $subtitle;
    public $link;
    public $status;
    public $image;
    public $updated_image;
    public $new_image;
    public $price;

    public function updatedTitle()
    {
        $this->link = \Illuminate\Support\Str::slug($this->title);

    }

    public function edit($id)
    {
        $this->emptyField();
        $this->ids = $id;
        $slide = Slider::find($id);
        $this->title = $slide->title;
        $this->subtitle = $slide->subtitle;
        $this->link = $slide->link;
        $this->updated_image = $slide->image;
        $this->price = $slide->price;
        $this->status = $slide->status;
    }

    public function update()
    {
        $slide = Slider::find($this->ids);

        if (empty($this->new_image)) {

            $this->validate([
                'title' => 'required|',
                'subtitle' => 'required',
                'link' => 'required',
                'price' => 'required',
                'status' => 'required',
            ]);

            $slide->update([
                'title'=>$this->title,
                'subtitle'=>$this->subtitle,
                'link'=>$this->link,
                'image'=>$this->updated_image,
                'price'=>$this->price,
                'status'=>$this->status,
            ]);

        }else{
            $this->validate([
                'title' => 'required|',
                'subtitle' => 'required',
                'link' => 'required',
                'price' => 'required',
                'status' => 'required',
            ]);

            $image_name = Carbon::now()->timestamp.'.'.$this->new_image->extension();
            $this->new_image->storeAs('slider', $image_name);

            $slide->update([
                'title'=>$this->title,
                'subtitle'=>$this->subtitle,
                'link'=>$this->link,
                'image'=>$image_name,
                'price'=>$this->price,
                'status'=>$this->status,
            ]);

            $last_image_path = URL::asset('assets/images/slider') . '/' . $this->updated_image;

                File::delete($last_image_path);

        }

        session()->flash('message','Slide Updated Successfully !');
        $this->emit('updateSlider');
        $this->emptyField();
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|unique:sliders',
            'subtitle' => 'required',
            'link' => 'required',
            'price' => 'required',
            'status' => 'required|boolean',
            'image' => 'required|image',
        ]);
        $image_name = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('slider', $image_name);

        Slider::create([
            'title'=>$this->title,
            'subtitle'=>$this->subtitle,
            'link'=>$this->link,
            'image'=>$image_name,
            'price'=>$this->price,
            'status'=>$this->status,
        ]);
        session()->flash('message','Slide Added Successfully !');
        $this->emit('addedSlider');
        $this->emptyField();
    }

    public function delete($id)
    {
        $slide = Slider::find($id);
        $slide->delete();
        session()->flash('message','Slide Deleted Successfully !');

    }

    public function render()
    {
        return view('livewire.admin.slider-home', ['sliders' => Slider::all(),
        ]);

    }

    public function emptyField()
    {
        $this->ids = '';
        $this->title = '';
        $this->subtitle = '';
        $this->link = '';
        $this->status = '';
        $this->image = '';
        $this->updated_image = '';
        $this->new_image = '';
        $this->price = '';
    }
}
