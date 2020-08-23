<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = true;

    protected $table = 'coupons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'value',
        'name',
        'status',
        'type',
        'quantity',
        'end_date',
        'group_cate',
        'group_product',
        'data',
    ];
}
