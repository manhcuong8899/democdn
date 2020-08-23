<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sendemails extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = true;

    protected $table = 'sendemail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'formsend',
        'status',
        'start_date',
        'end_date',
        'type',
    ];

}
