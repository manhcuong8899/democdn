<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emails extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = true;

    protected $table = 'emails';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'code',
        'status',
    ];
}
