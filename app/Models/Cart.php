<?php
/**
 * Created by PhpStorm.
 * User: Rumus
 * Date: 12.10.2017
 * Time: 16:28
 */

namespace App\Models;


class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->tottalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

        public function add($item, $id)
    {
        $storedItem = ['qty'=>0, 'price'=>$item->price, 'item'=>$item];
        if($this->items)
        {
            if(array_key_exists($id, $this->items))
            {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->price;
    }
}