<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Join extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = true;

    protected $table = 'join';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'join_id',
        'cate_id',
    ];

}
