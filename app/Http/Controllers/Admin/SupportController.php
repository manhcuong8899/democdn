<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Support;
use VNPCMS\Catearticle\CateArticles;
use VNPCMS\Flasher\Facades\Flash;
use Illuminate\Http\Request;
use VNPCMS\Catearticle\Repository\CateArticlesRepositoryInterface;
use Illuminate\Support\Facades\App;
use App\Utils\FileUtils;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;



class SupportController extends Controller
{

    public function index()
    {
        $cates = CateArticles::where('group','support')->get();
        $supports = array();
        foreach($cates as $value)
        {
            $supports[$value->id] =  Support::orderBy('id','asc')->where('cate_id',$value->id)->get();
        }
        return view('support.index',compact('cates','supports'));
    }

    public function postcreate(Request $request)
    {
        $articles=$request->all();

        if($articles['name']=='' || $articles['phone']=='' || $articles['email']=='')
        {
            return redirect()->back()->withErrors('Bạn chưa điền đầy đủ thông tin hỗ trợ!');
        }

        $articles['cate_id'] = $request->categories;

        Support::create($articles);

        return redirect()->back()->with('status','Bạn đã thêm hỗ trợ thành công!');

    }

    public function edit(Request $request)
    {
        $support = Support::find($request->id);
        $cates = CateArticles::where('group','support')->get();
        $addcates = CateArticles::where('group','support')->where('id','!=',$support->cate_id)->get();
        $supports = array();
        foreach($cates as $value)
        {
            $supports[$value->id] = Support::orderBy('id','asc')->where('cate_id',$value->id)->get();
        }
        return view('support.edit',compact('support','cates','supports','addcates'));
    }


    public function postupdate(Request $request)
    {
        $articles=$request->all();
        if($articles['name']=='' || $articles['phone']=='' || $articles['email']=='')
        {
            return redirect()->back()->withErrors('Bạn chưa điền đầy đủ thông tin hỗ trợ!');
        }
        $articles['cate_id'] = $request->categories;

         $support = Support::find($request->id);
        $support->update($articles);
        return redirect()->back()->with('status','Đã sửa thông tin hỗ trợ thành công!');
    }


    public function delete($id)
    {
        // see if authenticated user has permission to delete users
        Support::find($id)->delete();

        Flash::success('Xóa cấu hình thành công!');

        return redirect('admin/support');
    }

}