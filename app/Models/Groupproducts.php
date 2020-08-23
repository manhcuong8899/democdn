<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groupproducts extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = true;

    protected $table = 'groups_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'status',
        'group_cate',
        'block',
        'order',
        'data',
        'group_product',
    ];
}
