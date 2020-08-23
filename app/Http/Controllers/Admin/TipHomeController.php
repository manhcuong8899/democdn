<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use VNPCMS\Catearticle\CateArticles;
use VNPCMS\Flasher\Facades\Flash;
use Illuminate\Http\Request;
use App\Models\Tips;
use Illuminate\Support\Facades\App;
use App\Utils\FileUtils;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use VNPCMS\Banks\BanksApplicationService;


class TipHomeController extends Controller
{

    public function index()
    {
        $tips = Tips::orderBy('id','asc')->get();
        return view('tips.index',compact('tips'));
    }


    public function postcreate(Request $request)
    {
        if($request->name==''){
            return redirect()->back()->withErrors('Chưa điền tiêu dề!');
        }
        $input =$request->all();

        if($request->hasFile('images')) {
            $file = $request->file('images');
            $name = Str::slug($input['name'])."." . $file->getClientOriginalExtension();
            $path = 'public/images/tips/';
            $input['images']=$name;
            $file->move($path, $name);
        }

        Tips::create($input);

        return redirect()->back()->with('status','Bạn đã thêm tiêu điểm thành công');

    }

    public function edit(Request $request)
    {
        $tip = Tips::find($request->id);
        $tips = Tips::orderBy('id','asc')->get();

        return view('tips.edit',compact('tip','tips'));
    }


    public function postupdate(Request $request)
    {
        $tip = Tips::find($request->id);
        if($request->name==''){
            return redirect()->back()->withErrors('Chưa điền tiêu dề!');
        }
        $input =$request->all();


        if($request->hasFile('images')) {
            $file = $request->file('images');
            $name = Str::slug($input['name'])."." . $file->getClientOriginalExtension();
            $path = 'public/images/tips/';
            $input['images']=$name;
            $file->move($path, $name);
        }

        $tip->update($input);
        return redirect()->back()->with('status','Cập nhật nội dung thành công!');
    }

    public function delete($id)
    {
        Tips::find($id)->delete();
        Flash::success('Xóa tiêu điểm thành công!');

        return redirect('admin/tips');
    }

    public function orders(Request $request)
    {
        $orders = $request->order;
        foreach($orders as $key=>$value){
            $update = Tips::find($key);
            $update->order = $orders[$key];
            $update->save();
        }
        return redirect()->back()->with('status','Đã cập nhật thành công!');

    }
}