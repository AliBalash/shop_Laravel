<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'subtotal',
        'discount',
        'tax',
        'total',
        'firstname',
        'lastname',
        'mobile',
        'email',
        'country',
        'city',
        'address',
        'status',
        'is_shipping_difference',
    ];

    public function user()
    {
//        har order motealeq be yek User
        return $this->belongsTo(Order::class);
    }

    public function orderItem()
    {
//        har order daraye chandin item hast
        return $this->hasMany(OrderItem::class);
    }

    public function shipping()
    {
//        har order daraye ye haml o naql hast
        return $this->hasOne(Shipping::class);
    }

    public function transaction()
    {
//        har order daraye yek modamele hast
        return $this->hasOne(Transaction::class);
    }

}
