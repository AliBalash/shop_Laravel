<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Cart;

class Checkout extends Component
{
    public $is_shipping_difference;

    public $firstname;
    public $lastname;
    public $email;
    public $mobile;
    public $country;
    public $city;
    public $address;

    public $s_firstname;
    public $s_lastname;
    public $s_email;
    public $s_mobile;
    public $s_country;
    public $s_city;
    public $s_address;

    public $paymentMode;
    public $thankYou;

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
            'paymentMode' => 'required',
        ]);

        if ($this->is_shipping_difference) {
            $this->validateOnly($fields,[
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required',
                'mobile' => 'required',
                'country' => 'required',
                'city' => 'required',
                'address' => 'required',
                'paymentMode' => 'required',
            ]);
        }
    }

    public function placeOrder()
    {


        $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
            'paymentMode' => 'required',
        ]);

//        save Order in table
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->subtotal = Cart::instance('cart')->subtotal();
        $order->discount = Cart::instance('cart')->discount();
        $order->tax = Cart::instance('cart')->tax();
        $order->total = Cart::instance('cart')->total();

        $order->firstname = $this->firstname;
        $order->lastname = $this->lastname;
        $order->mobile = $this->mobile;
        $order->email = $this->email;
        $order->country = $this->country;
        $order->city = $this->city;
        $order->address = $this->address;
        $order->status = 'ordered';
        $order->is_shipping_difference = $this->is_shipping_difference ? 1 : 0;
        $order->save();


//        save OrderItem in table
        foreach (Cart::instance('cart')->content() as $item) {
            $orderItem = OrderItem::create([
                'product_id' => $item->id,
                'order_id' => $order->id,
                'price' => $item->price,
                'quantity' => $item->qty,
            ]);
        }

//        save otherShipping in table
        if ($this->is_shipping_difference) {
            $this->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required',
                'mobile' => 'required',
                'country' => 'required',
                'city' => 'required',
                'address' => 'required',
                'paymentMode' => 'required',
            ]);

            Shipping::create([
                'firstname' => $this->s_firstname,
                'lastname' => $this->s_lastname,
                'order_id' => $order->id,
                'mobile' => $this->s_mobile,
                'email' => $this->s_email,
                'country' => $this->s_country,
                'city' => $this->s_city,
                'status' => 'ordered',
                'address' => $this->s_address,
            ]);
        }

        if ($this->paymentMode) {
            Transaction::create([
                'user_id' => Auth::user()->id,
                'order_id' => $order->id,
                'mode' => 'pending',
            ]);
        }
        $this->thankYou = 1;
        Cart::instance('cart')->destroy();

        return redirect()->route('thankYou');

    }

    public function verifyCheckout()
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }elseif (!Cart::instance('cart')->content() >0){
            return redirect()->route('cart');
        }elseif ($this->thankYou){
            return redirect()->route('thankYou');
        }

    }

    public function render()
    {
        $this->verifyCheckout();
        return view('livewire.checkout');
    }
}
