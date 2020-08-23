<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use VNPCMS\Catearticle\CateArticles;
use VNPCMS\Complaints\Complaints;
use VNPCMS\Flasher\Facades\Flash;
use Illuminate\Http\Request;
use VNPCMS\Catearticle\Repository\CateArticlesRepositoryInterface;
use Illuminate\Support\Facades\App;
use App\Utils\FileUtils;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use VNPCMS\Complaints\ComplaintsApplicationService;
use VNPCMS\Complaints\Repository\ComplaintsRepositoryInterface;
use VNPCMS\Orders\StatusOrder;
use VNPCMS\Orders\TypeOrder;
use Auth;


class ComplaintsController extends Controller
{

    /**
     * Instance of VNPCMS\News\Repository\NewsRepositoryInterface
     *
     * @var Object
     */
    private $ComplaintsRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ComplaintsRepositoryInterface $ComplaintsRepository)
    {
        $this->ComplaintsRepository = $ComplaintsRepository;
        $this->middleware('auth');
    }

    /**

     *
     * @return View;
     **/
    public function index(Request $request)
    {
        $type = TypeOrder::where('code','complaint')->firstOrFail();
        $query = \VNPCMS\Complaints\Complaints::query();

        if (Auth::user()->hasRole('customer')) {
            $query = $query->where('customer_id', Auth::user()->id);
        }
        if (Auth::user()->hasRole('bussinessman')) {
            $query = $query->whereIn('customer_id', function($query){
                $query->select('id')->from('users')->where('user_handle_id',Auth::user()->id);
            });
        }
        if (Auth::user()->hasRole('exploiteman')) {
            
        }
        $complaints = $query->orderBy('created_at', 'desc')->get();
        $status = StatusOrder::orderBy('id','asc')->where('type_order',$type->id)->get();
        return view('complaints.index',compact('complaints','type','status'));

    }

    public function status(Request $request)
    {

        $type = TypeOrder::where('code','complaint')->firstOrFail();

        $nowstatus = StatusOrder::where('code',$request->status)->where('type_order',$type->id)->firstOrFail();

        $complaints = $this->ComplaintsRepository->GetByStatus($nowstatus->id);

        $status = StatusOrder::orderBy('id','asc')->where('type_order',$type->id)->get();

        return view('complaints.status',compact('complaints','type','status','nowstatus'));
    }

    public function view(Request $request)
    {
        $type = TypeOrder::where('code','complaint')->firstOrFail();
        $complaint = $this->ComplaintsRepository->ById($request->id);
        $status = StatusOrder::orderBy('id','asc')->where('type_order',$type->id)->get();

        $reference = $complaint->reference;
        if($reference!=null){
            $path ='complaint/'.$reference->code;
            $files = Storage::disk('files')->files($path);
            $customer = User::find($complaint->customer_id);
            return view('complaints.view',compact('complaint','type','status','files','customer'));
        }
        Complaints::find($request->id)->delete();
        Flash::success('Hóa đơn khiếu nại không tồn tại. Đã xóa khiếu nại!');
        return redirect()->back();
    }


    public function changestatus(Request $request)
    {
        $complaint = $this->ComplaintsRepository->ById($request->id);
        $complaint->status = $request->status;
        $complaint->save();
        $nowstatus = StatusOrder::find($request->status);
        return redirect('admin/complaint')->with('status','Đã xử lý trạng thái thành công đơn khiếu nại: #'.$complaint->id);

    }

    public function seach(Request $request)
    {
        $articles = $request->all();

        if($request->fromdate > $request->todate)
        {
            return redirect()->back()->withErrors('Ngày truy vấn sau đã qua so với ngày bắt đầu tìm kiếm!');
        }


        if(($request->fromdate=='' && $request->todate=='') &&  $request->code=='')
        {
            return redirect()->back()->withErrors('Nhập ngày tháng hoặc mã đơn hàng thực hiện tìm kiếm!');
        }


        $type = TypeOrder::where('code','complaint')->firstOrFail();
        $nowstatus = StatusOrder::find($request->status);
        $status = StatusOrder::orderBy('id','asc')->where('type_order',$type->id)->get();

            if($request->code=='') {
                $seachs= $this->ComplaintsRepository->SeachByDate($articles);
                return view('complaints.seach',compact('seachs','type','status','nowstatus'));
            }

            if($request->fromdate=='') {
                $seachs = $this->ComplaintsRepository->SeachByCode($articles);
                return view('complaints.seach',compact('seachs','type','status','nowstatus'));
            }

            $seachs= $this->ComplaintsRepository->SeachAll($articles);
            return view('complaints.seach',compact('seachs','type','status','nowstatus'));

    }



    public function edit(Request $request)
    {

    }


    public function postupdate(Request $request)
    {

    }


    public function delete($id)
    {
        // see if authenticated user has permission to delete users
        $ComplaintsApplicationService = new ComplaintsApplicationService();
        $ComplaintsApplicationService->delete($id);

        Flash::success('Xóa đơn khiếu nại!');

        return back();
    }

}