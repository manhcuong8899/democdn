<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use VNPCMS\Catearticle\CateArticles;
use VNPCMS\Flasher\Facades\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Utils\FileUtils;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\Feedback;
use Illuminate\Support\Facades\Mail;



class FeedbackController extends Controller
{
    public function index()
    {
        $feedback = Feedback::orderBy('created_at','desc')->get();
        return view('feedback.index',compact('feedback'));
    }

    public function view($id)
    {
        $feedback = Feedback::Find($id);
        $feedbacks = Feedback::orderBy('created_at','asc')->where('id','!=',$id)->where('status','noreply')->get();

        return view('feedback.view',compact('feedback','feedbacks'));
    }

    public function postReply(Request $request)
    {
        $reply = $request->reply;
        if($reply==""){
            return redirect()->back()->withErrors('Chưa điền nội dung trả lời!');
        }
        $id = $request->feedbackid;
        $feedback = Feedback::find($id);
        $feedback->status='reply';
        $feedback->reply=$reply;
        $feedback->save();
        $email = $feedback->email;

        /* Dữ liệu truyền vào view gửi email*/
        $formData = array('email' => $email, 'title' => $feedback->title,'content'=>$feedback->content,'reply'=>$reply);
        try {
            Mail::send('emails.feedback', $formData, function ($message) use ($request,$email) {
                $message->from(config('mail.from.address'), config('mail.from.name'));
                $message->to($email)->subject('TRẢ LỜI LIÊN HỆ');
            });
            return redirect()->back()->with('status','Trả lời góp ý đã được gửi tới: '.$email.' thành công!');
        } catch (Exception $ex) {
            return Redirect::back()->withErrors(array('error-email' => 'Error email...!'))->withInput();
        }

        return redirect()->back();
    }

    public function status(Request $request)
    {
        $code= $request->code;
        $feedback = Feedback::orderBy('created_at','desc')->where('status',$code)->get();
        return view('feedback.index',compact('feedback'));
    }

    public function delete($id)
    {
        Feedback::find($id)->delete();
        Flash::success('Xóa góp ý thành công!');
        return redirect()->back();
    }

}