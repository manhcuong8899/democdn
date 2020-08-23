<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Linktype extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = true;
    protected $table = 'linktype';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'vn',
        'en',
        'name',
        'category',
        'order',
        'status',
    ];

}
