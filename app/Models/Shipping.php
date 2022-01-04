<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $table = 'shippings';
    protected $fillable = [
        'firstname',
        'lastname',
        'order_id',
        'mobile',
        'email',
        'country',
        'city',
        'address',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
