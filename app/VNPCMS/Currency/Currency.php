<?php

namespace VNPCMS\Currency;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'currency';
    public $timestamps = true;

    protected $fillable = ['name','code','value','status'];
}
