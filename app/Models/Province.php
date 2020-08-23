<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Log;
use App\Http\Controllers\Controller;

class Province extends Model {

    protected $table = 'province';

    protected $fillable = ['name'];

}
