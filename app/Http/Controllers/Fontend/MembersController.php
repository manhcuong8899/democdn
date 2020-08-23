<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use VNPCMS\Flasher\Facades\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Utils\FileUtils;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use VNPCMS\Orders\Orders;
use Illuminate\Support\Facades\Response;


class MembersController extends Controller
{

    public function show()
    {
        $url='show';
        $user = Auth::user();
        $profile = Profile::where('user_id',$user->id)->first();
        return view('themes.members.show',compact('user','profile','url'));
    }

    public function postupdate(Request $request)
    {
        $user = Auth::user();
        $phone = $request->phone;

        if(validatePhone($phone)==false){
            return Redirect()->back()->withErrors('Định dạng số điện thoại không đúng!')->withInput();
        }

        $phone = format_phone($phone);

        $nullemail = User::where('email',$request->email)->where('id','!=',$user->id)->get()->count();
        if($nullemail!=0){
            return redirect()->back()->withErrors('Email đã tồn tại!');
        }

        $nullphone = Profile::where('phone',$phone)->where('user_id','!=',$user->id)->get()->count();
        if($nullphone!=0){
            return redirect()->back()->withErrors('Số điện thoại đã được sử dụng!');
        }


        $user->email = $request->email;
        $user->full_name = $request->full_name;
        $user->save();

        $profile = Profile::where('user_id',$user->id)->first();

       if($profile==null){
           $input['phone'] = $phone;
           $input['birthday'] = $request->birthday;
           $input['address'] = $request->address;
           $input['user_id'] = $user->id;
           Profile::create($input);
       }else{
           $profile->phone = $phone;
           $profile->birthday = $request->birthday;
           $profile->address = $request->address;
           $profile->save();

       }
        return redirect()->back()->with('status','Cập nhật thông tin thành công!');
    }


    public function postregister(Request $request){
        $lang = getCurrentSessionAppLocale();
        $data = array();
        $email = $request->email;
        if($request->email=='' || $request->password=='' || $request->full_name==''){
            $data = array(
                        'check'=>false,
                        'message'=>'Chưa điền đầy đủ các trường thông tin!',);
            return response::json($data);
        }


        if(User::where('email',$email)->get()->count()!=0){
            $data = array(
            'check'=>false,
            'message'=>'Email đã tồn tại!',);
            return response::json($data);
        }

         if($request->password!=$request->confirmpassword){
             $data = array(
                 'check'=>false,
                 'message'=>'Mật khẩu xác nhận không chính xác!',);
             return response::json($data);
        }

        $phone = $request->phone;

        if(validatePhone($phone)==false){
            $data = array(
                'check'=>false,
                'message'=>'Định dạng số điện thoại không đúng!',);
            return response::json($data);
        }

        $phone = format_phone($phone);
        $nullphone = Profile::where('phone',$phone)->get()->count();
        if($nullphone!=0){
            $data = array(
                'check'=>false,
                'message'=>'Số điện thoại đã được sử dụng!',);
            return response::json($data);
        }

        $input['password']=bcrypt($request->password);
        $input['verified']=1;
        $input['locale']=$lang;
        $input['type']='customer';
        $input['email']=$request->email;
        $input['username']=$request->email;
        $input['full_name']=$request->full_name;
        $input['password']=bcrypt($request->password);

        $user = User::create($input);

        /* Tạo Profile */


        $profile=array(
            'phone'=>$phone,
            'address'=>$request->address,
            'city'=>$request->city,
            'user_id'=>$user->id,
            );
            Profile::create($profile);

        Auth::loginUsingId($user->id);
        $data = array(
            'check'=>true,
            'message'=>'Đăng ký tài khoản thành công',
            'redirect'=>'/',
            );
        return response::json($data);
        if(Session::has('cart')){

            $data = array(
                'check'=>true,
                'message'=>'Đăng ký tài khoản thành công',
                'redirect'=>'checkout',
            );
            return response::json($data);
        }
            $data = array(
                'check'=>true,
                'message'=>'Đăng ký tài khoản thành công',
                'redirect'=>'/',
            );
            return response::json($data);
    }

    public function postgetpassword(Request $request)
    {
        $email = $request->email;
        $user = User::where('email',$email)->first();
        if($user==null){
            return redirect()->back()->withErrors('Địa chỉ email không tồn tại trên hệ thống!');
        }
        $newpassword = createRandomPassword();

        /* Dữ liệu truyền vào view gửi email*/
        $formData = array('email' => $email, 'password' => $newpassword);
        try {
            Mail::send('emails.password', $formData, function ($message) use ($request) {
                $message->from(config('mail.from.address'), config('mail.from.name'));
                $message->to($request->email)->subject('Mật khẩu mới - BF365');
            });
            $user->password = bcrypt($newpassword);
            $user->save();
            return redirect()->back()->with('status','Mật khẩu mới đã được gửi vào email:'.$email.' thành công');
        } catch (Exception $ex) {
            return Redirect::back()->withErrors(array('error-email' => 'Error email...!'))->withInput();
        }


    }

    public function postchangepass(Request $request)
    {
        $newpassword = $request->newpassword;
        $oldpassword = $request->oldpassword;
        $confirmpassword = $request->confirmpassword;
        $user = Auth::user();
        if($newpassword=='' || $oldpassword=='' || $confirmpassword==''){
            return redirect()->back()->withErrors('Dữ liệu các thông tin không được để trống!');
        }

        if($newpassword!=$confirmpassword){
            return redirect()->back()->withErrors('Mật khẩu mới và mật khẩu xác nhận không trùng nhau!');
        }

        if(bcrypt($oldpassword)!=$user->password){
            return redirect()->back()->withErrors('Mật khẩu cũ không chính xác!');
        }

        $user->password = bcrypt($newpassword);
        $user->save();
        return redirect()->back()->with('status','Thay đổi mật khẩu thành công');
    }

    public function orders()
    {
        $url = 'orders';
        $user = Auth::user();
        $complete = Orders::where('customer_id',$user->id)->where('status',6)->get();
        $wait = Orders::where('customer_id',$user->id)->whereIn('status',[1,2,3,4,5])->get();
        $needconfirm = Orders::where('customer_id',$user->id)->where('status',4)->get();
        $unpaid = Orders::where('customer_id',$user->id)->where('status',1)->get();
        return view('themes.members.orders',compact('url','complete','wait','needconfirm','unpaid'));
    }
}