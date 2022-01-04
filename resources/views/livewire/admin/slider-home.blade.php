@section('title') {{'Slider'}} @endsection

<div>
    <div class="wrap-breadcrumb">
        @include('livewire/admin/slider-update')
        @include('livewire/admin/slider-create')
        <ul>
            <li class="item-link"><a href="#" class="link">home</a></li>
            <li class="item-link"><span>Home Slider</span></li>
        </ul>
    </div>


    <div style="margin: 30px;padding: 20px 0">
        <div class="row">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    <p><strong>success</strong> {{\Illuminate\Support\Facades\Session::get('message')}}</p>
                </div>
            @endif
            <div class="col-xs-12">
                <div style="margin: 10px 0px">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createSliderModal"
                            wire:click.prevent="emptyField()">Add Slide
                    </button>

                </div>
                <table class="bold table table-bordered table-hover dt-responsive">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sliders as $slider)

                        <tr>
                            <td class="">{{$slider->id}}</td>

                            <td class="col-xs-1"><img src="{{asset('assets/images/slider').'/'.$slider->image}}" alt="">
                            </td>
                            <td>{{$slider->title}}</td>
                            <td>{{substr($slider->subtitle,0,30)}}...</td>
                            <td>{{$slider->price}}</td>
                            <td>
                                <div class="switch-field">
                                    @if($slider->status ==true or $slider->status==1)
                                        <input type="radio" id="radio-one{{$slider->id}}" disabled checked/>
                                        <label for="radio-one{{$slider->id}}">Activate</label>
                                        <input type="radio" id="radio-two{{$slider->id}}" disabled readonly/>
                                        <label for="radio-two{{$slider->id}}">Deactivate</label>
                                    @else

                                        <input type="radio" id="radio-one{{$slider->id}}" disabled/>
                                        <label for="radio-one{{$slider->id}}">Activate</label>
                                        <input type="radio" id="radio-two{{$slider->id}}" disabled checked/>
                                        <label for="radio-two{{$slider->id}}">Deactivate</label>

                                    @endif
                                </div>

                            </td>
                            <td class="col-xs-2">

                                <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#updateSliderModal"
                                        wire:click.prevent="edit({{$slider->id}})">Update
                                </button>

                                <button class="btn btn-danger" wire:click.prevent="delete({{$slider->id}})"> Delete
                                </button>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


                <div class="">
                    <div class="wrap-main-slide">
                        <div class="slide-carousel owl-carousel style-nav-1 " data-items="1" data-loop="1"
                             data-nav="true"
                             data-dots="false">

                            @foreach($sliders as $slider)
                                @if($slider->status ==true)
                                    <div class="item-slide">
                                        <img src="{{asset('assets/images/slider')}}/{{$slider->image}}" alt=""
                                             class="img-slide img-height">
                                        <div class="slide-info slide-3">
                                            {{--                        <h2 class="f-title">Great Range of <b>Exclusive Furniture Packages</b></h2>--}}
                                            <h2 class="f-title">{{$slider->title}}</b></h2>
                                            <span class="f-subtitle">{{$slider->subtitle}}</span>
                                            <p class="sale-info">Stating at: <b class="price">${{$slider->price}}</b>
                                            </p>
                                            <a href="#" class="btn-link">Shop Now</a>
                                        </div>
                                    </div>
                                @else
                                @endif
                            @endforeach

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
