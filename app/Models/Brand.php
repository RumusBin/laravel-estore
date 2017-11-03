<?php

namespace App\Models;


use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use Translatable;

    public $translationModel = 'App\Models\Translations\BrandTranslation';
    public $translatedAttributes = ['name', 'description'];




    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['image'];

    /**
     * Get the products for the brand.
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
