<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Emails;
use VNPCMS\Flasher\Facades\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Utils\FileUtils;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use VNPCMS\Notification\TypeNotification;
use App\Models\Sendemails;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;


class SendemailsController extends Controller
{

    public function index(Request $request)
    {
        $group = 'emails';
        $code = $request->code;
        $type = TypeNotification::where('group',$group)->where('code',$code)->first();
        $notification = Sendemails::where('type',$type->id)->get();
        return view('sendemail.index',compact('notification','type'));
    }

    public function postcreate(Request $request,$code)
    {
        $datenow = Carbon::now();
        $group = 'emails';
        $articles=$request->all();

        if($articles['title']=='')
        {
            return redirect()->back()->withErrors('Bạn chưa điền tiêu đề nội dung gửi email!');
        }

        if($articles['formsend']==0)
        {
            return redirect()->back()->withErrors('Bạn chưa điền tiêu đề nội dung gửi email!');
        }

        if(($articles['formsend']==1 && $articles['start_date']=="")|| ($articles['formsend']==2 && $articles['start_date']==""))
        {
            return redirect()->back()->withErrors('Bạn chưa điền thời gian gửi!');
        }

        if(($articles['formsend']==1 && $articles['start_date'] < $datenow) || ($articles['formsend']==2 && $articles['start_date'] < $datenow))
        {
            return redirect()->back()->withErrors('Thời gian đặt gửi phải sau ngày hiện tại!');
        }

        if($articles['formsend']==2 && $articles['end_date']=="")
        {
            return redirect()->back()->withErrors('Bạn chưa điền thời gian kết thúc gửi email!');
        }

        if($articles['formsend']==2 && ($articles['end_date']< $articles['start_date']))
        {
            return redirect()->back()->withErrors('Thời gian kết thúc phải sau thời gian đặt gửi!');
        }



        $articles['type'] = TypeNotification::where('group',$group)->where('code',$code)->first()->id;

        Sendemails::create($articles);

        return redirect()->back()->with('status','Bạn đã tạo thông tin gửi emai thành công');

    }

    public function edit($id)
    {
        $group = 'emails';
        $info = Sendemails::find($id);
        $type = TypeNotification::find($info->type);
        $notifications = Sendemails::where('type',$type->id)->get();
        return view('sendemail.edit',compact('info','notifications'));
    }


    public function postupdate(Request $request)
    {
        $datenow = Carbon::now();
        $group = 'emails';
        $articles=$request->all();
     $info = Sendemails::find($request->id);

        if($articles['title']=='')
        {
            return redirect()->back()->withErrors('Bạn chưa điền tiêu đề nội dung gửi email!');
        }

        if($articles['formsend']==0)
        {
            return redirect()->back()->withErrors('Bạn chưa điền tiêu đề nội dung gửi email!');
        }

        if(($articles['formsend']==1 && $articles['start_date']=="")|| ($articles['formsend']==2 && $articles['start_date']==""))
        {
            return redirect()->back()->withErrors('Bạn chưa điền thời gian gửi!');
        }

        if(($articles['formsend']==1 && $articles['start_date'] < $datenow) || ($articles['formsend']==2 && $articles['start_date'] < $datenow))
        {
            return redirect()->back()->withErrors('Thời gian đặt gửi phải sau ngày hiện tại!');
        }

        if($articles['formsend']==2 && $articles['end_date']=="")
        {
            return redirect()->back()->withErrors('Bạn chưa điền thời gian kết thúc gửi email!');
        }

        if($articles['formsend']==2 && ($articles['end_date']< $articles['start_date']))
        {
            return redirect()->back()->withErrors('Thời gian kết thúc phải sau thời gian đặt gửi!');
        }

        $info->update($articles);

        return redirect()->back()->with('status','Đã sửa thông tin gửi email thành công!');
    }

    public function delete($id)
    {
        // see if authenticated user has permission to delete users
        $info = Sendemails::find($id);
        $code = TypeNotification::find($info->type)->code;
        $info->delete();

        Flash::success('Xóa thông tin thành công!');

        return redirect('admin/sendemails/'.$code);
    }

    public function listregister()
    {
        $listemail = Emails::orderBy('email','asc')->get();
        return view('sendemail.listemail',compact('listemail'));
    }

    public function deleteemail($id)
    {
        // see if authenticated user has permission to delete users
        $email = Emails::find($id);
        $email->delete();

        Flash::success('Xóa địa chỉ email thành công!');

        return redirect()->back();
    }

    public function seachemail(Request $request)
    {
        $status = $request->get('status');

        $query = Emails::query();
        if ($status!= -1) {
            $query = $query->where('status', '=',$status);
        }
        $listemail =  $query->orderBy('email','asc')->get();
        return view('sendemail.listemail',compact('listemail'));
    }

    public function exportEmail($status)
    {
        if($status==-1){
            $filename = 'Tất cả Email';
        }
        if($status==1){
            $filename = 'Email đã kích hoạt';
        }
        if($status==0){
            $filename = 'Email chưa kích hoạt';
        }

        $query = Emails::query();
        if ($status!= -1) {
            $query = $query->where('status', '=',$status);
        }
        $emails =  $query->orderBy('email','asc')->get();

        $data = array();
        foreach($emails as $key=>$email){

            if($email->status==1){
                $statusemail = 'Đã kích hoạt';
            }
            if($email->status==0){
                $statusemail = 'Chưa kích hoạt';
            }

            $data[$key]= array(
                'Thứ tự'=>$key+1,
                'Địa chỉ email'=>$email->email,
                'Trạng thái'=>$statusemail,
            );
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

}