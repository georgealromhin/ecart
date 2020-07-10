<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function order_details()
    {
    	return $this->hasMany('App\OrderDetails', 'product_id');
    }
}
