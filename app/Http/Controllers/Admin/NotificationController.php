<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use VNPCMS\Catearticle\CateArticles;
use VNPCMS\Flasher\Facades\Flash;
use Illuminate\Http\Request;
use VNPCMS\Catearticle\Repository\CateArticlesRepositoryInterface;
use Illuminate\Support\Facades\App;
use App\Utils\FileUtils;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use VNPCMS\Notification\Notification;
use VNPCMS\Notification\NotificationApplicationService;
use VNPCMS\Notification\Repository\NotificationRepositoryInterface;
use VNPCMS\Notification\TypeNotification;


class NotificationController extends Controller
{

    /**
     * Instance of VNPCMS\News\Repository\NewsRepositoryInterface
     *
     * @var Object
     */
    private $NotificationRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(NotificationRepositoryInterface $NotificationRepository)
    {
        $this->NotificationRepository = $NotificationRepository;

        $this->middleware('auth');
        $this->middleware('permission:notification_management');
    }

    /**

     *
     * @return View;
     **/
    public function index(Request $request)
    {
        $group = $request->group;
        $code = $request->code;
        $type = TypeNotification::where('group',$group)->where('code',$code)->first();
        $notification = $this->NotificationRepository->GetAll($type);
        $types = TypeNotification::where('group',$group)->get();
        return view('notification.index',compact('notification','type','types'));
    }

    public function postcreate(Request $request,$group,$code)
    {
        $articles=$request->all();

        if($articles['title']=='')
        {
            return redirect()->back()->withErrors('Bạn chưa điền tiêu đề thông báo!');
        }

        $null = $this->NotificationRepository->NotificationNull($articles['title']);

        if($null == false)
        {
            return redirect()->back()->withErrors('Thông báo đã tồn tại!');
        }
        $articles['group'] = $group;
        $articles['type'] = TypeNotification::where('group',$group)->where('code',$code)->first()->id;
        $articles['slug'] = str_slug($request->title).'.html';
        $this->NotificationRepository->create($articles);
		//
        $users = \App\Models\User::all();
		Controller::sendPush($users, $request->title, $request->short);

        return redirect()->back()->with('status','Bạn đã tạo thông báo thành công thành công');

    }

    public function edit(Request $request,$group,$code)
    {
        $notification = $this->NotificationRepository->ById($request->id);
        $type = TypeNotification::where('group',$group)->where('code',$code)->first();
        $notifications = $this->NotificationRepository->GetAll($type);
        return view('notification.edit',compact('notification','notifications','type'));
    }


    public function postupdate(Request $request)
    {
        $articles=$request->all();

        if($articles['title']=='')
        {
            return redirect()->back()->withErrors('Bạn chưa điền tiêu đề thông báo!');
        }

        $null = $this->NotificationRepository->NotificationNullUpdate($articles['title'],$request->id);

        if($null == false)
        {
            return redirect()->back()->withErrors('Thông báo đã tồn tại!');
        }
        $notification = $this->NotificationRepository->ById($request->id);
        $articles['slug'] = str_slug($request->title).'.html';
        $this->NotificationRepository->update($notification,$articles);
		//
        $users = \App\Models\User::all();
		Controller::sendPush($users, $request->title, $request->short);

        return redirect()->back()->with('status','Đã sửa thông báo!');
    }

    public function send(Request $request)
    {
        if($request->type==0)
        {
            return redirect()->back()->withErrors('Bạn chưa lựa chọn nhóm nhận!');
        }
        $notification = $this->NotificationRepository->ById($request->id);
        $notification->type = $request->type;
        $notification->save();
        return redirect()->back()->with('status','Gửi thông báo thành công!');
    }

    public function delete($id)
    {
        $notification = Notification::find($id);
        $notification->delete();
        Flash::success('Xóa thông báo thành công!');
        return back();
    }

}