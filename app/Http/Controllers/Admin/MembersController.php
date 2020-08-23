<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\Package;
use App\Models\Province;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use VNPCMS\Banks\Banks;
use VNPCMS\Catearticle\CateArticles;
use VNPCMS\Flasher\Facades\Flash;
use Illuminate\Http\Request;
use VNPCMS\Catearticle\Repository\CateArticlesRepositoryInterface;
use Illuminate\Support\Facades\App;
use App\Utils\FileUtils;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use VNPCMS\Banks\BanksApplicationService;
use VNPCMS\Banks\Repository\BanksRepositoryInterface;
use VNPCMS\Orders\StatusOrder;
use Illuminate\Support\Facades\DB;


class MembersController extends Controller
{
    /**

     *
     * @return View;
     **/
    public function bank()
    {
        $cates = CateArticles::where('group','banks')->get();
        $banks= Banks::where('customer_id',Auth::user()->id)->get();

        return view('members.bank',compact('cates','banks'));
    }

    public function address()
    {
        $cates = Province::orderBy('name','asc')->get();
        $address= Address::where('customer_id',Auth::user()->id)->get();
        return view('members.address',compact('address','cates'));
    }

    public function createaddress(Request $request)
    {
        $attributes = $request->all();

        if($request->customer_id==null){
            $attributes['customer_id']=Auth::user()->id;
        }

        if($request->address=="")
        {
            return redirect()->back()->withErrors('Nhập địa chỉ giao hàng!');
        }
        if($request->city==0)
        {
            return redirect()->back()->withErrors('Chọn tỉnh thành phố!');
        }
        if($request->phone=="")
        {
            return redirect()->back()->withErrors('Nhập số điện thoại nhận hàng!');
        }
        if($request->receiver_user=="")
        {
            return redirect()->back()->withErrors('Nhập tên người nhận hàng!');
        }
        if($request->is_primary==1){
            Address::where('is_primary','1')->update(['is_primary' => 0]);
        }
        Address::create($attributes);

        return redirect()->back()->with('status','Thêm thành công địa chỉ giao hàng!');
    }

    public function editaddress(Request $request)
    {
        $cates = Province::orderBy('name','asc')->get();
        $address= Address::where('customer_id',Auth::user()->id)->get();
        $diachi = Address::find($request->id);
        return view('members.editaddress',compact('address','cates','diachi'));
    }


    public function updateaddress(Request $request)
    {
        $attributes = $request->all();
        $attributes['customer_id']=Auth::user()->id;

        if($request->address=="")
        {
            return redirect()->back()->withErrors('Nhập địa chỉ giao hàng!');
        }
        if($request->city==0)
        {
            return redirect()->back()->withErrors('Chọn tỉnh thành phố!');
        }

        if($request->phone=="")
        {
            return redirect()->back()->withErrors('Nhập số điện thoại nhận hàng!');
        }
        if($request->receiver_user=="")
        {
            return redirect()->back()->withErrors('Nhập tên người nhận hàng!');
        }

        $count = Address::where('address',$request->address)
            ->where('city',$request->city)
            ->where('id','!=',$request->id)->count();

        if($count!=0)
        {
            return redirect()->back()->withErrors('Đã tồn tại địa chỉ!');
        }


        if($request->is_primary==1){
            Address::where('is_primary','1')->where('id','!=',$request->id)->update(['is_primary' => 0]);
        }

        Address::find($request->id)->update($attributes);

        return redirect()->back()->with('status','Cập nhật thành công địa chỉ giao hàng!');
    }

    public function deleteaddress(Request $request)
    {
       Address::find($request->id)->delete();
        return redirect()->back()->with('status','Xóa địa chỉ giao hàng thành công!');
    }

    public function orders(Request $request) {
        $email = $request->email;
        $user = User::where('email',$email)->first();
        $user->load('profile.user');

        $status = StatusOrder::where('type_order', '=', 1)->lists('name', 'id')->toArray();

        $orders = Order::orderBy('created_at', 'desc')->where('creator_id',$user->id)->get();
        $queryorderCount = DB::table('order')
            ->select('status', DB::raw('count(*) as total'));
        $queryorderCount = $queryorderCount->where('creator_id', $user->id);

        $orderCount = $queryorderCount->groupBy('status')->get();

        $orderStatus = DB::table('status_order')->get();
        $cusorderInfo = array();
        foreach ($orderStatus as $status) {
            $cusorderInfo[$status->id] = 0;
        }
        foreach ($orderCount as $aStatus) {
            $cusorderInfo[$aStatus->status] = $aStatus->total;
        }


        return view('profiles.order')
            ->with('status', $status)
            ->with('orders', $orders)
            ->with('cusorderInfo',$cusorderInfo)
             ->with('user', $user);
    }

    public function orderstatus(Request $request) {
        $email = $request->email;
        $codestatus = $request->status;
        $getstatus = StatusOrder::where('code',$codestatus)->first();
        $user = User::where('email',$email)->first();
        $user->load('profile.user');

        $status = StatusOrder::where('type_order', '=', 1)->lists('name', 'id')->toArray();

        $orders = Order::orderBy('created_at', 'desc')->where('creator_id',$user->id)->where('status',$getstatus->id)->get();

        $queryorderCount = DB::table('order')
            ->select('status', DB::raw('count(*) as total'));
            $queryorderCount = $queryorderCount->where('creator_id', $user->id);

            $orderCount = $queryorderCount->groupBy('status')->get();

            $orderStatus = DB::table('status_order')->get();
            $cusorderInfo = array();
            foreach ($orderStatus as $status) {
                $cusorderInfo[$status->id] = 0;
            }
            foreach ($orderCount as $aStatus) {
                $cusorderInfo[$aStatus->status] = $aStatus->total;
            }

        return view('profiles.order')
            ->with('status', $status)
            ->with('orders', $orders)
            ->with('getstatus', $getstatus)
            ->with('cusorderInfo',$cusorderInfo)
            ->with('user', $user);
    }

    public function packages(Request $request) {
        $email = $request->email;
        $user = User::where('email',$email)->first();
        $user->load('profile.user');

        $status = StatusOrder::where('type_order', '=', 2)->lists('name', 'id')->toArray();

        $packages = Package::orderBy('created_at', 'desc')->where('creator_id',$user->id)->get();

        $querypackageCount = DB::table('package')
            ->select('status', DB::raw('count(*) as total'));;
        $querypackageCount = $querypackageCount->where('creator_id', $user->id);
        $packageCount = $querypackageCount->groupBy('status')->get();
        $orderStatus = DB::table('status_order')->get();
        $cuspackageInfo = array();
        foreach ($orderStatus as $status) {
            $cuspackageInfo[$status->id] = 0;
        }
        foreach ($packageCount as $aStatus) {
            $cuspackageInfo[$aStatus->status] = $aStatus->total;
        }

        return view('profiles.package')
            ->with('status', $status)
            ->with('packages', $packages)
            ->with('cuspackageInfo', $cuspackageInfo)
            ->with('user', $user);
    }

    public function packagestatus(Request $request) {
        $email = $request->email;
        $codestatus = $request->status;
        $getstatus = StatusOrder::where('code',$codestatus)->first();
        $user = User::where('email',$email)->first();
        $user->load('profile.user');

        $status = StatusOrder::where('type_order', '=', 2)->lists('name', 'id')->toArray();

        $packages =Package::orderBy('created_at', 'desc')->where('creator_id',$user->id)->where('status',$getstatus->id)->get();
        $querypackageCount = DB::table('package')
            ->select('status', DB::raw('count(*) as total'));;
        $querypackageCount = $querypackageCount->where('creator_id', $user->id);
        $packageCount = $querypackageCount->groupBy('status')->get();
        $orderStatus = DB::table('status_order')->get();
        $cuspackageInfo = array();
        foreach ($orderStatus as $status) {
            $cuspackageInfo[$status->id] = 0;
        }
        foreach ($packageCount as $aStatus) {
            $cuspackageInfo[$aStatus->status] = $aStatus->total;
        }
        return view('profiles.package')
            ->with('status', $status)
            ->with('packages', $packages)
            ->with('getstatus', $getstatus)
            ->with('cuspackageInfo', $cuspackageInfo)
            ->with('user', $user);
    }
}