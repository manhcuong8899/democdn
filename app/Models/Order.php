<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Log;
use App\Http\Controllers\Controller;

class Order extends Model {


    protected $table = 'order';
    protected $fillable = ['code', 'status', 'address', 'fullname',
        'province_id', 'district', 'phone', 'email', 'note', 
        'fee_transaction', 'fee_insurrance','complaints_id', 
        'arrive_date','output_date','weight',
        'creator_id', 'created_at',
        'updated_at'];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'output_date',
        'arrive_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['totalprices','totalproductprices','totalproducts', 
	'totalfees','totalfeeforeignvietnamfreights','totalspecialtax', 'totalfeeforeigninlandfreights' ];
    
    public function province() {
        return $this->hasOne('App\Models\Province', 'id', 'province_id');
    }
	
    public function complaints() {
        return $this->hasOne('VNPCMS\Complaints\Complaints', 'id', 'complaints_id');
    }


    public function customer() {
        return $this->hasOne('App\Models\User', 'id', 'creator_id');
    }

    public function statusorder() {
        return $this->hasOne('VNPCMS\Orders\StatusOrder', 'id', 'status');
    }

    public function ordershopdetails() {
        return $this->hasMany('App\Models\OrderShopDetail', 'order_id', 'id');
    }

	//Tổng phí Vận chuyển nội địa nước ngoài
    public function getTotalfeeforeigninlandfreightsAttribute() {
        $shopdetails = $this->ordershopdetails;
        $sum = 0;
        foreach($shopdetails as $aShopDetail){
            $sum = $sum + $aShopDetail->fee_foreign_inland_freight*$aShopDetail->rate;
        }
        return $sum;
    }
    public function getTotalspecialtaxAttribute() {
        $shopdetails = $this->ordershopdetails;
        $sum = 0;
        foreach($shopdetails as $aShopDetail){
            $sum = $sum + $aShopDetail->totalspecialtax;
        }
        return $sum;
    }
	
	//Tổng phí vận chuyển từ nước ngoài về VN
    public function getTotalfeeforeignvietnamfreightsAttribute() {
        $shopdetails = $this->ordershopdetails;
        $sum = 0;
        foreach($shopdetails as $aShopDetail){
            $sum = $sum + $aShopDetail->totalfeeforeignvietnamfreights;
        }
        return $sum;
    }
	
    public function getTotalfeesAttribute(){
		
        $shopdetails = $this->ordershopdetails;
        $sum = 0;
        foreach($shopdetails as $aShopDetail){
            $sum = $sum + $aShopDetail->totalfees;
        }
        return $sum + $this->fee_transaction*$this->totalprices/100;
    }
	//Tổng giá sp (đã bao gồm các loại phí)
    public function getTotalpricesAttribute() {
        $shopdetails = $this->ordershopdetails;
        $sum = 0;
		$fees = 0;
        foreach($shopdetails as $aShopDetail){
            $sum = $sum + $aShopDetail->totalproductprices;
			$fees = $fees + $aShopDetail->totalfees;
        }
        $sum = $sum + $fees + $this->fee_transaction*$sum/100;
        return $sum;
    }
	//Tổng giá sp (chưa kể phí) trong đơn hàng
    public function getTotalproductpricesAttribute() {
        $shopdetails = $this->ordershopdetails;
        $sum = 0;
        foreach($shopdetails as $aShopDetail){
            $sum = $sum + $aShopDetail->totalproductprices;
        }
        return $sum;
    }

	//Tổng số hàng hóa trong đơn hàng
    public function getTotalproductsAttribute(){
        $shopdetails = $this->ordershopdetails()->get();
        $sum = 0;
        foreach($shopdetails as $aShopDetail){
            $sum = $sum + $aShopDetail->orderproductdetails()->count();
        }
        return $sum;
    }


}
