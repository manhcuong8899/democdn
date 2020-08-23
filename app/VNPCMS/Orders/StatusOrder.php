<?php

namespace VNPCMS\Orders;

use Illuminate\Database\Eloquent\Model;

class StatusOrder extends Model
{
    protected $table = 'status_order';
    public $timestamps = true;

    protected $fillable = ['code','name','comment','type_order'];
}
