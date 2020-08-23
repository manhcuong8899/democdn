<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crawler extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
	public $timestamps = false;
	
    protected $table = 'crawler';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'ebay-serp',
        'token',
        'formatdata',
        'get_cookies',
		'cookies_session',
        'autoparse',
        'country',
    ];

}
