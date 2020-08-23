<?php

namespace VNPCMS\Complaints;

use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    protected $table = 'complaints';
    public $timestamps = true;

    protected $fillable = ['images','status','title','short','customer_id','admin_id','reference_id','type'];

    public function Complaintstatus() {
        return $this->hasOne('VNPCMS\Orders\StatusOrder','id', 'status');
    }

    public function staff() {
        return $this->hasOne('app\Models\User','id', 'user_id');
    }
	
    public function reference() {
		if($this->type == 1){
			return $this->hasOne('\App\Models\Order','id', 'reference_id');
		}
		if($this->type == 2){
			return $this->hasOne('\App\Models\Package','id', 'reference_id');
		}
		return null;
    }

    public function customer() {
        return $this->hasOne('app\Models\User','id', 'customer_id');
    }

}
