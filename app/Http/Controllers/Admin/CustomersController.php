<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Flash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use VNPCMS\Catearticle\CateArticles;
use VNPCMS\Mailers\UserMailer as Mailer;
use Maatwebsite\Excel\Facades\Excel;


class CustomersController extends Controller
{

    protected $mailer;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->middleware('auth');
        $this->middleware('permission:customer_management');
    }


    public function all()
    {
        if (!hasPermission('customer_management', true))
            return redirect('admin');

        $users = User::where('type','customer')->get();

        if (request()->wantsJson()) {
            return $users;
        }
        $level = 'all';
        $levels = CateArticles::where('group','userlevel')->get();
        return view('customers.all',compact('users','level','levels'));
    }


    public function level(Request $request)
    {
        if (!hasPermission('customer_management', true))
            return redirect('admin');
        $count = User::where('type','customer')
            ->where('level',$request->level)->count();
        if($count==0)
        {
            return redirect('admin/customer')->withErrors('Không tìm thấy khách hàng!');
        }

        $users = User::where('type','customer')
            ->where('level',$request->level)->get();
        $level = $request->level;
        return view('customers.all',compact('users','level'));
    }

    public function exportCustomer($level)
    {
        ini_set('max_execution_time',360);
        ini_set('max_input_time',300);

        if($level=='all'){
            $filename = 'Tất cả khách hàng';
        }
        if($level=='gold'){
            $filename = 'Thành viên vàng';
        }
        if($level=='silver'){
            $filename = 'Thành viên bạc';
        }

        if($level=='bronze'){
            $filename = 'Thành viên bạc';
        }

        if($level=='regular'){
            $filename = 'Thành viên thường';
        }

        $query = User::query();
        $query = $query->where('type', '=','customer');
        if($level!='all'){
            $query = $query->where('level', '=',$level);
        }
        $customer =  $query->orderBy('full_name','asc')->get();
        $data = array();
        foreach($customer as $key=>$cust){
            $data[$key]= array(
                'Thứ tự'=>$key+1,
                'Họ và tên'=>$cust->full_name,
                'Email'=>$cust->email,
                'Điện thoại'=>'',
                'Đơn hàng'=>'0',
                'Kiện hàng'=>'0',
                'Cấp độ'=>'Thành viên thường',
                'Địa chỉ'=>'',
            );
            if($cust->levels!=null){
                $data[$key]['Cấp độ']=$cust->levels->name;
            }

            if($cust->profile!=null){
                $data[$key]['Điện thoại']=$cust->profile->phone;
                $data[$key]['Địa chỉ']=$cust->profile->address;
            }

            if($cust->orders!=null){
                $data[$key]['Đơn hàng']=$cust->orders->count();
            }
            if($cust->packages!=null){
                $data[$key]['Kiện hàng']=$cust->packages->count();
            }
        }
        return Excel::create($filename, function($excel) use ($data,$filename) {
            // Set the title
            $excel->setTitle($filename);
            $excel->sheet($filename, function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->export('xls');
    }

    public function movelevel(Request $request)
    {
        $customer = User::find($request->id);
        $customer->level =$request->level;
        $customer->save();

        return redirect('admin/customer')->with('status','Đã chuyển hạng thành viên thành công');

    }


}
