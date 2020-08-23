<?php
namespace VNPCMS\Complaints\Repository;
use VNPCMS\Catearticle\CateArticles;
use VNPCMS\Complaints\Complaints;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use VNPCMS\Catearticle\Repository\CateArticlesRepositoryInterface;
use App;
use App\Models\Join_Complaints;
use VNPCMS\Orders\TypeOrder;
use Illuminate\Support\Facades\Auth;

class EloquentComplaintsRepository implements ComplaintsRepositoryInterface
{

    public function ById($id)
    {
        return Complaints::find($id);
    }

    public function GetAll()
    {
        if(Auth::user()->type=='customer'){
            return Complaints::orderBy('created_at','asc')
                ->where('customer_id',Auth::user()->id)
                ->get();
        }
        return Complaints::orderBy('created_at','asc')
            ->where('admin_id',Auth::user()->id)->get();
    }


    public function GetByStatus($status)
    {
        if(Auth::user()->type=='customer'){
            return Complaints::orderBy('created_at','desc')
                ->where('status',$status)
                ->where('customer_id',Auth::user()->id)
                ->get();
        }

        return Complaints::orderBy('created_at','desc')
            ->where('status',$status)
            ->get();
    }

    public function SeachByDate($articles)
    {
        if(Auth::user()->hasRole('administrator')==false){
            return $seachs = Complaints::orderBy('created_at','desc')
                ->where('created_at','>=',date($articles['fromdate']))
                ->where('created_at','<=',date($articles['todate']))
                ->where('status',$articles['status'])
                ->where('customer_id',Auth::user()->id)
                ->get();
        }

        return $seachs = Complaints::orderBy('created_at','desc')
            ->where('created_at','>=',date($articles['fromdate']))
            ->where('created_at','<=',date($articles['todate']))
            ->where('status',$articles['status'])
            ->get();
    }

    public function SeachByCode($articles)
    {
        if(Auth::user()->hasRole('administrator')==false){
            return $seachs = Complaints::orderBy('created_at','desc')
                ->where('status',$articles['status'])
                ->where('code',$articles['code'])
                ->where('customer_id',Auth::user()->id)
                ->get();
        }
        return $seachs = Complaints::orderBy('created_at','desc')
            ->where('status',$articles['status'])
            ->where('code',$articles['code'])
            ->get();
    }

    public function SeachAll($articles)
    {
        if(Auth::user()->hasRole('administrator')==false){
            return $seachs = Complaints::orderBy('created_at','desc')
                ->where('created_at','>=',date($articles['fromdate']))
                ->where('created_at','<=',date($articles['todate']))
                ->where('status',$articles['status'])
                ->where('code',$articles['code'])
                ->where('customer_id',Auth::user()->id)
                ->get();
        }

        return $seachs = Complaints::orderBy('created_at','desc')
            ->where('created_at','>=',date($articles['fromdate']))
            ->where('created_at','<=',date($articles['todate']))
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
