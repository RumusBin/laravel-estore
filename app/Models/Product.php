<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'product_code',
        'product_name',
        'image',
        'description',
        'price',
        'brand_id',
        'category_id',
    ];

    /**
     * Get the brand that the product belongs to.
     */
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand','brand_id');
    }

    /**
     * Get the category that the product belongs to.
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductsImages', 'product_id', 'id');
    }
}
