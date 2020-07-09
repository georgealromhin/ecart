<?php

namespace App;


class Cart
{
    public $products = null;
    public $qty = 0;
    public $total = 0;
    

    public function __construct($oldCart){
        if($oldCart){
            $this->products = $oldCart->products;
            $this->qty = $oldCart->qty;
            $this->total = $oldCart->total;
        }
    }

    public function add($product, $id, $qty2){
        $storedProduct = ['qty'=> 0, 'price' => $product->price, 'product' => $product];
        if($this->products){
            if(array_key_exists($id, $this->products)){
                $storedProduct = $this->products[$id];
            }
        }
        $storedProduct['qty'] += $qty2;
        $storedProduct['price'] = $product->price * $storedProduct['qty'];
        $this->products[$id] = $storedProduct;
        $this->qty += $qty2;
        $this->total += $product->price * $qty2;
    }
    public function remove($id){
        if($this->products){
            if(array_key_exists($id, $this->products)){
                $this->qty -= $this->products[$id]['qty'];
                $this->total -=  $this->products[$id]['price'];
                unset($this->products[$id]);
            }
        }
    }

}
