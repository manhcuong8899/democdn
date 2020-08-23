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
use VNPCMS\Orders\OrderDetail;
use VNPCMS\Orders\Orders;
use VNPCMS\Orders\OrdersApplicationService;
use VNPCMS\Orders\Repository\OrdersRepositoryInterface;
use VNPCMS\Orders\StatusOrder;
use VNPCMS\Orders\TypeOrder;
use Illuminate\Support\Facades\Redirect;


class OrdersController extends Controller
{

    /**
     * Instance of VNPCMS\News\Repository\NewsRepositoryInterface
     *
     * @var Object
     */
    private $OrdersRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(OrdersRepositoryInterface $OrdersRepository)
    {
        $this->OrdersRepository = $OrdersRepository;
        $this->middleware('auth');
        $this->middleware('role:administrator');
    }

    /**

     *
     * @return View;
     **/
    public function type(Request $request)
    {
        $type = TypeOrder::where('code',$request->type)->firstOrFail();

        $orders = $this->OrdersRepository->GetByType($type->id);
        $status = StatusOrder::orderBy('id','asc')->where('type_order',$type->id)->get();
            return view('orders.online',compact('orders','type','status'));

    }

    public function status(Request $request)
    {

        $type = TypeOrder::where('code',$request->type)->firstOrFail();

        $nowstatus = StatusOrder::where('code',$request->status)->where('type_order',$type->id)->firstOrFail();

        $orders = $this->OrdersRepository->GetByStatus($nowstatus->id);

        $status = StatusOrder::orderBy('id','asc')->where('type_order',$type->id)->get();

        /* ----  Chuyển view cho từng loại đơn hàng*/
        if($type->code=='online')
        {
            return view('orders.statusonline',compact('orders','type','status','nowstatus'));
        }
        else{
            return view('orders.statuspackage',compact('orders','type','status','nowstatus'));
        }


    }

    public function movestatus(Request $request)
    {
        $order = $this->OrdersRepository->ById($request->id);
        $order->status = $request->status;
        $order->save();

        $nowstatus = StatusOrder::find($request->status);
        $type = TypeOrder::find($order->type_order);
        return redirect('admin/order/'.$type->code.'/'.$nowstatus->code)->with('status','Đã chuyển trạng thái thành công đơn hàng: #'.$order->code);

    }

    public function seach(Request $request)
    {
        $articles = $request->all();

        if($request->fromdate > $request->todate)
        {
            return Redirect::back()->with('flash_message', 'Ngày truy vấn sau đã qua so với ngày bắt đầu tìm kiếm!');
        }


        if(($request->fromdate=='' && $request->todate=='') &&  $request->code=='')
        {
            return Redirect::back()->with('flash_message', 'hập ngày tháng hoặc mã đơn hàng thực hiện tìm kiếm!');
        }

        $type = TypeOrder::find($request->type);
        $nowstatus = StatusOrder::find($request->status);
        $status = StatusOrder::orderBy('id','asc')->where('type_order',$type->id)->get();

            if($request->code=='') {
                $seachs= $this->OrdersRepository->SeachByDate($articles);
                return view('orders.seachonline',compact('seachs','type','status','nowstatus'));
            }

            if($request->fromdate=='') {
                $seachs = $this->OrdersRepository->SeachByCode($articles);
                return view('orders.seachonline',compact('seachs','type','status','nowstatus'));
            }

            $seachs= $this->OrdersRepository->SeachAll($articles);
            return view('orders.seachonline',compact('seachs','type','status','nowstatus'));


    }



    public function delete($id)
    {
        // see if authenticated user has permission to delete users
        $OrdersApplicationService = new OrdersApplicationService();
        $OrdersApplicationService->delete($id);

        Flash::success('Xóa đơn hàng thành công!');

        return back();
    }

    public function detail($id)
    {
        $order = Orders::find($id);
        $type = TypeOrder::where('code','online')->firstOrFail();
        $details = OrderDetail::where('order_id',$id)->get();
        return view('orders.detail',compact('details','type','order'));
    }

}