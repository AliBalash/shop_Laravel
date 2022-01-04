<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserOrders extends Component
{
    public $userId;

    public function mount()
    {
        $this->userId = Auth::user()->id;
    }
    public function render()
    {
//        orders of user
        $orders = Order::where('user_id', $this->userId)->get();

        return view('livewire.user.user-orders',['orders'=>$orders]);
    }
}
