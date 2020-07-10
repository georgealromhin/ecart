<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function order_details()
    {
    	return $this->hasMany('App\OrderDetails', 'order_id');
    }

    public function customer()
    {
    	return $this->belongsTo('App\Customer', 'customer_id');
    }


    protected static function boot()
    {
        parent::boot();

        self::deleting(function ($order) {
           $order->order_details->each->delete();
        });
    }
}
