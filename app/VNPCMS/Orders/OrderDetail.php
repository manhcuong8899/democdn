<?php

namespace VNPCMS\Orders;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_detail';
    public $timestamps = true;

    protected $fillable = ['order_id','product_id','price','quantity','totalprice','coupon','fee'];

    public function product() {
        return $this->hasOne('VNPCMS\Products\Products','id', 'product_id');
    }

    public function order() {return $this->hasOne('VNPCMS\Orders\Orders','id', 'order_id');
    }


}
