<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = true;

    protected $table = 'address';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address',
        'status',
        'phone',
        'receiver_user',
        'is_primary',
        'city',
        'customer_id',
    ];

    public function cates() {
        return $this->hasOne('App\Models\Province','id', 'city');
    }

}
