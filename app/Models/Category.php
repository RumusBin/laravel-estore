<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dimsav\Translatable\Translatable;


class Category extends Model
{
    use Translatable;
    use SoftDeletes;


    public $translatedAttributes = ['name', 'description'];
    public $translationModel = 'App\Models\Translations\CategoryTranslation';

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

    public function products()
    {
        return $this->hasMany('App\Models\Product','category_id','id');
    }
}
