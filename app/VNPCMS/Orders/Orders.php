<?php

namespace VNPCMS\Orders;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'order';
    public $timestamps = true;

    protected $fillable = ['code','customer_id','user_id','delivery_date','status',
        'cost','total','discount','freight','full_name','email','city','phone','phonepay','phone2pay',
        'emailbill','address','type_order'];

    public function detail() {
        return $this->hasMany('VNPCMS\Orders\OrderDetail','order_id', 'id');
    }

    public function orderstatus() {
        return $this->hasOne('VNPCMS\Orders\StatusOrder','id', 'status');
    }

    public function staff() {
        return $this->hasOne('app\Models\User','id', 'user_id');
    }

    public function customer() {
        return $this->hasOne('app\Models\User','id', 'customer_id');
    }

}
