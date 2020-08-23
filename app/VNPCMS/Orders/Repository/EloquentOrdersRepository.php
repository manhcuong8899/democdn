<?php
namespace VNPCMS\Orders\Repository;
use VNPCMS\Catearticle\CateArticles;
use VNPCMS\Orders\Orders;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use VNPCMS\Catearticle\Repository\CateArticlesRepositoryInterface;
use App;
use App\Models\Join_Orders;
use VNPCMS\Orders\TypeOrder;
use Illuminate\Support\Facades\Auth;

class EloquentOrdersRepository implements OrdersRepositoryInterface
{

    public function ById($id)
    {
        return Orders::find($id);
    }

    public function GetByType($type)
    {
        if(Auth::user()->hasRole('administrator')==false) {
            return Orders::orderBy('created_at','desc')
                ->where('type_order',$type)
                ->where('customer_id',Auth::user()->id)
                ->get();
        }
        return Orders::orderBy('created_at','desc')->where('type_order',$type)->get();
    }

    public function GetByStatus($status)
    {
        if(Auth::user()->hasRole('administrator')==false) {
            return Orders::orderBy('created_at','desc')
                ->where('status',$status)
                ->where('customer_id',Auth::user()->id)
                ->get();
        }
        return Orders::orderBy('created_at','desc')
            ->where('status',$status)
            ->get();
    }

    public function SeachByDate($articles)
    {
        if(Auth::user()->hasRole('administrator')==false){
            return $seachs = Orders::orderBy('created_at','desc')
                ->where('created_at','>=',date($articles['fromdate']))
                ->where('created_at','<=',date($articles['todate']))
                ->where('type_order',$articles['type'])
                ->where('status',$articles['status'])
                ->where('customer_id',Auth::user()->id)
                ->get();
        }
        return $seachs = Orders::orderBy('created_at','desc')
            ->where('created_at','>=',date($articles['fromdate']))
            ->where('created_at','<=',date($articles['todate']))
            ->where('type_order',$articles['type'])
            ->where('status',$articles['status'])
            ->get();
    }

    public function SeachByCode($articles)
    {
        if(Auth::user()->hasRole('administrator')==false){
            return $seachs = Orders::orderBy('created_at','desc')
                ->where('type_order',$articles['type'])
                ->where('status',$articles['status'])
                ->where('code',$articles['code'])
                ->where('customer_id',Auth::user()->id)
                ->get();
        }
        return $seachs = Orders::orderBy('created_at','desc')
            ->where('type_order',$articles['type'])
            ->where('status',$articles['status'])
            ->where('code',$articles['code'])
            ->get();
    }

    public function SeachAll($articles)
    {
        if(Auth::user()->hasRole('administrator')==false){
            return $seachs = Orders::orderBy('created_at','desc')
                ->where('created_at','>=',date($articles['fromdate']))
                ->where('created_at','<=',date($articles['todate']))
                ->where('type_order',$articles['type'])
                ->where('status',$articles['status'])
                ->where('code',$articles['code'])
                ->where('customer_id',Auth::user()->id)
                ->get();
        }
        return $seachs = Orders::orderBy('created_at','desc')
            ->where('created_at','>=',date($articles['fromdate']))
            ->where('created_at','<=',date($articles['todate']))
            ->where('type_order',$articles['type'])
            ->where('status',$articles['status'])
            ->where('code',$articles['code'])
            ->get();
    }


    public function deleteById($id)
    {
        $order = $this->ById($id);
        $order->delete();
    }


}
