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
use VNPCMS\units\UnitsApplicationService;
use VNPCMS\units\Repository\UnitsRepositoryInterface;


class unitsController extends Controller
{

    /**
     * Instance of VNPCMS\News\Repository\NewsRepositoryInterface
     *
     * @var Object
     */
    private $unitsRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UnitsRepositoryInterface $unitsRepository)
    {
        $this->unitsRepository = $unitsRepository;

        $this->middleware('auth');
     $this->middleware('permission:config_management');
    }

    /**

     *
     * @return View;
     **/
    public function index()
    {
        $units = $this->unitsRepository->GetAll();

        return view('units.index',compact('units'));
    }

    public function create()
    {
        return view('units.create',compact('cates'));
    }


    public function postcreate(Request $request)
    {
        $articles=$request->all();

        if($articles['name']=='')
        {
            return redirect()->back()->withErrors('Bạn chưa điền tên đơn vị!');
        }

        $null = $this->unitsRepository->unitsNull($articles['name']);

        if($null == false)
        {
            return redirect()->back()->withErrors('Đơn vị đã tồn tại!');
        }

        $this->unitsRepository->create($articles);

        return redirect()->back()->with('status','Bạn đã đơn vị thành công');

    }

    public function edit(Request $request)
    {
        $unit = $this->unitsRepository->ById($request->id);
        $units = $this->unitsRepository->GetAll();
        return view('units.edit',compact('unit','units'));
    }


    public function postupdate(Request $request)
    {
        $articles=$request->all();

        if($articles['name']=='')
        {
            return redirect()->back()->withErrors('Bạn chưa điền tên đơn vị!');
        }

        $null = $this->unitsRepository->UnitsNullUpdate($articles['name'],$request->id);

        if($null == false)
        {
            return redirect()->back()->withErrors('Đơn vị đã tồn tại!');
        }

        $unit = $this->unitsRepository->ById($request->id);

        $this->unitsRepository->update($unit,$articles);

        return redirect()->back()->with('status','Đã sửa đơn vị!');
    }


    public function delete($id)
    {
        // see if authenticated user has permission to delete users

        $unitsApplicationService = new unitsApplicationService();
        $unitsApplicationService->delete($id);

        Flash::success('Xóa đơn vị thành công!');

        return back();
    }

}