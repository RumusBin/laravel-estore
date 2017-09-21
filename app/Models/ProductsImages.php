<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsImages extends Model
{
   protected $fillable = [
       'image_path',
       'product_id'
   ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }


}
