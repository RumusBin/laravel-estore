<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Dimsav\Translatable\Translatable;


class Brand extends Model
{
    use Translatable;
    use SoftDeletes;

    public $translatedAttributes = ['name', 'description'];
    public $translationModel = 'App\Models\Translations\BrandTranslation';
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    /**
     * Get the products for the brand.
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product','brand_id','id');
    }
}
