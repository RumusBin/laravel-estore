<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Dimsav\Translatable\Translatable;


class Product extends Model
{

    use Translatable;
    use SoftDeletes;
    public $translatedAttributes = [
        'product_name',
        'description',
        'meta_title',
        'meta_description'
    ];
    public $translationModel = 'App\Models\Translations\ProductTranslation';
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
        'meta_title',
        'meta_description',
        'price',
        'brand_id',
        'category_id',
    ];

    /**
     * Get the brand that the product belongs to.
     */
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    /**
     * Get the category that the product belongs to.
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductsImages');
    }
}
