<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;

class OrdersDetail extends Component
{
    public $order_id;

    public function mount($orderId)
    {
        $this->order_id = $orderId;
    }

    public function render()
    {
        $order = Order::find($this->order_id);
        return view('livewire.admin.orders-detail',['order'=>$order]);
    }
}
