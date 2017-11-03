<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'description', 'meta_title', 'meta_description'];
}
