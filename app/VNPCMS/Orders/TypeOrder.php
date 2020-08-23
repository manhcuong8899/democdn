<?php

namespace VNPCMS\Orders;

use Illuminate\Database\Eloquent\Model;

class TypeOrder extends Model
{
    protected $table = 'type_order';

    protected $fillable = ['code','name'];
}
