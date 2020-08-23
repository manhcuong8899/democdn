<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Collection;
use Auth;
use DB;
use VNPCMS\Orders\StatusOrder;
use Log;
use \Carbon\Carbon;
use VNPCMS\Setting\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use PushNotification;
use App\Models\SupperMenus;

class Controller extends BaseController {

    use AuthorizesRequests,
        AuthorizesResources,
        DispatchesJobs,
        ValidatesRequests;

    public static function getRate($code = 'china') {
        $currency = \App\Models\Currency::where('code', '=', $code)->first();
        if ($currency) {
            return $currency->value;
        }
        return 0;
    }

    public function putCartSession($id, $order) {
        session()->put("order-$id", $order);
    }

    public function cancelCartSession($id) {
        session()->pull($id);
    }

    public function getCartSession($id = null) {
        $var = 'shoppingcart';
        if ($id) {
            $var = "order-$id";
        }
        $order = session($var);
        if (!$order) {
            $order = new \App\Models\Order;
            $fee_transaction = \VNPCMS\Setting\Setting::where('key', '=', 'purchasefee')->first();
            $order->fee_transaction = $fee_transaction->value;
            $order->fee_insurrance = 0;

            if (Auth::user()) {
                $address = \App\Models\Address::where('customer_id', '=', Auth::user()->id)
                                ->orderBy('created_at', 'desc')->orderBy('is_primary', 'desc')->first();
                if ($address) {
                    $order->address = $address->address;
                    $order->province_id = $address->city;
                    $order->fullname = $address->receiver_user;
                    $order->phone = $address->phone;
                }
            }

            session([$var => $order]);
        }
        return $order;
    }

    public function productCount() {
        $cart = $this->getCartSession();
        $total = 0;
        foreach ($cart as $keySite => $aSite) {
            foreach ($aSite as $aShop) {
                $total = $total + count($aShop['items']);
            }
        }
        return $total;
    }

    public function updateOrder($id, $inputs) {
        try {
            DB::beginTransaction();
            $order = \App\Models\Order::find($id);
            $order->update([
                'address' => isset($inputs['address']) ? $inputs['address'] : '',
                'fullname' => isset($inputs['fullname']) ? $inputs['fullname'] : '',
                'province' => isset($inputs['province']) ? $inputs['province'] : '',
                'phone' => isset($inputs['phone']) ? $inputs['phone'] : '',
                'email' => isset($inputs['email']) ? $inputs['email'] : '',
                'note' => isset($inputs['note']) ? $inputs['note'] : '',
                'fee_transaction' => isset($inputs['fee_transaction']) ? $inputs['fee_transaction'] : '',
                'fee_insurrance' => isset($inputs['fee_insurrance']) ? $inputs['fee_insurrance'] : '',
                'rate' => isset($inputs['rate']) ? $inputs['rate'] : '',
                'arrive_date' => (isset($inputs['arrive_date']) && $inputs['arrive_date'] != '') ? $inputs['arrive_date'] : null,
                'output_date' => (isset($inputs['output_date']) && $inputs['output_date'] != '') ? $inputs['output_date'] : null,
                'weight' => isset($inputs['weight']) ? $inputs['weight'] : '',
            ]);
            foreach ($order->ordershopdetails as $aDetail) {
                $aDetail->orderproductdetails()->delete();
            }
            $order->ordershopdetails()->delete();

//            dd($order->ordershopdetails()->get());

            $this->createOrderDetail($order->id, $inputs);
            DB::commit();
            return $order;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

    public function createOrder($inputs) {
        try {
            DB::beginTransaction();
            $order = \App\Models\Order::create([
                'status' => StatusOrder::where('code', '=', 'waitquotation')->first()->id,
                'address' => isset($inputs['address']) ? $inputs['address'] : '',
                'fullname' => isset($inputs['fullname']) ? $inputs['fullname'] : '',
                'province_id' => isset($inputs['province_id']) ? $inputs['province_id'] : '',
                'phone' => isset($inputs['phone']) ? $inputs['phone'] : '',
                'email' => isset($inputs['email']) ? $inputs['email'] : '',
                'note' => isset($inputs['note']) ? $inputs['note'] : '',
                'fee_transaction' => isset($inputs['fee_transaction']) ? $inputs['fee_transaction'] : '',
                'fee_insurrance' => isset($inputs['fee_insurrance']) ? $inputs['fee_insurrance'] : '',
                'rate' => isset($inputs['rate']) ? $inputs['rate'] : '',
                'arrive_date' => (isset($inputs['arrive_date']) && $inputs['arrive_date'] != '') ? Carbon::createFromFormat("Y-m-d", $inputs['arrive_date']) : null,
                'output_date' => (isset($inputs['output_date']) && $inputs['output_date'] != '') ? Carbon::createFromFormat("Y-m-d", $inputs['output_date']) : null,
                'weight' => isset($inputs['weight']) ? $inputs['weight'] : '',
                'creator_id' => Auth::user()->id,
            ]);
            $code = "CN" . Carbon::now()->format('dmY') . '-' . $order->id;
            $order->update(['code' => $code]);

            $this->createOrderDetail($order->id, $inputs);

            DB::commit();
            return $order;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

    private function createOrderDetail($orderId, $inputs) {
        $shops = $inputs['items'];
        foreach ($shops as $aShop) {
            $aDBShop = \App\Models\OrderShopDetail::create([
                'order_id' => $orderId,
                'code' => isset($aShop['code']) ? $aShop['code'] : '',
                'rate' => isset($aShop['rate']) ? $aShop['rate'] : 0,
                'currency_id' => isset($aShop['currency_id']) ? $aShop['currency_id'] : null,
                'name' => isset($aShop['name']) ? $aShop['name'] : '',
                'url' => isset($aShop['url']) ? $aShop['url'] : '',
                'note' => isset($aShop['note']) ? $aShop['note'] : '',
                'private_note' => isset($aShop['private_note']) ? $aShop['private_note'] : '',
                'is_check' => isset($aShop['is_check']) ? $aShop['is_check'] : '',
                'is_wood' => isset($aShop['is_wood']) ? $aShop['is_wood'] : '',
                'website' => isset($aShop['website']) ? $aShop['website'] : '',
                'fee_check' => isset($aShop['fee_check']) ? $aShop['fee_check'] : 0,
                'fee_wood' => isset($aShop['fee_wood']) ? $aShop['fee_wood'] : 0,
                'fee_foreign_inland_freight' => isset($aShop['fee_foreign_inland_freight']) ? $aShop['fee_foreign_inland_freight'] : 0,
                'fee_foreign_vietnam_freight' => isset($aShop['fee_foreign_vietnam_freight']) ? $aShop['fee_foreign_vietnam_freight'] : 0,
                'fee_vietnam_inland_freight' => isset($aShop['fee_vietnam_inland_freight']) ? $aShop['fee_vietnam_inland_freight'] : 0,
                'excise_tax' => isset($aShop['excise_tax']) ? $aShop['excise_tax'] : 0,
                'sumproducts' => 0,
                'sumfees' => 0,
            ]);

            $products = $aShop['items'];
            Log::error($aShop);
            foreach ($products as $aProduct) {
                \App\Models\OrderProductDetail::create([
                    'shop_id' => $aDBShop->id,
                    'name' => isset($aProduct['name']) ? $aProduct['name'] : '',
                    'quantity' => isset($aProduct['quantity']) ? $aProduct['quantity'] : 0,
                    'weight' => isset($aProduct['weight']) ? $aProduct['weight'] : 0,
                    'price' => isset($aProduct['price']) ? $aProduct['price'] : 0,
                    'image' => isset($aProduct['image']) ? $aProduct['image'] : '',
                    'description' => isset($aProduct['description']) ? $aProduct['description'] : '',
                    'note' => isset($aProduct['note']) ? $aProduct['note'] : '',
                ]);
            }
        }
    }

    public function calculatePrices($userid) {
        $aUser = User::find($userid);
        $total = 0;
        $orders = \App\Models\Order::query()
                ->where('creator_id', $userid)
                ->get();
        $packages = \App\Models\Package::query()
                ->where('creator_id', $userid)
                ->get();
        foreach ($orders as $aOrder) {
            $total += $aOrder->totalfees;
        }
        foreach ($packages as $aPackage) {
            $total += $aPackage->totalfees;
        }
        $gold = \VNPCMS\Setting\Setting::where('key', '=', 'gold')->first();
        $silver = \VNPCMS\Setting\Setting::where('key', '=', 'sliver')->first();
        $bronze = \VNPCMS\Setting\Setting::where('key', '=', 'bronze')->first();
        if ($total >= $gold->value * 1000000000) {
            $aUser->update(['level' => 'gold']);
        } else if ($total >= $silver->value * 1000000000) {
            $aUser->update(['level' => 'silver']);
        } else if ($total >= $bronze->value * 1000000000) {
            $aUser->update(['level' => 'bronze']);
        }
    }

    public function getApproveUsers() {
        $users = User::query()
                ->select('users.*')
                ->distinct()
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'role_user.role_id', '=', 'roles.id')
                ->where('roles.name', 'order')
                ->get();
        return $users;
    }

    public static function sendNotifications($users, $template, $title, $body) {
        Controller::sendMail($users, $template, $title, $body);
        Controller::sendPush($users, $title, $body);
    }
    public static function sendPush($users, $title, $body) {
        foreach ($users as $aUser) {
			$devices = \App\Models\Device::where('user_id','=',$aUser->id)->get();
			foreach ($devices as $aDevice) {
				if (!$aDevice->device_token || !$aDevice->device_type) {
					continue;
				}
				try {
					if($aDevice->device_type == 'ios'){
						PushNotification::app('appNameIOS')
							->to(strtolower($aDevice->device_token))
							->send($title);
					}else if($aDevice->device_type == 'android'){
						PushNotification::app('appNameAndroid')
							->to($aDevice->device_token)
							->send($title);
					}else if($aDevice->device_type == 'browser'){
						$optionBuilder = new OptionsBuilder();
						$optionBuilder->setTimeToLive(60*20);

						$notificationBuilder = new PayloadNotificationBuilder($title);
						$dataBuilder = new PayloadDataBuilder();
						$option = $optionBuilder->build();
						$notification = $notificationBuilder->build();
						$data = $dataBuilder->build();
						$downstreamResponse = FCM::sendTo($aDevice->device_token, $option, $notification, $data);
					}
				} catch (\Exception $e) {
					Log::error($e);
				}
			}
		}
    }
    public static function sendMail($users, $template, $title, $body) {
        //send email thông báo
        foreach ($users as $aUser) {
            if (!$aUser->email) {
                continue;
            }
            Mail::send($template, $body, function($message) use($aUser, $title) {
                $message->from(config('mail.from.address'), config('mail.from.name'));
                $message->to($aUser->email, $aUser->email)->subject($title);
            });
        }
    }

    public function configCode($code) {

        $data = Setting::where('key', $code)->first();
        if ($data != null) {
            return $data->value;
        }
    }

    public function GetTygia($code) {

        $data = Currency::where('code', $code)->first();
        if ($data != null) {
            return $data->value;
        }
    }
    public function hasmenus($id,$group) {
        $count = SupperMenus::where('url',$id)->where('type',$group)->get()->count();
        return $count;
    }
}
