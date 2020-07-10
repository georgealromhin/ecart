<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    
    public function order()
    {
    	return $this->hasOne('App\Order', 'customer_id');
    }

    
    protected static function boot()
    {
        parent::boot();

        self::deleting(function ($customer) {
           $customer->order->delete();
        });
    }
}
