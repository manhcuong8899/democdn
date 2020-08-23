<?php

namespace VNPCMS\Units;

use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
    protected $table = 'units';
    public $timestamps = true;

    protected $fillable = ['name', 'status'];
}
