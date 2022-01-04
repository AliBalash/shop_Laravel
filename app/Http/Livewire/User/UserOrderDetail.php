<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserOrderDetail extends Component
{
    public $order_id;

    public function mount($orderId)
    {
        $this->order_id = $orderId;
    }

    public function render()
    {
        $orders = Order::where('user_id', Auth::user()->id)->get();

        $order = Order::where('user_id', Auth::user()->id)->where('id', $this->order_id)->first();
        if ($order)
            return view('livewire.user.user-order-detail', ['order' => $order]);
        else
            return view('livewire.user.user-orders', ['orders' => $orders]);

    }
}
