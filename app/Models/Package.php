<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Log;
use App\Http\Controllers\Controller;

class Package extends Model {

    protected $table = 'package';
    protected $fillable = ['code','trongluong','trongluongthuc','trongluongcongkenh','fee_shipvn','fee_TQVN', 'name', 'note', 'list', 'status', 'is_wood','is_check', 'is_insurrance',
        'package_number','box_number', 'carrier', 'tracking_number', 'package', 'direction', 'image', 'rate', 'complaints_id', 'address', 'phone', 'province_id', 'fullname', 'updated_at', 'created_at', 'creator_id','fee_check','fee_wood'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['totalprices','totalfeeforeigninlandfreights','totalfeeforeignvietnamfreights','totalproductprices', 'totalfees', 'feechecks', 'feewoods'];

	
    public function complaints() {
        return $this->hasOne('VNPCMS\Complaints\Complaints', 'id', 'complaints_id');
    }

    
    public function address() {
        return $this->hasOne('App\Models\Address', 'id', 'address_id');
    }
    
    public function customer() {
        return $this->hasOne('App\Models\User', 'id', 'creator_id');
    }
    public function getFeewoodsAttribute() {
        $sum = 0;
        if ($this->is_wood) {
            $sum = $sum + $this->fee_wood;
        }
        return $sum;
    }

    public function getFeechecksAttribute() {
        $sum = 0;
        if ($this->is_check) {
            $sum = $sum + $this->fee_check;
        }
        return $sum;
    }

    //Tổng giá sp
    public function getTotalproductpricesAttribute() {
        $productdetails = $this->packageproductdetails;
        $sum = 0;
        foreach($productdetails as $aProductDetail){
            $sum = $sum + $aProductDetail->totalproductprices;
        }
        return $sum;
    }
    //Tổng giá sp (đã bao gồm các loại phí)
    public function getTotalpricesAttribute() {
        $productdetails = $this->packageproductdetails;
        $sum = 0;
        foreach($productdetails as $aProductDetail){
            $sum = $sum + $aProductDetail->totalprices;
        }
        return $sum;
		
    }

    public function getTotalfeeforeignvietnamfreightsAttribute() {
        $productdetails = $this->packageproductdetails;
        $sum = 0;
        foreach($productdetails as $aProductDetail){
            $sum = $sum + $aProductDetail->totalfeeforeignvietnamfreights;
        }
        return $sum;
    }
	
    public function getTotalfeeforeigninlandfreightsAttribute() {
        $productdetails = $this->packageproductdetails;
        $sum = 0;
        foreach($productdetails as $aProductDetail){
            $sum = $sum + $aProductDetail->fee_foreign_inland_freight;
        }
        return $sum;
    }
    public function getTotalfeesAttribute() {
        return $this->feechecks + $this->feewoods + $this->totalfeeforeigninlandfreights + $this->totalfeeforeignvietnamfreights;
    }

    public function statusorder() {
        return $this->hasOne('VNPCMS\Orders\StatusOrder', 'id', 'status');
    }


    public function packageproductdetails() {
        return $this->hasMany('App\Models\PackageProductDetail', 'package_id', 'id');
    }
}
