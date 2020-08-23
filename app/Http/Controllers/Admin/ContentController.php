<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use VNPCMS\Catearticle\CateArticles;
use VNPCMS\Flasher\Facades\Flash;
use Illuminate\Http\Request;
use App\Models\Linktype;
use Illuminate\Support\Facades\App;
use App\Utils\FileUtils;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use VNPCMS\Banks\BanksApplicationService;


class ContentController extends Controller
{

    public function index()
    {
        $contents = Linktype::orderBy('order','asc')->get();
        return view('content.index',compact('contents'));
    }


    public function postcreate(Request $request)
    {
        if($request->name==''){
            return redirect()->back()->withErrors('Chưa điền tiêu dề!');
        }
        if($request->code==''){
            return redirect()->back()->withErrors('Chưa điền mã nội dung!');
        }
        if($request->vn==''){
            return redirect()->back()->withErrors('Chưa điền link tiếng việt!');
        }
        $check = Linktype::where('code',$request->code)->orwhere('vn',$request->vn)->get()->count();
        if($check!=0){
            return redirect()->back()->withErrors('Nội dung đã tồn tại');
        }
        $input =$request->all();
        $input['en']=$request->code;
        Linktype::create($input);

        return redirect()->back()->with('status','Bạn đã thêm nội dung thành công');

    }

    public function edit(Request $request)
    {
        $cont = Linktype::find($request->id);
        $contents = Linktype::orderBy('id','asc')->get();

        return view('content.edit',compact('cont','contents'));
    }


    public function postupdate(Request $request)
    {
        $cont = Linktype::find($request->id);
        if($request->name==''){
            return redirect()->back()->withErrors('Chưa điền tiêu dề!');
        }
        if($request->code==''){
            return redirect()->back()->withErrors('Chưa điền mã nội dung!');
        }
        if($request->vn==''){
            return redirect()->back()->withErrors('Chưa điền link tiếng việt!');
        }
        $check = Linktype::where('code',$request->code)->where('id','!=',$request->id)->get()->count();
        if($check!=0){
            return redirect()->back()->withErrors('Nội dung đã tồn tại');
        }
        $input =$request->all();
        $cont->update($input);
        return redirect()->back()->with('status','Cập nhật nội dung thành công!');
    }

    public function delete($id)
    {
        Linktype::find($id)->delete();
        Flash::success('Xóa nội dung thành công!');

        return redirect('admin/content');
    }

    public function orders(Request $request)
    {
        $orders = $request->order;
        foreach($orders as $key=>$value){
            $update = Linktype::find($key);
            $update->order = $orders[$key];
            $update->save();
        }
        $status = $request->status;
        foreach ($status as $key => $value) {
            $update = Linktype::find($key);
            $update->status = $status[$key];
            $update->save();
        }

        $categories = $request->category;
        foreach ($status as $key => $value) {
            $update = Linktype::find($key);
            $update->category = $categories[$key];
            $update->save();
        }
        return redirect()->back()->with('status','Đã cập nhật thành công!');

    }
}