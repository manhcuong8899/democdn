<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model {

    protected $table = 'currency';
    public $timestamps = true;
    protected $fillable = ['code','symbol','name','value','status'];
}
