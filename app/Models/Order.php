<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cart',
        'address',
        'name',
        'payment_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
