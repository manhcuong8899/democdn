<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Join_mode extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = false;

    protected $table = 'join_mode';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'join_id',
        'item_id',
        'group',
    ];

}
