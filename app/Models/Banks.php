<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banks extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
	public $timestamps = true;
	
    protected $table = 'bank';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bankname',
        'banknumber',
        'accountbank',
        'branch',
		'cate_id',
        'status',
        'customer_id',
        'order',
        'locale',
    ];

}
