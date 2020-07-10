<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    public function order()
    {
        return $this->belongsTo('App\OrderDetails', 'order_id');
    } 


    public function products()
    {
    	return $this->belongsTo('App\Product', 'product_id');
    }
}
