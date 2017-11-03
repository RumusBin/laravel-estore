<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class BrandTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'brand_translations';
    protected $fillable = ['name', 'description', 'meta_title', 'meta_description'];
}
