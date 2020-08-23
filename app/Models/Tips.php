<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tips extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = true;


    protected $table = 'tips';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'url',
        'images',
        'short',
        'order',
        'status',
    ];

}
